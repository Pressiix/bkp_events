<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Util_m extends CI_Model {
		public function __construct(){
			parent::__construct();
			$this->load->helper('url');		
		}
		
		public function writeFile($vFilename="", $vContent){
			$fp = fopen($vFilename, "w");
			if (flock($fp, LOCK_EX)) { 
				fputs($fp, $vContent, strlen($vContent));
				flock($fp, LOCK_UN); // release the lock 
				}else{ 
				fclose($fp);
				return false;
			} 
			fclose($fp);
			return true;
		}
		
		public function substring_text($str, $start, $end){
			$total = mb_strlen($str, 'utf-8');
			if($end < $total){
				$str = iconv_substr($str, $start, $end, "UTF-8")."...";
			}
			return $str; 
		}
		
		public function doRedirect($theURL){
			header('Location: '.$theURL);
			exit;
		}
		
		public function doRedirect301($thisURL){
			header("Location: ".$thisURL, true, 301); 
			exit();
		}
		
		function generateCode($length = 8,$type=''){
			$randomString = "";
			if($type=='number'){
				$possible = "0123456789"; 
			}else{
				$possible = "0123456789ABCDFGHJKMNPQRSTVWXYZ"; 
			}
			$i = 0; 
			while ($i < $length) { 
				$char = substr($possible, mt_rand(0, strlen($possible)-1), 1);
				if (!strstr($randomString, $char)) { 
					$randomString .= $char;
					$i++;
				}
			}
			return $randomString;
		}
		
		function writeFileLogs($vFilename,$vContents) {
			$fp = fopen($vFilename,"a+");
			fputs($fp, $vContents, strlen($vContents));
			fclose($fp);
		}
		
		function randCode(){
			$_filelogs = "logs/generate_code/rand_logs.txt"; // "log/rand_logs.txt";
			$text = $this->generateCode(5,'number');

			$handle = fopen($_filelogs, "r"); // "rb" for windows // etc "r"
			$contents = @fread($handle, filesize($_filelogs));
			fclose($handle);
 			if($contents){
				$arr = explode(",",$contents);

				while(in_array($text, $arr)) {
					$text = $this->generateCode(5,'number');
				}

				$_logsDesc = ",".$text;
			}else{
				$_logsDesc = $text;
			} 

			$this->writeFileLogs($_filelogs,$_logsDesc);
			return $text;
		}
		
	}
?>