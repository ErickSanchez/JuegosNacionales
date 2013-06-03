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
	public function insertar_usuarios() {
		$this->load->database();
		$usernameCoach= $this->input->post("usernameCoach");
		$lastName= $this->input->post("lastName");
		$suretName= $this->input->post("sureName");
		$firstName= $this->input->post("firstName");
		$datos = array(
			'usernameCoach' => $usernameCoach,
			'lastName' => $lastName,
			'sureName' => $sureName,
			'firstName' => $firstName
		);
		$this->db->insert('participant',$datos);
	}
	public function insertar_anotador() {
		$this->load->database();
		$idannotador= $this->input->post("idannotador");
		$idevent= $this->input->post("idevent");
		$idparticipant= $this->input->post("idparticipant");
		$annotations= $this->input->post("annotations");
		$minute= $this->input->post("minute");
		$datos = array(
			'idannotador' => $idannotador,
			'idevent' => $idevent,
			'idparticipant' => $idparticipant,
			'annotations' => $annotations,
			'minute' => $minute
		);
		$this->db->insert('annotator',$datos);
	}
	public function insertar_direccion() {
		$this->load->database();
		$addressStreet= $this->input->post("addressStreet");
		$addressNumber= $this->input->post("addressNumber");
		$addressInteriorNumber= $this->input->post("addressInteriorNumber");
		$addressColony= $this->input->post("addressColony");
		$addressZip= $this->input->post("addressZip");
		$addressLocality= $this->input->post("addressLocality");
		$addressTownship= $this->input->post("addressTownship");
		$addressTown= $this->input->post("addressTown");
		$addressState= $this->input->post("addressState");
		$datos = array(
			'addressStreet' => $addressStreet,
			'addressNumber' => $addressNumber,
			'addressInteriorNumber' => $addressInteriorNumber,
			'addressColony' => $addressColony,
			'addressZip' => $addressZip,
			'addressLocality' => $addressLocality,
			'addressTownship' => $addressTownship,
			'addressTown' => $addressTown,
			'addressState' => $addressState
		);
		$this->db->insert('address',$datos);
		//$this->load->view("main/index");
		//response.redirect "localhost/proyecto/index.php/";
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
			case 101: $notify = array('msg'=>'Ingrese un Usuario y una Contraseña','type'=>'error'); break;
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