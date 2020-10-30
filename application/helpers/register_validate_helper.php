<?php
/**
 *	PHP version 5
 * 
 *	@category   Helper
 *	@author	Nuttawat Pattanatragool <nuttawatp@bangkokpost.co.th>
 *	@author Watcharaphon Piamphuetna <watcharaphonp@bangkokpost.co.th>
 *	@copyright copyright (c) 1996 - 2020 Bangkok Post Public Company Limited.
 */

	if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	/**
	 * ตรวจสอบว่าลงทะเบียนซ้ำหรือไม่
	 *
	 * @param $email 
	 * @param $phone
	 * @return boolean 
	 *  - true: ซ้ำ
	 *  - false: ไม่ซ้ำ
	 */
	function _check_duplicate_reg($email,$phone)
	{ 
		$ret = false;
		$CI = &get_instance();
		$CI->load->database();
		$config = $CI->config->item('event');

		$CI->db->select('name');  //name field = json
		$CI->db->where("event_id = {$CI->db->escape($config['event_id'])}");
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
	function _check_unsubscription($email)
	{ 
		$CI = &get_instance();
		$ret = false;
		$CI->load->database();

		$CI->db->select('*');  //name field = json
		$CI->db->where("
			email = {$this->db->escape($email)}
			OR change_email = {$CI->db->escape($email)}
		");
		 $count_rows = $CI->db->get('unsubscription')->num_rows();
		 return $ret = ($count_rows !== 0 ? true : false);
	}

	function test()
	{
		return "BBB";
	}