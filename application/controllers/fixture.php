<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class fixture extends CI_Controller {
		public function usuarios() {
				$this->load->database();
				$this->load->library('table');
				$usuarios=$this->db->get('usuarios');
				$usuarios = array(
					array(
					'id' => 17,
					'nombre' => 'juan',
					'email' => 'juan@juan.com',
					),
					array(
					'id' => 18,
					'nombre' => 'juan2',
					'email' => 'juan2@juan.com',
					),
					array(
					'id' => 19,
					'nombre' => 'juan3',
					'email' => 'juan3@roberto.com',
					),			
				);
				$this->db->insert_batch('usuarios', $usuarios);
		}
		public function publicaciones(){
				$this->load->database();
				$publicaciones=$this->db->get('publicaciones');
				$publicaciones=array(
					array(
					'id' => 8,
					'nombre' => 'juan',
					'contenido' => 'Este es un archivo de texto',
					),
					array(
					'id' => 9,
					'nombre' => 'juan2',
					'contenido' => 'Este es un archivo de texto2',					),
					array(
					'id' => 10,
					'nombre' => 'juan3',
					'contenido' => 'Este es un archivo de texto3',
					),
		    );
			$this->db->insert_batch('publicaciones', $publicaciones);			
		}
		public function index() {
			if(ENVIRONMENT =='development') {
				$this->usuarios();
				$this->publicaciones();
			}	
		}
	}
?>
