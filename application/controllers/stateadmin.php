<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Stateadmin extends CI_Controller {

    public function __construct() {
        parent::__construct();
       if(!$this->session->userdata('logged_in'))
        	redirect('/login', 'refresh');
		$this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('stateadminmodel');
        $this->load->model('teammodel');
        $this->load->model('signupmodel');
        $this->load->model('usermodel');
    }
    
	public function index()
	{
		$data = $this->load_panel();
                
		$this->load->view('includes/template',$data);
    }
	
	public function load_panel(){
		
		$data['username']=$this->session->userdata('username');
                
		$userType = $this->session->userdata('userType');

		
		if($userType != COORDINATOR_STATE){
			redirect('/login/redir_section/'.$userType, 'refresh');

		}
		
		$data['state'] = $this->stateadminmodel->get_state_by_coordinator($data['username']);      
                
		$data['coordinator'] = $this->stateadminmodel->get_coordinator_info($data['username']);
                    if(!@$data['coordinator']->username)
                        redirect('/login/logout/error/103', 'refresh');
                
                        
		$data['teams']=$this->stateadminmodel->get_teams($data['username']);
		$data['totals'] = array();

         	foreach($data['teams'] as $row){
			$data['totals'][] = $this->teammodel->get_num_participants($row->idteam);
		}

	$data['sports']=$this->stateadminmodel->get_sport($data['username']);

        $data['title']="Registro de Selecciones ";
		$data['style']='state-admin.css';
		$data['leftcolumn']="left-column-state";
        $data['content']="state-admin";
		return $data;		
	}
	
	public function load_view_team_panel($idteam=0,$idsport=0){

		$data['username']=$this->session->userdata('username');

		$userType = $this->usermodel->get_userType($data['username']);

		switch(@$userType->iduserType){
			case COORDINATOR_STATE: if($idteam==0 || $idsport==0)
						redirect('/stateadmin', 'refresh');
				break;
			case COORDINATOR_TEAM: $idteam=$this->usermodel->get_idteam_by_coach($data['username']);

					if(!empty($idteam)){
						$idteam=$idteam->idteam;
						$idsport=$this->teammodel->get_sport_by_idteam($idteam);
						$idsport=$idsport->idsport;
					}
					else
						$idteam = 0;
				break;
			case COORDINATOR_NATIONAL: 
				break;
            default: redirect('/login/logout', 'refresh');
                
        }

        $data['team']=$this->teammodel->get_team_info($idteam);
        $data['sport']=$idsport;
		$data['style']='state-admin.css';
		$data['leftcolumn']="left-column-state";
		return $data;	
	}
	
	public function view_team($idteam=0,$idsport=0,$status=NULL){
	
		$data=$this->load_view_team_panel($idteam,$idsport);
		
		if($data['team']){
			$idteam = $data['team']->idteam;
			$data['coach']=$this->teammodel->get_coach($idteam);
			$data['participants']=$this->teammodel->get_participants($idteam);
			$data['participants_total']=$this->teammodel->get_num_participants($idteam);
			$data['participants_limits']=$this->teammodel->get_sport_limits($idteam);
			$data['participants_check']= $this->check_data($data['participants']);
		}
		$data['title']="Equipo";
        $data['content']="view-team";
		$this->load->view('includes/template',$data);
	}

	function validate_select($value){
            if(is_null($value))
                return false;
            return true;
        }
	public function add_team(){
		$userMail=$this->usermodel->get_email($this->session->userdata('username'));
		$userMail = $userMail->userEmail;
        if($userMail){	
			$this->form_validation->set_rules('sport', 'un Deporte', 'callback_validate_select');
			$this->form_validation->set_rules('city', 'una Ciudad', 'callback_validate_select');
			$this->form_validation->set_rules('sport-category', 'una Categoria', 'callback_validate_select');
			$this->form_validation->set_rules('campus', 'un Plantel', 'callback_validate_select');
			$this->form_validation->set_rules('cct', 'CCT', 'required|exact_length[10]');
			$this->form_validation->set_rules('cct-confirm', 'confirmacion de CCT', 'required|exact_length[10]');

			$this->form_validation->set_message('required', 'La %s es obligatoria');
			$this->form_validation->set_message('validate_select', 'Selecciona %s </br></br>');
			$this->form_validation->set_message('exact_length', 'La %s es de 10 digitos</br></br>');
			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');

			if($this->form_validation->run() == false)
                        {
				$data = $this->load_panel();
                                
				$notify = array('msg'=>'<b>Ingrese todos los datos solicitados</b>','type'=>'error');
				$data['notification']=$notify;
				$this->load->view('includes/template',$data);
			}
			else{
				if(isset($_POST['cct']) && isset($_POST['cct-confirm']) && strlen($_POST['cct-confirm'])==10)
                                    {
					if(!strcmp($_POST['cct'],$_POST['cct-confirm']))
                                            {
						$data['state']=$this->stateadminmodel->get_state_by_coordinator($this->session->userdata('username'));
						if(isset($_POST['sport-category']) && isset($_POST['campus']) && $_POST['sport-category']>0 && strlen($_POST['campus'])>0)
                                                    if(!$this->stateadminmodel->exist_team($data['state']->idstate, $_POST['campus'],$_POST['sport-category']))
                                                        {
								$cct = $this->stateadminmodel->get_campus_cct($_POST['campus']);
								$status=TRUE;
								if(!strlen($cct->cct))
									$this->stateadminmodel->set_campus_cct($_POST['campus'],$_POST['cct']);
								else
									if(strcmp($cct->cct,$_POST['cct'])){
										$this->error(504);
										$status = FALSE;
									}
								if($status){
									$idteam = $this->stateadminmodel->add_team($_POST['campus'],$_POST['sport-category']); //agrega equipo
									if($idteam->idteam){
										$team = $this->teammodel->get_team_info($idteam->idteam);
										$this->create_user(2,$team);	//crea usuario para administracion de equipo
									}
									$data = $this->load_panel();
									$notify = array('msg'=>'<b>Seleccion agregada correctamente.</b><br />Los datos de acceso al equipo se enviaron a '.$userMail,'type'=>'ok');
									$data['notification']=$notify;
									$this->load->view('includes/template',$data);
								}
							}
                                                        else
                                                         $this->error(505);

					}
					else
						$this->error(503);
				}
				else
					$this->error(502);
			}
		}
		else
			$this->error(501);
	}

public function delete_team($idteam=0){
	 $accesso=false;     
        
	if(isset($idteam) && $idteam > 0)
            {
               
            $this->load->library('dir');
            $ids=$this->stateadminmodel->get_idteams_by_coordinator($this->session->userdata('username'));
            
            foreach($ids as $row)
            {
               if($row->idteam == $idteam)
               {
                   
                   $this->db->trans_start();
                        $idparticipants=$this->teammodel->get_idparticipants($idteam);//Recuperar los IDS de los participantes para eliminar sus archivos
                    	$user = $this->create_username_coach($idteam); //Recuperar el coach del equipo para eliminarlo de la tabla user (Lo Vuelve a generar de nuevo)
			$this->stateadminmodel->delete_team($idteam); //Elimina el equipo
                        
                   $this->usermodel->delete_user($user); //Elimina el coach del equipo eliminado
                    $this->db->trans_complete();
                    
                    if($this->db->trans_status()) //Si se completo la operacion de eliminacion de los participantes eliminar sus archivos
                    {
                        foreach($idparticipants as $row)
                             if($row->idparticipant)
                                    $this->dir->delete(PATH_FILES.$row->idparticipant); //Eliminar un directorio completo
                             
                       $notify = array('msg'=>'<b>Seleccion eliminada correctamente.</b>','type'=>'ok');
                    }
                    else
                        $notify = array('msg'=>'<b>Hubo un error al intentar eliminar el equipo.</b>','type'=>'error');
                 
                 $accesso=true;
		  break;
               }
            }
            
            if(!$accesso)
            {
                 $notify = array('msg'=>'<b>No tienes permiso para eliminar este equipo.</b>','type'=>'error');
            }

	}
        else
          $notify = array('msg'=>'<b>Esta ruta es invalida.</b>','type'=>'error');
                
		$data = $this->load_panel();
			
			$data['notification']=$notify;
			$this->load->view('includes/template',$data);
	}

	public function check_data($participants){
		$check_log = array();
		foreach($participants as $row){
			$participant = array();			
			$participant['idparticipant'] = $row->idparticipant;
			$log = array();
			//text fields validation
			if(!isset($row->lastName) || !strlen($row->lastName))
				array_push($log,'Apellido paterno');
			if(!isset($row->sureName) || !strlen($row->sureName))
				array_push($log,'Apellido materno');
			if(!isset($row->firstName) || !strlen($row->firstName))
				array_push($log,'Nombre(s)');
			if(!isset($row->email) || !strlen($row->email))
				array_push($log,'Email');
			if(!isset($row->turn) || !strlen($row->turn))
				array_push($log,'Turno');
			if(!isset($row->curp) || !strlen($row->curp))
				array_push($log,'CURP');
			if(!isset($row->curpFile) || !strlen($row->curpFile))
				array_push($log,'CURP (Archivo anexo)');
			if(!isset($row->bloodType) || !strlen($row->bloodType))
				array_push($log,'Tipo de sangre');
			if(!isset($row->emergencyName) || !strlen($row->emergencyName))
				array_push($log,'Nombre en caso de emergencia');
			if(!isset($row->filePhoto) || !strlen($row->filePhoto))
				array_push($log,'Fotografía');
			if(!isset($row->schoolEnrollment) || !strlen($row->schoolEnrollment))
				array_push($log,'Matrícula escolar');
			if(!isset($row->group) || !strlen($row->group))
				array_push($log,'Grupo escolar');
			if(!isset($row->schoolState) || !strlen($row->schoolState))
				array_push($log,'Estado escolar');
			if(!isset($row->fileBirthCertificate) || !strlen($row->fileBirthCertificate))
				array_push($log,'Acta de nacimiento (Archivo anexo)');
			if(!isset($row->fileSchoolCertificate) || !strlen($row->fileSchoolCertificate))
				array_push($log,'Constancia (Archivo anexo)');
			if(!isset($row->fileAcademicHistory) || !strlen($row->fileAcademicHistory))
				array_push($log,'Historial académico (Archivo anexo)');
			if(!isset($row->fileStudentCardFront) || !strlen($row->fileStudentCardFront))
				array_push($log,'Credencial de estudiante (Anverso, Archivo anexo)');
			if(!isset($row->fileStudentCardBack) || !strlen($row->fileStudentCardBack))
				array_push($log,'Credencial de estudiante (Reverso, Archivo anexo)');
			if(!isset($row->allergies) || !strlen($row->allergies))
				array_push($log,'Alergias');
			if(!isset($row->chronicDiseases) || !strlen($row->chronicDiseases))
				array_push($log,'Enfermedades crónicas');
			//date fields validation
			if(!isset($row->birthdate))
				array_push($log,'Fecha de Nacimiento');
			else{
				$birthdate = explode('-',$row->birthdate);
				if($birthdate[0]<1) //year validation
					array_push($log,'Año de nacimiento');
				if($birthdate[1]<1) //month validation
					array_push($log,'Mes de nacimiento');
				if($birthdate[2]<1) //day validation
					array_push($log,'Dia de nacimiento');
			}
				
			//phone fields validation
			/*
			if(!isset($row->phone) || strlen($row->phone)<7)
				array_push($log,'Teléfono local');
			if(!isset($row->cellphone) || strlen($row->cellphone)<7)
				array_push($log,'Celular');*/
			if(!isset($row->emergencyPhone) || strlen($row->emergencyPhone)<7)
				array_push($log,'Teléfono en caso de emergencia');
			
			//number  fields validation
			if(!isset($row->jerseyNumber) || $row->jerseyNumber==0)
				array_push($log,'Número de camiseta');
			if(!isset($row->semester) || $row->semester==0)
				array_push($log,'Semestre');
			$participant['log'] = $log;
			array_push($check_log,$participant);
		}
		return $check_log;
	}
        
    public function error($iderror,$userType=0){
		$data=$this->load_panel();
		switch($iderror)
                {
			case 501: $notify = array('msg'=>'Registre su email (Esta dirección recibirá la información de acceso para cada selección)','type'=>'error'); break;
			case 502: $notify = array('msg'=>'Ingrese la CCT y su confirmación correctamente.','type'=>'error'); break;
			case 503: $notify = array('msg'=>'La CCT y su confirmación no coinciden','type'=>'error'); break;
			case 504: $notify = array('msg'=>'La CCT es incorrecta','type'=>'error'); break;
                        case 505: $notify = array('msg'=>'Equipo ya registrado','type'=>'error'); break;
                        case 506: $notify = array('msg'=>'No tiene permisos para eliminar este equipo','type'=>'error'); break;
			default: $notify = array('msg'=>'Error','type'=>'error'); break;
		}
		switch($userType){
			case COORDINATOR_STATE: $data['content']="state-admin"; break;
			case COORDINATOR_TEAM: $data['content']="view-team"; break;
		}
		$data['notification']=$notify;
		$this->load->view('includes/template',$data);
	}

	public function get_states($idstate){

            $data['tag']= array(
                    'id'=>'idstate',
                    'name'=>'stateName');

             $data['arr']=$this->signupmodel->get_states($idstate);
             $data['unique']='unique';
             $this->load->view('includes/select',$data);
    }
	public function get_cities($idstate){

            $data['tag']= array(
                    'id'=>'idcity',
                    'name'=>'cityName');

             $data['arr']=$this->signupmodel->get_cities($idstate);
             $this->load->view('includes/select',$data);
    }

       public function get_campus($idcity){

            $data['tag']= array(
                    'id'=>'idcampus',
                    'name'=>'campusName');
             $data['arr']=$this->stateadminmodel->get_campus($idcity);
             $this->load->view('includes/select',$data);
       }
       public function get_sport($idstate=0){

            $data['tag']= array(
                    'id'=>'idsport',
                    'name'=>'sportName');
             $data['arr']=$this->stateadminmodel->get_sport($idstate);
             $this->load->view('includes/select',$data);
       }
	   public function get_sportcategory($idsport,$idstate=0){

            $data['tag']= array(
                    'id'=>'idsportCategory',
                    'name'=>'sportCategoryName');
             $data['arr']=$this->stateadminmodel->get_sportcategory($idsport,$idstate);
             $this->load->view('includes/select',$data);
       }
	   function set_coordinator_info(){

         if($this->session->userdata('username'))
              if(@$_POST)
		      $this->stateadminmodel->update_coordinator_info($_POST,@$this->session->userdata('username'));
          redirect('/stateadmin', 'refresh');
        }

	//users functions
	function create_user($newUserType,$parms){
		
            if(!isset($newUserType) || !isset($parms))
			redirect('/login', 'refresh');
                
        $username=$this->session->userdata('username');
        $userType=$this->session->userdata('userType');
        
        $userMail=$this->usermodel->get_email($username);
		switch($newUserType){
			case 2:	if($userType== COORDINATOR_STATE)
                                    {
					$newPass = $this->random_password();
					$newUsername = $this->create_username_coach($parms->idteam);
					if($this->usermodel->new_user($newUserType,$newUsername,$newPass)){
						$this->add_default_coach($parms->idteam,$newUsername);
						$parms = array(
							'username' => $newUsername, 
							'password' => $newPass, 
							'coordinator' => $username, 
							'campusName' => $parms->campusName, 
							'sportName' =>$parms->sportName,
							'sportCategoryName' =>$parms->sportCategoryName
							);
            
                         			$this->send_mail($userMail->userEmail,'Nueva Seleccion Registrada: '.$newUsername,$parms);
						}
					}
				break;
		}
		return false;
	}

	function create_username_coach($idteam){
		
            $team = $this->teammodel->get_team_info($idteam);
		if($team){
			$sportKey='';
			switch($team->sportName){
				case 'FUTBOL': $sportKey='FB'; break;
				case 'BASQUETBOL': $sportKey='BB'; break;
				case 'VOLEIBOL': $sportKey='VB'; break;
				case 'ORATORIA': $sportKey='OR'; break;
				case 'DECLAMACIÓN': $sportKey='DE'; break;
				case 'AJEDREZ': $sportKey='AJ'; break;
			}
                        
			$categoryKey = $this->remove_accents($team->sportCategoryName);
                        
			$stateWords = explode(' ',$team->stateName);
			if(count($stateWords)>1)
                        {
                            //if($team->stateName == 'MICHOACAN (SEDE)')
                            if($this->session->userdata('username') == 'sede_2012' )
                                $stateKey='SEDE';
                            else
				$stateKey=$team->stateName[0].$team->stateName[1].$stateWords[count($stateWords)-1][0];
                        }
			else
				$stateKey=$team->stateName[0].$team->stateName[1].$team->stateName[2];
                        
			return $sportKey.$categoryKey[0].'_'.$stateKey;
		}
		return 0;
	}
        
 function remove_accents($str){
      
        $tofind = "ÀÁÂÃÄÅàáâãäåÒÓÔÕÖØòóôõöøÈÉÊËèéêëÌÍÎÏìíîïÙÚÛÜùúûüÿÑñ";
        $replac = "AAAAAAaaaaaaOOOOOOooooooEEEEeeeeIIIIiiiiUUUUuuuuyNn";
    
        return strtr(utf8_decode($str),utf8_decode($tofind),$replac);
  }
	private function add_default_coach($idteam,$username){
		$participant = array(
                   'idteam' => $idteam ,
                   'usernameCoach' => $username,
                   'lastName' => '',
                   'sureName' => '',
                   'firstName' => '');

                $this->db->trans_start();
                    $this->signupmodel->insert_data('participant',$participant);
                    $this->signupmodel->insert_data('participantmeta',array('idparticipant'=>$this->db->insert_id()));
                $this->db->trans_complete();
	}	

	public function random_password(){
		$len = 8;
		$base='ABCDEFGHKLMNOPQRSTWXYZabcdefghjkmnpqrstwxyz123456789';
		$max=strlen($base)-1;
		mt_srand((double)microtime()*1000000);
		$pass='';
		while (strlen($pass)<$len)
			$pass.=$base{mt_rand(0,$max)};
		return $pass;
	}

	public function send_mail($email,$title,$parms){
		$this->load->library('email');
		$this->email->from('contacto@siaj.com', SITE_NAME);
		$this->email->bcc('serick@outlook.com');
		$this->email->to($email);
		$this->email->subject($title);
		$this->email->message('
			<table style="min-width: 600px; border-top: 4px solid #39C; font: 12px Arial; padding-bottom: 60px; background: url(\'\') repeat-x bottom left;">
				<tbody>
					<tr>
						<td>
							<div style="padding: 10px; border-bottom: 1px solid #eee; position: relative;">
								<img style="float:left; margin-right: 10px" src="" height="150" />
								<h2 style="font: 14px Arial; font-weight: bold; float: left;"><span style="color:#005184;">'.SITE_NAME.'</span></h2>
								<div style="clear:both;"></div>
							</div>
							<div style="float; left; padding: 10px 20px; border-bottom: 2px solid #ccc">
								COORDINADOR ESTATAL (<b>'.$parms['coordinator'].'</b>):
								<p>Se ha registrado exitosamente la siguiente seleccion:</p>
								<p>
									<p>Plantel: <b>'.$parms['campusName'].'</b></p>
									<p>Deporte: <b>'.$parms['sportName'].'</b></p>
									<p>Categoria: <b>'.$parms['sportCategoryName'].'</b></p>
								</p>
								<div style="clear:both; margin-bottom: 10px"></div>
								<p style="border: 1px solid #eee;">
									<p><b>DATOS DE ACCESO:</b></p>
									<p>Usuario: <b>'.$parms['username'].'</b></p>
									<p>Constraseña: <b>'.$parms['password'].'</b></p>
								</p>
								<p style="color: red">Reenvie esta información al responsable del equipo para llevar a cabo el registro de los participantes.</p>
							</div>
							<p style="color: #ccc; text-align: right">
								&copy '.date('Y').', Sistema Informático de Administración de los Juegos Nacionales (SIAJ)
							</p>
						</td>
					</tr>
				</tbody>
			</table>'
		);
		$this->email->send();
	}
}