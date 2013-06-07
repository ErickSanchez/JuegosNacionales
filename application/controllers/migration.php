<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Migration extends CI_Controller{

	public function index($version = 0){
		$this->load->library('migration');
		$message = 'Entorno no apto para hacer migraciones';
		
		if(ENVIRONMENT == 'development'){
			$message = 'Las Migraciones se han aplicaron con exito';
			if(!$this->migration->version($version)){
				$message = $this->migration->error_string();
			}

		}
		echo $message;
	}
}