<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Service_c extends CI_Controller {

	var $ordering = '';

	public function __construct(){
		parent::__construct();
		
		header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
		header("Cache-Control: post-check=0, pre-check=0", false);
		header("Pragma: no-cache");

		$this->load->helper('url'); 
		
		$this->event = $this->config->item('event');
	}

	public function set_reserve(){

		$this->ordering = 1;
		$this->load->database();

		$reserve = array();
		
		// Backup 2018-05-07		
		// $reserve[] = '22-25';
		// $reserve[] = '37';
		// $reserve[] = '41';
		// $reserve[] = '45';
		// $reserve[] = '16-19';
		// $reserve[] = '20';
		// $reserve[] = '26';
		// $reserve[] = '32';
		// $reserve[] = '38';
		// $reserve[] = '42';
		// $reserve[] = '46';
		// $reserve[] = '52';
		// $reserve[] = '57';
		// $reserve[] = '62';
		// $reserve[] = '68';
		// $reserve[] = '73';
		// $reserve[] = '72';
		// $reserve[] = '71';
		// $reserve[] = '70';
		// $reserve[] = '10-14';
		// $reserve[] = '21';
		// $reserve[] = '27';
		// $reserve[] = '63';
		// $reserve[] = '69';
		// $reserve[] = '74';
		// $reserve[] = '79';
		// $reserve[] = '78';
		// $reserve[] = '77';
		// $reserve[] = '76';
		// $reserve[] = '5-9';
		// $reserve[] = '15';
		// $reserve[] = '1-4';
		// $reserve[] = '81-84';
		// $reserve[] = '80';
		// $reserve[] = '75';
		
		// $reserve[] = '13';
		$reserve[] = '15';
		// $reserve[] = '12';
		$reserve[] = '16';
		$reserve[] = '19';
		$reserve[] = '20';
		$reserve[] = '18';
		$reserve[] = '21';
		$reserve[] = '17';
		$reserve[] = '22'; 

		// Delete all event id 12
		// $this->db->where('event_id', '12');
		// $this->db->delete('events_reserve');		
		
		foreach ($reserve AS $v) {
			if (stripos($v, '-') !== FALSE) {
				list($begin, $end) = explode('-', $v);
				if (is_numeric($begin) && is_numeric($end)) {
					for ($i = $begin; $i <= $end; $i++) {
						// Set reserve [$i]
						$this->_set_reserve_table($i);
					}
				}
			} else if (is_numeric($v)) {
				// Set reserve [$v]
				$this->_set_reserve_table($v);
			}
		}
	}

	private function _set_reserve_table($table) {
		

		$pad_table = str_pad($table, 2, 0, STR_PAD_LEFT);

		for ($i = 1; $i <= 8; $i++) {

			$reserve_code = $pad_table . str_pad($i, 2, 0, STR_PAD_LEFT);
			echo "Set reserve code : {$reserve_code}<br>";
			
			// Set reserve here
			// $data = array();
			// $data['event_id'] = '12';
			// $data['reserve_code'] = $reserve_code;
			// $data['ordering'] = $this->ordering;
			// $this->db->insert('events_reserve', $data);
			// $this->db->insert_id();

			$this->ordering++;

		}
	}
	
	public function show_reserve_ordering() {
		
		$this->load->database();
		
		$this->db->select("*");
		$this->db->where("event_id", "12");
		$this->db->order_by("ordering", "asc");
		$result = $this->db->get('events_reserve');
		$arr = $result->result_array(); 
		
		foreach ($arr AS $v) {
			echo "Reserve code : " . $v['reserve_code'];
			echo "<br>";
		}
	}

	public function confirmation() {
		
		// Confirm yes
		$check_name = array();
		$count_yes = 0;
		$_filecsv = APPPATH . "logs/confirm_yes.php";
		$row = 0;
		if (($handle = fopen($_filecsv, "r")) !== false) {
			$row = 0;
			while (($data_yes = fgetcsv($handle, 1000, ",")) !== false) {
				$name = $data_yes[0];
				$email = $data_yes[1];
				$datetime = $data_yes[2];

				if (!in_array($name, $check_name)) {
					$data['yes'][$row]['name'] = $name;
					$data['yes'][$row]['email'] = $email;
					$data['yes'][$row]['datetime'] = $datetime;
					$count_yes++;
					$check_name[] = $name;
				}

				$row++;
			}
		}
		
		// Confirm no
		$check_name = array();
		$count_no = 0;
		$_filecsv = APPPATH . "logs/confirm_no.php";
		$row = 0;
		if (($handle = fopen($_filecsv, "r")) !== false) {
			$row = 0;
			while (($data_no = fgetcsv($handle, 1000, ",")) !== false) {
				$name = $data_no[0];
				$email = $data_no[1];
				$datetime = $data_no[2];

				if (!in_array($name, $check_name)) {
					$data['no'][$row]['name'] = $name;
					$data['no'][$row]['email'] = $email;
					$data['no'][$row]['datetime'] = $datetime;
					$count_no++;
					$check_name[] = $name;
				}

				$row++;
			}
		}

		$data['count']['yes'] = $count_yes;
		$data['count']['no'] = $count_no;

		// print_r($data);

		$this->load->view('yes_no_confirmation', $data); 
	}

	public function check_mail_template()
	{
		$data_mail['name'] = '{Name}';
		$data_mail['code'] = '1234';
	
		$data['data'] = $data_mail;
						
		$subject = $this->event['title'];
		echo $this->load->view('mail/mail_template', $data, TRUE);
	}
}
