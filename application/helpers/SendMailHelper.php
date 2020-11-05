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

Class SendMailHelper
{
	/**
	 * 
	 * @param $mailto
	 * @param $subject
	 * @param $body
	 * @param $path
	 * 
	 */
	public static function send_email($mailto='',$subject='',$body='',$path=''){
		$CI = &get_instance();
		$CI->load->library('Phpmailer');
		$CI->load->library('smtp');
		$CI->phpmailer->CharSet = "UTF-8";
		
		$CI->phpmailer->Host = '103.87.217.111'; 
		$CI->phpmailer->Hostname = 'bangkokpost.co.th';
		
		if(is_array($mailto)){
			foreach($mailto as $key=>$email){
				if($key==0){
					$CI->phpmailer->AddAddress($email);
				}else{
					$CI->phpmailer->AddCC($email);
					// $CI->phpmailer->AddBCC($email);
				} 
			}
		}else{
			$CI->phpmailer->AddAddress($mailto);
		}
		#$CI->phpmailer->SMTPDebug = true;
		$CI->phpmailer->IsHTML(true);
		$CI->phpmailer->Mailer = 'smtp';
		$CI->phpmailer->From = 'RSVP@bangkokpost.co.th'; 
		$CI->phpmailer->FromName = $subject;
		$CI->phpmailer->Subject = $subject;
		if($path!=''){
			$CI->phpmailer->Body = $body;
			// $CI->phpmailer->Body = $body.'<br>Image url : '.$path;
			$CI->phpmailer->AddAttachment($path);
		}else{
			$CI->phpmailer->Body = $body;
		}
		if(!$CI->phpmailer->Send()){
			$CI->phpmailer->clearAllRecipients(); 
			return false;
		}else{
			$CI->phpmailer->clearAllRecipients(); 
			return true;
		}
	}
}

		