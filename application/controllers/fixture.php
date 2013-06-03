<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class fixture extends CI_Controller {
		public function anotador() {
				$this->load->database();
				$usuarios = array(
					array(
					'idannotador' => 17,
					'idevent' => '235',
					'idparticipant' => '56',
					'annotations' => '2',
					'minute' => '45',
					),
					array(
					'idannotador' => 18,
					'idevent' => '236',
					'idparticipant' => '57',
					'annotations' => '3',
					'minute' => '46',					
					),
					array(
					'idannotador' => 19,
					'idevent' => '237',
					'idparticipant' => '58',
					'annotations' => '4',
					'minute' => '47',
					),			
				);
				$this->db->insert_batch('annotador', $usuarios);
		}
		
		public function index() {
			if(ENVIRONMENT =='development') {
				$this->usuarios();
				$this->publicaciones();
			}	
		}
	}
?>
