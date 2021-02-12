<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Live_c extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->event = $this->config->item('event');
		$this->load->library('session');
		$this->load->helper(array('cookie', 'url','form')); 
		$this->cookie_live = 'video_live_register';

		// กรณีมี utm tag ติดเข้ามากับ url
		if (stripos($_SERVER['QUERY_STRING'], 'utm_') !== false) {			
			$this->session->set_userdata('test_utm', $_SERVER['QUERY_STRING']);
		}

		//if(!preg_match('/10.44.24.*/',$this->input->ip_address())){
		//	exit();
		//}
		// $this->quota_number = 30;
		/* 			if ($this->input->get('test') != 1) {
				redirect('https://www.posttoday.com/');
			} */
    }

    public function live()
	{

		$get_cookie = $this->input->cookie($this->cookie_live,true);
		# if(!get_cookie('video_live_register')) //กรณีการเข้าหน้าไลฟ์ครั้งแรกจะยังไม่มีคุกกี้ชื่อ video_live_register ให้สร้างคุกกี้และเซ็ตค่าเป็น false
		if(!$get_cookie) 
		{
			set_cookie('video_live_register','false','3600');
			$cookie= array(
				'name'   => $this->cookie_live,
				'value'  => '',
				'expire' => 0,
			   'domain' => '.bangkokpost.com',
				'path' => '/'
				 );
			 delete_cookie($cookie); 
		}
		
		/*if(isset($_GET['dev']))
		{
			$this->load->view('live-test');
		}else{*/
			$this->load->view('live',['get_cookie' => $get_cookie]);
		//}
			
		
    }

    public function live_register()
	{
		/** กรณีที่มีการกรอกข้อมูลมาจากหน้าไลฟ์วิดีโอ ให้บันทึกข้อมูลลงฐานข้อมูล และเปลี่ยนค่า cookie เป็น true */
		if($this->input->post('xEmail'))
		{
            $email = $this->input->post('xEmail');
            $result = $this->check_duplicate_reg1($email);

            if($result==1){
                if($this->chk_email_valid($email)){
                    $this->load->database();
                    $this->db->db_debug = true;
                    
                    $q_data = array(
                        'firstname' => $this->input->post('xFirstname'),
                        'lastname' => $this->input->post('xLastname'),
                        'email' => $this->input->post('xEmail'),
                        'updated_at' => date("Y-m-d H:i:s"),
                        'event_id' => $this->event['event_id'] 
                    );
        
                    $str = $this->db->insert_string('live_user', $q_data);
                    $this->db->query($str);

                    echo "1"; exit;
                }else{
                    echo "2"; exit;
                }
            }else if($result==2){
                echo "2"; exit;
            }
		}
    }
    

    public function live_login()
	{
		/** กรณีที่มีการกรอกข้อมูลมาจากหน้าไลฟ์วิดีโอ ให้บันทึกข้อมูลลงฐานข้อมูล และเปลี่ยนค่า cookie เป็น true */
		if($this->input->post('xEmail'))
		{
            $email = $this->input->post('xEmail');
            $result = $this->check_duplicate_reg1($email);
            
            if($result==1){
                if($this->chk_email_valid($email)){
                    echo "1"; exit;
                }else{
                    echo "2"; exit;
                }
            }else if($result==2){
                echo "2"; exit;
            }
		}
    }
    
    public function set_login_cookie()
    {
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
    }


    //LIVE CUSTOM
	/**
	 * ตรวจสอบว่าลงทะเบียนซ้ำหรือไม่
	 *
	 * @param $email 
	 * @param $phone
	 * @return boolean 
	 *  - true: ซ้ำ
	 *  - false: ไม่ซ้ำ
	 */
	public function check_duplicate_reg1($email)
	{ 
		//$token = isset($_GET['token']) ? $_GET['token'] : '';
		//$email = isset($_GET['email']) ? $_GET['email'] : '';
		//if(isset($_GET['token']))
		if($email !='')
		{
			$this->load->database();

			$this->db->select('*');  //name field = json
			$this->db->where("email",$email);
			$this->db->where("event_id",$this->event['event_id']);
			$count = $this->db->get('live_user')->result_id->num_rows;
			
			if($count > 0)
			{
				return 2;
			}else{
				return 1;
			}
			

		}else{
			//echo "xxxx";
			return 3;
		}
	}
	
	private function chk_email_valid($email)
	{
		$this->load->helper('email');
		$return = true;
		if($email)
		{
			if(!valid_email($email))
			{
				$return = false;
			}
			else
			{

				$return = (!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $email)) ? FALSE : TRUE;
			}
		} else {
			$return = false;
		}
		return $return;
	}
    

    public function live_update()
	{
		$data['data']['is_live'] = true;
		$this->load->view('template/header-channel', $data);
		$this->load->view('live-update', $data);
		$this->load->view('template/footer');
	}

	public function live_demo()
	{
		$data['data']['is_live'] = true;
		$this->load->view('template/header-channel', $data);
		$this->load->view('live_demo1', true);
		$this->load->view('template/footer');
    }
}