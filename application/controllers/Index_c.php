<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Index_c extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->event = $this->config->item('event');
		$this->load->library('session');
		$this->load->helper(array('cookie', 'url')); 
		$this->cookie_live = 'video_live_register';

		// กรณีมี utm tag ติดเข้ามากับ url
		if (stripos($_SERVER['QUERY_STRING'], 'utm_') !== false) {			
			$this->session->set_userdata('test_utm', $_SERVER['QUERY_STRING']);
		}

	}

	public function index()
	{
		if($this->event['is_closed'])
		{
			//// Some Action
		}else{	//
			$data['check_quota'] = $this->get_quota();
			if ($data['check_quota']) {
				echo '<!--' . $data['check_quota'] . '-->';
			}
	
			//$this->load->view('template/header-channel', $data);
			$this->load->view('index', $data); 
			//$this->load->view('template/footer');
		}
	}

	public function thankyou()
	{
		$this->load->view('template/header-channel');
		$this->load->view('thankyou', $data);
		$this->load->view('template/footer');
	}

	public function register($action = '')
	{
		$data['check_quota'] = $this->get_quota();

		if ($this->event['is_closed'] || !$data['check_quota']) {
			redirect(base_url());
		}

		if ($data['check_quota']) {
			echo '<!--quota: ' . $data['check_quota'] . '-->';
		}
	
		if ($action == 'review') {
			if ($this->input->post('submit')) {
				$data['data'] = $this->input->post();
	
				foreach ($data['data']['attend'] as $item) {
					if ($item == 1) {
						$data['data']['attend_1'] = 1;
					} else if ($item == 2) {
						$data['data']['attend_2'] = 1;
					}
				}
				unset($data['data']['attend']);
	
				$this->load->view('template/header-channel');
				$this->load->view('review', $data);
				$this->load->view('template/footer');
			}
		} else {
			if ($this->input->post()) {
				$data['data'] = $this->input->post();
			}
			$this->load->view('template/header-channel');
			$this->load->view('register', $data);
			$this->load->view('template/footer');
		}
	}

	public function live()
	{
		$get_cookie = $this->input->cookie($this->cookie_live,true);
		
		if(!$get_cookie) //กรณีการเข้าหน้าไลฟ์ครั้งแรกจะยังไม่มีคุกกี้ชื่อ video_live_register ให้สร้างคุกกี้และเซ็ตค่าเป็น false
		{
			# set_cookie('video_live_register','false','3600');
			$cookie= array(
				'name'   => $this->cookie_live,
				'value'  => '',
				'expire' => 0,
			   	'domain' => '.bangkokpost.com',
				'path' => '/'
			);
			delete_cookie($cookie); 
		}
		
		$this->load->view('live');
	}

	public function live_register()
	{
		/** กรณีที่มีการกรอกข้อมูลมาจากหน้าไลฟ์วิดีโอ ให้บันทึกข้อมูลลงฐานข้อมูล และเปลี่ยนค่า cookie เป็น true */
		if($this->input->post('submit'))
		{
			$this->load->database();
			$this->db->db_debug = true;

			$q_data = array(
				'firstname' => $this->input->post('firstname'),
				'lastname' => $this->input->post('lastname'),
				'email' => $this->input->post('email'),
				'updated_at' => date("Y-m-d H:i:s"),
				'event_id' => $this->event['event_id'] 
			);

			$str = $this->db->insert_string('live_user', $q_data);
			$this->db->query($str);

			# set_cookie('video_live_register','true','3600');
			$times = 60*60*24*1;  //  secs*minits*hour*days 
			$cookie= array(
				'name'   => $this->cookie_live,
				'value'  => '1',
				'expire' => $times,
				'domain' => '.bangkokpost.com',
				'path' => '/',
			);
			$this->input->set_cookie($cookie);
			redirect(base_url() .'live');
		}
	}

	public function live_update()
	{
		$data['data']['is_live'] = true;
		$this->load->view('template/header-channel', $data);
		$this->load->view('live-update', $data);
		$this->load->view('template/footer');
	}

	public function promote()
	{
		$this->load->view('promote');
	}

	
	// REGISTER FULL
	public function register2($action = '') 
	{
		$data['check_quota'] = $this->get_quota();

		$data['data']['is_home'] = true;
		$this->load->view('template/header-channel', $data);
		$this->load->view('register2', $data);
		$this->load->view('template/footer');
	}

	public function register2_thankyou()
	{ 
		if ($this->input->post()) {
			$this->load->database();

			$data_insert = array();
			$data_insert['register_full_email'] = $this->input->post('email1');
			$data_insert['register_full_datetime'] = date("Y-m-d H:i:s");
			$this->db->insert('register_full', $data_insert);
		}

		$this->load->view('template/header-channel');
		$this->load->view('register2_thankyou');
		$this->load->view('template/footer');
	}

	public function payment()
	{
		$is_banned = false;
		$is_duplicate_reg = false;
		
		if ($this->event['is_closed']) {
			redirect(base_url());
		}		

		if ($this->input->post()) {

			$this->load->database();
			$this->db->db_debug = true;

			// save data
			$person = null;

			$this->load->model('Util_m');
			$register_code = $this->Util_m->randCode();

			if ($this->input->post('register_person') && $this->input->post('email1') != '' && $this->input->post('name1') != '') {
				$index = 0;
				for ($i = 1; $i <= $this->input->post('register_person'); $i++) {
					$person[$index]['pre_name'] = $this->input->post('pre_name' . $i);
					if ($this->input->post('pre_name' . $i) == 'etc') {
						$person[$index]['pre_name'] = $this->input->post('pre_name_text' . $i);
					}
					$person[$index]['name'] = $this->input->post('name' . $i);
					$person[$index]['lastname'] = $this->input->post('lastname' . $i);
					$person[$index]['email'] = $this->input->post('email' . $i);
					$person[$index]['phone'] = $this->input->post('phone' . $i);
					$person[$index]['company'] = $this->input->post('company' . $i);
					$person[$index]['position'] = $this->input->post('position' . $i);
					$person[$index]['code'] = $register_code;
					$person[$index]['business_type'] = $this->input->post('business_type1');
					$person[$index]['company_website'] = $this->input->post('company_website1');
					// $person[$i]['image'] = $this->input->post('image'.$i);

					// Check banlist
					$is_banned = $this->_is_banlist($person[$index]);
					// Check duplicate_registration
					$is_duplicate_reg = $this->_check_duplicate_reg($person[$index]['email'],$person[$index]['phone']);
					

					if ($is_banned || $is_duplicate_reg) 
					{
						break;
					}

					$index++;
				}
			}
			//Uncomplete registration
			/*if ($is_banned) {  
				redirect(base_url() .'uncomplete');
				exit;
			}*/
			//Uncomplete registration
			if ($is_duplicate_reg) {  
				redirect(base_url() .'uncompleted');
				exit;
			}

			$check_quota = $this->get_quota(0);

			if ($check_quota > 0) {
				if ($person) {
					$person = json_encode($person);
				}
				$extra['attend_1'] = $this->input->post('attend_1');
				$extra['attend_2'] = $this->input->post('attend_2');
				$extra['translation'] = $this->input->post('translation');
				$extra['subscribe_1'] = $this->input->post('subscribe_1');
				$extra['subscribe_2'] = $this->input->post('subscribe_2');
				
				//print_r($extra);
				$extra = json_encode($extra);

				if ($person) {

					$q_data = array(
						'name' => $person,
						'register_option' => $this->input->post('register_person'),
						'register_date' => date("Y-m-d H:i:s"),
						'email' => $this->input->post('email1'),
						'payment_status' => 0,
						'extra' => $extra,
						'event_id' => $this->event['event_id'],
						'utm' => $this->session->userdata('test_utm'),
						'business_type' => $this->input->post('business_type1'),
						'company_website' => $this->input->post('company_website1'),
					);

					$str = $this->db->insert_string('register', $q_data);
					$this->db->query($str);

					$this->get_quota(1);

					//send mail to user
					$data_mail['name'] = $this->input->post('name1');
					$data_mail['code'] = $register_code;

					$data['data'] = $data_mail;
					
					$subject = $this->event['title'];
					$body = $this->load->view('mail/bkp_74th_anniversary', $data, TRUE);
					$return = send_email($this->input->post('email1'), $subject, $body);
					
					$this->output->enable_profiler(TRUE);
					//delete session
					$this->session->unset_userdata('test_utm');
					redirect(base_url() . "thankyou");
				}
			} else {
				redirect(base_url());
			}
		} else {
			redirect(base_url());
		}
	}


	

	public function get_quota($process = '')
	{

		$this->load->helper('utility_helper');
		$_filelogs = "logs/quota/check_quota.txt";
		$balance_quota = openFile($_filelogs);

		if ($process == 1 || $balance_quota == '') { //update 
			/* 				$this->load->database();
				if(!$this->db->error()["code"]){
					$this->db->where('event_id',$this->event['event_id']);
					$this->db->where('status',0);
					$this->db->from('reserve');
					$balance_quota = $this->db->count_all_results();
					writeFile($_filelogs,$balance_quota);
				} */

			$this->load->database();
			if (!$this->db->error()["code"]) {
				/*
					$this->db->select('register_option');
					$this->db->from('items');
					$this->db->order_by('price desc');
					$this->db->limit(3);
					$this->db->get();
				*/

				$quota = $this->event['quota'];

				$this->db->select_sum('register_option');
				$this->db->where('event_id', $this->event['event_id']);
				$this->db->where('register_enable', 1);
				$this->db->where('payment_status <', 3);
				$used = $this->db->get('register')->row_array();
				$balance_quota = $quota - $used['register_option'];
				writeFile($_filelogs, $balance_quota);
			}
		}
		return $balance_quota;
	}

	public function test_email_template()
	{
		//send mail to user
		$data_mail['name'] = 'Test';
		$data_mail['code'] = '1234';
		/*Sintana Rochanasmita
		30681*/


		$data['data'] = $data_mail;

		$subject = $this->event['title'];
		echo $this->load->view('mail/bkp_74th_anniversary', $data, TRUE);
		// $body = $this->load->view('mail/bkp_74th_anniversary', $data, TRUE);
		// $return = send_email('watcharaphonp@bangkokpost.co.th', $subject, $body);
	}

	public function test()
	{
		//echo $this->get_quota();
	}

	/**
	 * ลูกค้ากด link Yes/No ตอบกลับมาทาง email แล้วทำการ save log file
	 * @example https://www.bangkokpost.com/events/bangkokpostforum2019/roadmap-to-success/confirm_event?name=boy&ans=yes&email=nuttwatp@bangkokpost.co.th
	 *
	 * @return void
	 */
	public function confirm_event()
	{
		$ans = strtolower($this->input->get('ans'));
		$email = $this->input->get('email');
		$name = $this->input->get('name');

		if ($ans == '' || $email == '' || $name == '') {
			// redirect(base_url());
		}

		$this->load->helper('file');

		$message = $name . "," . $email . "," . date("Y-m-d H:i:s") . "\r\n";

		if ($ans == 'yes') {
			$ok = write_file(APPPATH . "logs/confirm_yes.php", $message, 'a');			
		} else if ($ans == 'no') {
			$ok = write_file(APPPATH . "logs/confirm_no.php", $message, 'a'); 		
		} else {
			// redirect(base_url());
		}

		if ($ok) {
			// @TODO:
			// echo "Success";
			// Redirect ไปยังหน้า landing
		} else {
			// echo "Failed";
			// Redirect ไปยังหน้า landing
		}
		
		$this->load->view('template/header-channel');
		$this->load->view('confirm');				
		$this->load->view('template/footer');		
	}

	/**
	 * ตรวจสอบว่าถูก ban หรือไม่
	 *
	 * @param array $person 
	 * @return boolean 
	 *  - true: โดนแบน
	 *  - false: ไม่โดนแบน
	 */
	private function _is_banlist($person)
	{
		$ret = false;

		$this->load->database();

		$this->db->select("banlist_id");
		if($person['email'] !== '' && $person['phone'] !== '')
		{
			$this->db->where("
				banlist_telephone = {$this->db->escape($person['phone'])}
				OR banlist_email = {$this->db->escape($person['email'])}
				OR (banlist_name = {$this->db->escape($person['name'])} AND banlist_lastname = {$this->db->escape($person['lastname'])}) 
			");
		}
		else if($person['email'] !== '' && $person['phone'] == '')
		{
			$this->db->where("
				banlist_email = {$this->db->escape($person['email'])}
				OR (banlist_name = {$this->db->escape($person['name'])} AND banlist_lastname = {$this->db->escape($person['lastname'])}) 
			");
		}

		$arr_ban_list = $this->db->get('banlist')->row_array();

		if ($arr_ban_list) {

			$this->load->helper('file');

			$message = date("Y-m-d H:i:s" . "\n");
			$message .= print_r($person, true) . "\n";
			$ok = write_file(APPPATH . "logs/banlist.php", $message, 'a');
			$ret = true;
		}

		return $ret;
	}

	public function uncomplete()
	{
		// redirect(base_url());

		$this->load->view('template/header-channel');
		$this->load->view('uncomplete');
		$this->load->view('template/footer');
	}

	public function uncomplete2()
	{
		// redirect(base_url());

		$this->load->view('template/header-channel');
		$this->load->view('uncomplete2');
		$this->load->view('template/footer');
	}


	/**
	 * ตรวจสอบว่าลงทะเบียนซ้ำหรือไม่
	 *
	 * @param $email 
	 * @param $phone
	 * @return boolean 
	 *  - true: ซ้ำ
	 *  - false: ไม่ซ้ำ
	 */
	private function _check_duplicate_reg($email,$phone)
	{ 
		$ret = false;
		$this->load->database();

		$this->db->select('name');  //name field = json
		$this->db->where("event_id = {$this->db->escape($this->event['event_id'])}");
		$result = $this->db->get('register')->result();
		$result = json_decode(json_encode($result), True);
		foreach($result as $val)
		{
			$jsonObject = json_decode($val['name'], true)[0];
			
			if($email !== '' && $phone !== '')
			{
				$ret = (($email == $jsonObject["email"]) || ($phone == $jsonObject["phone"]) ? true : false);
			}
			
			if($email !== '' && $phone == '')
			{
				$ret = (($email == $jsonObject["email"]) ? true : false); 
			}
			
			if($ret === true) 
			{
				break;
			}
		}
		return $ret;
	}

	/**
	 * ตรวจสอบ Unsubscription Email
	 *
	 * @param $email 
	 * @return boolean 
	 *	true = email อยู่ในลิสต์ที่ต้องการ Unsubscribe
	 *  false = email ไม่อยู่ในลิสต์ที่ต้องการ Unsubscribe
	 */
	private function _check_unsubscription($email)
	{ 
		$ret = false;
		$this->load->database();

		$this->db->select('*');  //name field = json
		$this->db->where("
			email = {$this->db->escape($email)}
			OR change_email = {$this->db->escape($email)}
		");
		 $count_rows = $this->db->get('unsubscription')->num_rows();
		 return $ret = ($count_rows !== 0 ? true : false);
	}

	public function random_code($number) 
	{
		$this->load->model('Util_m');
		for ($i = 1; $i <= $number; $i++) {
			echo $this->Util_m->randCode();
			echo "<br />";		
		} 

		echo "<hr />Done!";
	}
}