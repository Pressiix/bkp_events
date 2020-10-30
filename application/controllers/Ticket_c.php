<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ticket_c extends CI_Controller {
	public function __construct(){
		parent::__construct();
		// $this->event = $this->config->item('event');
	}

	public function get_ticket($action = ''){
		// if (stripos($_SERVER['HTTP_REFERER'], 'bangkokpost.com') === false) {				
			// exit;
		// }
		
		// Config position x
		$config_position_x[1] = 795;
		$config_position_x[2] = 760;
		$config_position_x[3] = 725;
		$config_position_x[4] = 690;
		$config_position_x[5] = 660;
		$config_position_x[6] = 630;
		$config_position_x[7] = 600;
		$config_position_x[8] = 555;
		
		header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
		header("Cache-Control: post-check=0, pre-check=0", false);
		header("Pragma: no-cache");
		
		$code = $this->input->get('code');
		$action = $this->input->get('action');
		$temp_code = explode(',', $code);
		
		$arr_code = array();
		$text_code = '';
		foreach ($temp_code AS $v) {
			if ($v != '')  {
				$arr_code[] = $v;
				if ($text_code != '') $text_code .= ', ';
				$text_code .= $v;
			}
		}
		if (!$arr_code) exit;
		
		$count_code = count($arr_code);
	
		if ($action == 'download'){
			
			//Detect special conditions devices
			$iPod    = stripos($_SERVER['HTTP_USER_AGENT'],"iPod");
			$iPhone  = stripos($_SERVER['HTTP_USER_AGENT'],"iPhone");
			$iPad    = stripos($_SERVER['HTTP_USER_AGENT'],"iPad");
			$Android = stripos($_SERVER['HTTP_USER_AGENT'],"Android");
			$webOS   = stripos($_SERVER['HTTP_USER_AGENT'],"webOS");
			if($iPod || $iPhone || $iPad){
				// not work
				header("Content-Type: application/octet-stream");
				header('Content-Disposition: attachment; filename="marshall_ticket.jpg"');
			}else{
				// Download automatically
				header("Content-disposition: attachment; filename=marshall_ticket.jpg");
			}
			
		}else{
			header('Content-Type: image/jpeg');
		}
		
		// Image path
		$imgPath = 'resources/img/rally/card.jpg';
		
		$im = imagecreatefromjpeg($imgPath);

		// Create some colors
		$red = imagecolorallocate($im, 238, 28, 37);
		
		// The text to draw
		$text = $text_code; 
		
		// Replace path by your own font path
		$font = 'resources/font/Mitr-300.ttf';
		// $fontSize = 28;
		$fontSize = 17;
		
		// Text position		
		$x = $config_position_x[$count_code];
		$y = 325;
		
		// Add the text
		imagettftext($im, $fontSize, 0, $x, $y, $red, $font, $text);
		imagejpeg($im,NULL,120);
		imagedestroy($im);
	} 
}
