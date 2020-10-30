<?php
defined('BASEPATH') or exit('No direct script access allowed');
ini_set("display_errors",true);
error_reporting(E_ALL);
class Test_c extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->helper('utility');
	//	$this->load->library('session');
	}

	public function gencode()
	{
		$this->load->model('Util_m');
		$register_code = $this->Util_m->randCode();
		echo "<hr>==>";
		var_dump($register_code);
	}

	public function live()
	{
		$this->load->helper(array('cookie', 'url')); 
		$this->cookie_live = 'video_live_register';
		echo "live";
		$this->event = $this->config->item('event');
		$get_cookie = $this->input->cookie($this->cookie_live,true);
		# if(!get_cookie('video_live_register')) //กรณีการเข้าหน้าไลฟ์ครั้งแรกจะยังไม่มีคุกกี้ชื่อ video_live_register ให้สร้างคุกกี้และเซ็ตค่าเป็น false
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
		
		$this->load->view('live-dev');
		
	}
/*
	public function send_mail()
	{
		echo "<pre>";
		$subject = "can you send email?";
		$body = "We are apologize for a mistake";
		$from_email = "webmaster@bangkokpost.co.th";
		$from_name = "Bangkok Post Web Master";

		$return = send_email("ratthanau@gmail.com", $subject, $body);

		var_dump($return);
		echo "</pre>";
	}

	public function gen_session()
	{		
		$this->session->set_userdata('test_utm', 'value_utm');
		echo "Done";
	}

	public function get_session()
	{
		echo "data session : ";
		echo $this->session->userdata('test_utm');
	}

	public function get_querystring()
	{ 
		// print_r($this->input->get());
		// echo uri_string();
		echo "<pre>";
		echo htmlspecialchars($_SERVER['QUERY_STRING']);

	}
	
	
	public function live()
	{
		$this->load->view('live_dev');
	}
*/
}
