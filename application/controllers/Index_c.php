<?php
defined('BASEPATH') or exit('No direct script access allowed');

use helpers\SendMailHelper;
use helpers\RegisterHelper;

class Index_c extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->event = $this->config->item('event');
		$this->load->library('session');
		$this->load->helper(array('cookie','url')); 
		$this->cookie_live = 'video_live_register';

		// กรณีมี utm tag ติดเข้ามากับ url
		if (stripos($_SERVER['QUERY_STRING'], 'utm_') !== false) {			
			$this->session->set_userdata('test_utm', $_SERVER['QUERY_STRING']);
		}

	}

	private function getPageConfig()
	{
		$data['check_quota'] = RegisterHelper::get_quota();
		if ($data['check_quota']) {
			echo '<!--' . $data['check_quota'] . '-->';
		}

		//ดึงค่าวันที่และเวลาที่ตั้งไว้สำหรับปิดระบบ และปิดระบบอัตโนมัติ
		$date = $this->event['close_date'];
		$close_date = strtotime($date);
		if(date("d/M/Y h:i:s") >= date('d/M/Y h:i:s', $close_date))
		{
			$data['is_closed'] = TRUE;
		}else{
			$data['is_closed'] = FALSE;
		}
		
		$data['_URL'] = base_url();
		$data['_STATIC_URL'] = $this->event['base_static'];
		$data['_CURRENT_URL'] =  $this->config->item( 'host' ).$_SERVER['REQUEST_URI'];
		$data['ASSETS_VERSION'] = $this->config->item( 'asset_version' );

		return $data;
	}

	public function index()
	{
		$data = $this->getPageConfig();
		$data['_isHome'] = TRUE;
		$this->load->view('template/header',$data); 
		$this->load->view('index', $data); 
		$this->load->view('template/footer',$data); 
	}

	public function register()
	{
		if ($this->event['is_closed']) {
			redirect(base_url());
		}	

		if($this->input->post())
		{
			// echo "<pre/>"; print_r($this->input->post()); echo "<pre/>";
			$this->load->database();
			$this->db->db_debug = true;

			// save data
			$person = null;

			$this->load->model('Util_m');
			$register_code = $this->Util_m->randCode();

			if($this->input->post('register_person'))
			{
				$index = 0;
				for ($i = 1; $i <= $this->input->post('register_person'); $i++) 
				{
					$person[$index]['pre_name'] = $this->input->post('pre_name');
					if ($this->input->post('pre_name') == 'etc') {
						$person[$index]['pre_name'] = $this->input->post('pre_name_text');
					}
					$person[$index]['name'] = $this->input->post('name');
					$person[$index]['lastname'] = $this->input->post('lastname');
					$person[$index]['email'] = $this->input->post('email');
					$person[$index]['phone'] = $this->input->post('phone');
					$person[$index]['code'] = $register_code;
					$person[$index]['company'] = $this->input->post('company');
					$person[$index]['position'] = $this->input->post('position');
					// $person[$index]['business_type'] = $this->input->post('business_type');
					// $person[$index]['company_website'] = $this->input->post('company_website');
					// $person[$i]['image'] = $this->input->post('image');
					// echo "<Pre/>"; print_r($person); exit;
					$is_banned = RegisterHelper::_is_banlist($person[$index]);	// Check banlist
					$is_duplicate_reg = RegisterHelper::_check_duplicate_reg($person[$index]['email'],$person[$index]['phone']);	// Check duplicate_registration

					if ($is_banned || $is_duplicate_reg) 
					{
						break;	//ถ้าผิดเงื่อนไข ให้เบรคลูปสำหรับบันทึกข้อมูลง DB
					}

					$index++;
				}

				//Uncomplete registration
				if ($is_banned) {  
					redirect(base_url() .'uncompleted');
					exit;
				}
				//Uncomplete registration
				if ($is_duplicate_reg) {  
					redirect(base_url() .'uncomplete');
					exit;
				}

				$check_quota = RegisterHelper::get_quota(0);

				if ($check_quota > 0) {
					if ($person) {
						$person = json_encode($person);
					}
					//Extra Field
					$extra['attend_1'] = $this->input->post('attend_1');
					$extra['attend_2'] = $this->input->post('attend_2');
					$extra['translation'] = $this->input->post('translation');
					$extra['subscribe_1'] = $this->input->post('subscribe_1');
					$extra['subscribe_2'] = $this->input->post('subscribe_2');
					
					$extra = json_encode($extra);
	
					if ($person) {
	
						$q_data = array(
							'name' => $person,
							'register_option' => $this->input->post('register_person'),
							'register_date' => date("Y-m-d H:i:s"),
							'email' => $this->input->post('email'),
							'payment_status' => 0,
							'extra' => $extra,
							'event_id' => $this->event['event_id'],
							'utm' => $this->session->userdata('test_utm'),
							// 'business_type' => $this->input->post('business_type'),
							// 'company_website' => $this->input->post('company_website'),
						);
	
						$str = $this->db->insert_string('register', $q_data);
						$this->db->query($str);
	
						RegisterHelper::get_quota(1);
	
						//send mail to user
						$data_mail['name'] = $this->input->post('name');
						$data_mail['code'] = $register_code;
	
						$data['data'] = $data_mail;
						
						$subject = $this->event['title'];
						$body = $this->load->view('mail/mail_template', $data, TRUE);
						$return = SendMailHelper::send_email($this->input->post('email'), $subject, $body);
						
						$this->output->enable_profiler(TRUE);
						//delete session
						$this->session->unset_userdata('test_utm');
						redirect(base_url() . "thankyou");
					}
				}

			}
		}
	}

	public function thankyou()
	{
		$data = $this->getPageConfig();
		$data['_isHome'] = FALSE;
		$this->load->view('template/header',$data); 
		$this->load->view('thankyou'); 
	}

	public function unsuccess1()
	{
		$data = $this->getPageConfig();
		$data['_isHome'] = FALSE;
		$this->load->view('template/header',$data); 
		$this->load->view('uncomplete',$data);
	}

	public function unsuccess2()
	{
		$data = $this->getPageConfig();
		$data['_isHome'] = FALSE;
		$this->load->view('template/header',$data); 
		$this->load->view('uncompleted',$data);
	}

}