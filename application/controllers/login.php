<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	
	function __construct(){
		parent::__construct();
		
		$this->load->helper('form');
	}
	function index(){
            
		if($this->session->userdata('logged_in'))
			redirect('/login/redir_section/'.$this->session->userdata('userType'), 'refresh');
                
		$data['title']="Iniciar Sesión";
		$data['style']="admin.css";
		$data['content']="login";
		$data['leftcolumn']="left-column";
		$this->load->view('includes/template',$data);
	}
	
	public function redir_section($userType){
	
		switch($userType){
					case COORDINATOR_STATE: redirect('/stateadmin', 'refresh'); break;
					case COORDINATOR_TEAM: redirect('/stateadmin/view_team', 'refresh'); break;
					case COORDINATOR_NATIONAL: redirect('/registeradmin', 'refresh'); break;
					default: redirect('/', 'refresh'); break;
		}
	}
	
	function signIn(){
            
		$this->load->model('usermodel');
		if(isset($_POST['username']) && isset($_POST['password']))
                 {
			$data['status']=$this->usermodel->validate_user($_POST['username'],$_POST['password']);
			$userType=$this->usermodel->get_userType($_POST['username'],$_POST['password']);
				
			if($data['status']->find)
                        {
				$userdata = 	array(
							   'username'  => $_POST['username'],
							   'userType'  => $userType->iduserType,
							   'logged_in' => TRUE
							);
				$this->session->set_userdata($userdata);

				$this->redir_section($userType->iduserType);
			}
			else
				redirect('/login/error/102', 'refresh');
		}
		else
			redirect('/login/error/101', 'refresh');
	}
	
	
	function error($iderror){
		switch($iderror){
			case 101: $notify = array('msg'=>'Ingrese un Usuario y una Contrraseña','type'=>'error'); break;
			case 102: $notify = array('msg'=>'Usuario o contraseña incorrectos','type'=>'error'); break;
			case 103: $notify = array('msg'=>'Coordinador de estado no registrado','type'=>'error'); break;
			default: $notify = array('msg'=>'Error','type'=>'error'); break;
		}
		$data['title']="Iniciar Sesión";
		$data['style']="admin.css";
		$data['content']="login";
		$data['notification']=$notify;
		$data['leftcolumn']="left-column";
		$this->load->view('includes/template',$data);
	}
        
	function logout($url = '',$id = ''){
		if($id)
			$id = '/'.$id;
		$this->session->sess_destroy();
		redirect('/login/'.$url.$id, 'refresh');
	}
}