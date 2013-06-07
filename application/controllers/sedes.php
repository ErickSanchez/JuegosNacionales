<?php if ( !defined('BASEPATH')) exit('No direct script access allowed');

class Sedes extends CI_Controller {

    public function __construct() {
        parent::__construct();
	  $this->load->helper('form');
         $this->load->library(array('form_validation'));	
        $this->load->model('eventmodel');
                
    }
	
	public function index($idsede=0)
	{
		$data['sedes']=$this->eventmodel->get_sedes();
		$data['username']=$this->session->userdata('username');
		$data['title']="Sedes";
		$data['style']="index";
		if($idsede!=0)
			$data['slider']="gMaps-".$idsede;
		else
			$data['slider']="gMaps-morelia";
		$data['content']="sedes-content";
		$data['rightcolumn']="events/events-right-column";
		$this->load->view('includes/front',$data);            
	}
}
