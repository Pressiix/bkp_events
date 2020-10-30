<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	function asset_url(){
	   return base_url().'assets/';
	}
	
	function par($arr){
		print "<pre>";
		print_r ($arr);
		print "</pre>";
	}

	function par_hide($arr){
		print "<!-- ";
		print "<pre>";
		print_r ($arr);
		print "</pre>";
		print " ->";
	}	
	
	function par_array($arr){
		print "<pre>";
		var_dump($arr);
		print "</pre>";
		print "<hr>";
	}
	
	function payment_id($order_id,$prefix='712'){
		$payment_id = $prefix;
		$num = strlen($order_id);
		for($i=$num;$i<9;$i++){
			$payment_id.='0';
		}
		$payment_id.=$order_id;
		return $payment_id;	
	}
	
	function payment_status($id=''){
		//0=NotPay,1=Wait,2=Complete,3=Fail
		if($id==0){
			return 'No Pay';	
		}else if($id==1){
			return 'Wait';	
		}else if($id==2){
			return 'Complete';	
		}else if($id==3){
			return 'Fail';	
		}else if($id==4){
			return 'Cancel';	
		}
	}
	
	function register_option($id=''){
		if($id==1){
			return '( อายุ 0-3 ปี )'; 
		}else if($id==2){
			return '( 4-12 ปี )';
		}else if($id==3){
			return '( 12 ปี ขึ้นไป )'; 
		}
	}	
	
	
	function payment_type($id=''){
		if($id=='T'){
			return 'Transfer';	
		}else if($id=='C'){
			return 'Credit';	
		}
	}	
 
	function send_email($mailto='',$subject='',$body='',$path=''){
		$CI = &get_instance();
		$CI->load->library('phpmailer');
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
	
	function generateRandomString($length = 10) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}
	
	function writeFile($vFilename,$vContents) {
		$fp = fopen($vFilename,"w");
		fputs($fp, $vContents, strlen($vContents));
		fclose($fp);
	}
	
	function openFile($vFilename) {
		$fp = @fopen($vFilename,"r");
		if ($fp == FALSE) { return false; }
		$buffer = "";
		while (!feof($fp)) {
			$buffer = fread($fp,1024*1024);
		}
		fclose($fp);
		return $buffer;
	}
?>