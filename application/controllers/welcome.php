<?php if ( !defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

    public function __construct() {
        parent::__construct();
		
    }
	
	public function index()
	{
		$data['username']=$this->session->userdata('username');
        $data['title']="";
        $data['style']="index.css";
        $data['slider']="slider";
        $data['content']="index-content";
		$data['rightcolumn']="index-right-column";
		$this->load->view('includes/front',$data);
 
            
	}

}
