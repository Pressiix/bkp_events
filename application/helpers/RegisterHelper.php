<?php
/**
 *	PHP version 5
 * 
 *	@category   Helper
 *	@author	Nuttawat Pattanatragool <nuttawatp@bangkokpost.co.th>
 *	@author Watcharaphon Piamphuetna <watcharaphonp@bangkokpost.co.th>
 *	@copyright copyright (c) 1996 - 2020 Bangkok Post Public Company Limited.
 */

namespace helpers;

use helpers\FileHelper;

Class RegisterHelper
{
	/**
	 * ฟิลด์ตัวเลือกอายุของผู้สมัคร
	 *
	 * @param string $id
	 * @return void
	 */
	public static function register_option($id=''){
		if($id==1){
			return '( อายุ 0-3 ปี )'; 
		}else if($id==2){
			return '( 4-12 ปี )';
		}else if($id==3){
			return '( 12 ปี ขึ้นไป )'; 
		}
	}


	/**
	 * ตรวจสอบว่าถูก ban หรือไม่
	 *
	 * @param array $person 
	 * @return boolean 
	 *  - true: โดนแบน
	 *  - false: ไม่โดนแบน
	 */
	public static function isBanList($person)
	{
		$CI = &get_instance();
		$config = $CI->config->item('event');

		$ret = false;

		$CI->load->database();

		$CI->db->select("banlist_id");
		if($person['email'] !== '' && $person['phone'] !== '')
		{
			$CI->db->where("
				banlist_telephone = {$CI->db->escape($person['phone'])}
				OR banlist_email = {$CI->db->escape($person['email'])}
				OR (banlist_name = {$CI->db->escape($person['name'])} 
				AND banlist_lastname = {$CI->db->escape($person['lastname'])}) 
			");
		}
		else if($person['email'] !== '' && $person['phone'] == '')
		{
			$CI->db->where("
				(banlist_name = {$CI->db->escape($person['name'])} AND banlist_lastname = {$CI->db->escape($person['lastname'])}) 
			");
		}
		// $arr_ban_list = $CI->db->get('banlist')->result();
		$arr_ban_list = $CI->db->get('banlist')->row_array();

		if ($arr_ban_list) {

			$CI->load->helper('file');

			$message = date("Y-m-d H:i:s" . "\n");
			$message .= print_r($person, true) . "\n";
			$ok = write_file(APPPATH . "logs/banlist.php", $message, 'a');
			$ret = true;
		}

		return $ret;
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
	public static function checkDuplicateReg($email,$phone)
	{ 
		$CI = &get_instance();
		$config = $CI->config->item('event');

		$ret = false;
		$CI->load->database();
		$config = $CI->config->item('event');

		$CI->db->select('name');  //name field = json
		$CI->db->where("event_id = {$CI->db->escape($config['event_id'])}");
		$CI->db->where("event_type = {$CI->db->escape($config['event_type'])}");
		$result = $CI->db->get('register')->result();
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

		if($config['event_type'] == 'virtual_event' && !$ret)
		{
			$CI->db->select('*');  //name field = json
			$CI->db->where("event_id = {$CI->db->escape($config['event_id'])}");
			$CI->db->where("email = {$CI->db->escape($email)}");
			$CI->db->or_where("phone = {$CI->db->escape($phone)}");
			$count = $CI->db->get('live_user')->result_id->num_rows;

			if($count > 0)
			{
				$ret = true;
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
	public static function _check_unsubscription($email)
	{ 
		$CI = &get_instance();

		$ret = false;
		$CI->load->database();

		$CI->db->select('*');  //name field = json
		$CI->db->where("
			email = {$CI->db->escape($email)}
			OR change_email = {$CI->db->escape($email)}
		");
		 $count_rows = $CI->db->get('unsubscription')->num_rows();
		 $ret = ($count_rows !== 0 ? true : false);

		 return $ret ;
	}

	/**
	 * เช็คจำนวนโควต้าที่นั่งคงเหลือ
	 *
	 * @param string $process
	 * @return void
	 */
	public static function get_quota($process = '')
	{
		$CI = &get_instance();
		$config = $CI->config->item('event');
		$file_helper = new FileHelper();

		$_filelogs = "logs/quota/check_quota.txt";
		$balance_quota = FileHelper::openFile($_filelogs);

		if ($process == 1 || $balance_quota == '') { //update 

			$CI->load->database();
			if (!$CI->db->error()["code"]) {

				$quota = $config['quota'];

				$CI->db->select_sum('register_option');
				$CI->db->where('event_id', $config['event_id']);
				$CI->db->where('register_enable', 1);
				$CI->db->where('payment_status <', 3);
				$used = $CI->db->get('register')->row_array();
				$balance_quota = $quota - $used['register_option'];
				FileHelper::writeFile($_filelogs, $balance_quota);
			}
		}
		return $balance_quota;
	}

}
	