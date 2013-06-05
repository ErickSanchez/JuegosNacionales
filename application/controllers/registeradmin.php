<?php if(!@defined('BASEPATH')) exit('No direct script access allowed');

class Registeradmin extends CI_Controller {

    public function __construct() {
        parent::__construct();
		if(!$this->session->userdata('logged_in'))
        	redirect('/login', 'refresh');
		$this->load->helper('form');
        $this->load->model('participantmodel');
        $this->load->model('stateadminmodel');
		$this->load->model('registeradminmodel');
        $this->load->model('teammodel');
        $this->load->model('usermodel');
    }
	
    public function index(){
		$data['username']=$this->session->userdata('username');
                
		$userType=$this->session->userdata('userType');
                
		if($userType != COORDINATOR_NATIONAL)
			redirect('/login/redir_section/'.$userType, 'refresh');

		$data['sports_teams_resume']=$this->registeradminmodel->count_teams_by_sport();
		$data['teams'] = $this->registeradminmodel->get_teams();
		$data['totals'] = array();
		
		foreach($data['teams'] as $row){
			$data['totals'][] = $this->teammodel->get_num_participants($row->idteam);
		}

        $data['title']="Resumen de Selecciones ";
		$data['style']='state-admin';
		$data['leftcolumn']="registeradmin-left-column";
		$data['searchForm'] = $this->load->view('registeradmin-search-form',$data, true);
        $data['content']="register-admin";
		$data['index'] = $this->load->view('nacional-index-teams',$data, true);
                
		$this->load->view('includes/template',$data);
	}
	
	public function nacional($idstate=NULL){
		$data['username']=$this->session->userdata('username');
                
		$userType=$this->session->userdata('userType');
                
		if($userType!=3)
			redirect('/login/redir_section/'.$userType, 'refresh');

		$data['sports_teams_resume']=$this->registeradminmodel->count_teams_by_sport();
		if(isset($idstate))
			$data['teams'] = $this->registeradminmodel->get_teams_by_state($idstate);
		else{
			$data['teams'] = $this->registeradminmodel->get_teams();
			$data['index'] = $this->load->view('nacional-index-teams',$data, true);
		}
		$data['totals'] = array();
		
		foreach($data['teams'] as $row){
			$data['totals'][] = $this->teammodel->get_num_participants($row->idteam);
		}

        $data['title']="Resumen de Selecciones ";
		$data['style']='state-admin';
		$data['leftcolumn']="registeradmin-left-column";
        $data['content']="registeradmin-nacional-teams";
                
		$this->load->view('includes/template',$data);
	}
	
	public function expedient($idparticipant=0,$idteam=0){
	 //$this->load->helper('dompdf_helper'); 
		$data['team'] = $this->teammodel->get_team_info($idteam);
		$data['participant']=$this->participantmodel->get_participant_info($idparticipant);
		$this->load->view('generate/expedient',$data);
		//$html= $this->load->view('generate/expedient',$data,true);
		//pdf_create($html,'expedient');
	}
	
	public function generate($docType=0,$idteam=0){
       //   $this->load->library('fpdf/fpdi');
	 $this->load->helper('dompdf_helper'); 
	 //$this->load->helper('pdf_helper'); 
          
		if($_POST){
			$docType=$_POST['docType'];
			$idteam=$_POST['team'];
		}
		$data['team'] = $this->teammodel->get_team_info($idteam);
		$data['participants'] = $this->teammodel->get_participants($idteam);
		switch($_POST['docType']){
			case 1: //cedula
				       $html= $this->load->view('generate/cedula',$data,true);
                                pdf_create($html,'cedula');
				break;
			case 2: //credenciales
					  $html= $this->load->view('generate/credenciales',$data,true);
                                pdf_create($html,'credencial');
				break;
			case 3: //acta&historial
                          /*
                            $files=array();
                        
                            foreach($data['participants'] as $row)
                            {
                                $files[]=$row->idparticipant.'/'.$row->fileBirthCertificate;
                               $files[]=$row->idparticipant.'/'.$row->fileAcademicHistory;
                                
                            }
                              
                            		pdf_concat($files);*/
				break;
		}
	}

	public function get_states($idstate){

            $data['tag']= array(
                    'id'=>'idstate',
                    'name'=>'stateName');

             $data['arr']=$this->stateadminmodel->get_states($idstate);
             $data['unique']='unique';
             $this->load->view('includes/select',$data);
    }
	
	public function get_sportcategory_by_state($idstate){
            $data['tag']= array(
                    'id'=>'idteam',
                    'name'=>'sportcategory');

             $data['arr']=$this->registeradminmodel->get_sportcategory_by_state($idstate);
             $this->load->view('includes/select',$data);
    }
	
	public function search(){
            
		if(strlen(@$_POST['p_lastName']) || strlen(@$_POST['p_sureName']) || strlen(@$_POST['p_firstName']) || strlen(@$_POST['p_schoolEnrollment']) || strlen(@$_POST['p_curp']))
                    $data['result'] = $this->registeradminmodel->search_participant($_POST['p_lastName'],$_POST['p_sureName'],$_POST['p_firstName'],$_POST['p_schoolEnrollment'],$_POST['p_curp']);
                
                $data['username']=$this->session->userdata('username');
		$data['title']="Buscar";
		$data['style']='state-admin';
		$data['leftcolumn']="registeradmin-left-column";
		$data['searchForm'] = $this->load->view('registeradmin-search-form',$data, true);
            $data['content']="search-registeradmin";
                
		$this->load->view('includes/template',$data);
	}
}