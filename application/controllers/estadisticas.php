<?php if ( !defined('BASEPATH')) exit('No direct script access allowed');

class Estadisticas extends CI_Controller {

    public function __construct() {
        parent::__construct();
		$this->load->model('eventmodel');
		$this->load->model('estadisticasmodel');
    }
	
	public function index(){
		$this->tabla_general();
	}
	public function tabla_general($sport='Futbol')
	{
		$data['events']    = $this->record($sport);
		$data['sedes']     = $this->eventmodel->get_sedes();
		$data['username']  = $this->session->userdata('username');	
		$data['sports']    = $this->eventmodel->get_sport();        
		$data['sportName'] =  mb_strtoupper($sport, 'UTF-8');
		$data['title']     = "Estadisticas";
        $data['style']     = "events";
		if($sport == 'Ajedrez')
			$data['content'] = 'events/no-schedule';
		else
			$data['content'] = "general_table";
			
		$data['leftcolumn']  = "estadisticas-left-column";
                
		$this->load->view('includes/template',$data);         
	}
	public function record($sport='Futbol'){
		return $this->estadisticasmodel->get_table($sport);
	}
}