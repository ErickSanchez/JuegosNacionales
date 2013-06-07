<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Signup extends CI_Controller {

    public function __construct() {
        parent::__construct();
        
         if(!$this->session->userdata('logged_in'))
        	redirect('/login', 'refresh');

         $this->load->helper('form');
         $this->load->library(array('form_validation','upload','validate'));
         $this->load->model('signupmodel');
         $this->load->model('participantmodel');
  }
	public function index(){
            redirect('/stateadmin', 'refresh');
    }
	
    private function validate($team,$sport){

            if(!$team && !$sport)
         		redirect('/stateadmin', 'refresh');


			$data['team']=$this->signupmodel->get_team_info($team);
                        $data['sport']=$this->signupmodel->get_sport_info($sport);

           if(!@$data['team']->idteam || !@$data['sport']->idsport)
               redirect('/stateadmin', 'refresh');

           $data['username']=$this->session->userdata('username');
           return $data;
        }

    public function coach($team=0,$sport=0){
            $data=$this->validate($team,$sport);

             $data['title']="Registro de Director Tecnico";
			$data['style']='sign-up';
			$data['leftcolumn']="left-column";
                $data['content']="sign-up";
                $data['coach']=1;
		$this->load->view('includes/template',$data);

        }

        public function participant($team=0,$sport=0){
            $data=$this->validate($team,$sport);
			$this->load->model('stateadminmodel');
			$data['states']=$this->stateadminmodel->get_states(-1);

            $data['title']="Registro de Participante";
			$data['style']='sign-up';
			$data['leftcolumn']="left-column";
            $data['content']="sign-up";
            $data['coach']=0;
		$this->load->view('includes/template',$data);
        }

        public function get_states($idstate){
            $this->load->model('stateadminmodel');
            $data['tag']= array(
                    'id'=>'idstate',
                    'name'=>'stateName');

             $data['arr']=$this->stateadminmodel->get_states($idstate);
             $data['unique']='unique';
             $this->load->view('includes/select',$data);
       }
       public function get_cities($idstate){
            $this->load->model('stateadminmodel');
            $data['tag']= array(
                    'id'=>'idcity',
                    'name'=>'cityName');

             $data['arr']=$this->stateadminmodel->get_cities($idstate);
             $this->load->view('includes/select',$data);
       }

       public function get_campus($idcity){
            $this->load->model('stateadminmodel');
            $data['tag']= array(
                    'id'=>'idcampus',
                    'name'=>'campusName');
             $data['arr']=$this->stateadminmodel->get_campus($idcity);
             $this->load->view('includes/select',$data);
       }
       public function get_sportcategory($idsport){

           $this->load->model('stateadminmodel');
            $data['tag']= array(
                    'id'=>'idsportCategory',
                    'name'=>'sportCategoryName');
             $data['arr']=$this->stateadminmodel->get_sportcategory($idsport);
             $this->load->view('includes/select',$data);
       }

       function register()
       {
         $this->validate->set_rules($this->form_validation);
		 
		 if ($this->form_validation->run() == false)
			{
			   if(@$_POST['coach']==0)
						$this->participant(@$_POST['team'],@$_POST['sport']);
				 else
					  $this->coach(@$_POST['team'],@$_POST['sport']);
			}
		else
			{
				
					  
         if($_POST['coach'])
              $usernameCoach=$this->session->userdata('username');
           else
               $usernameCoach=NULL;

     $this->db->trans_start();
     
        $participant = array(
                   'idteam' => $_POST['team'] ,
                   'usernameCoach' => $usernameCoach,
                   'lastName' => strtoupper($_POST['lastname']),
                   'sureName' => strtoupper($_POST['surname']),
                   'firstName' => strtoupper($_POST['firstname']));

        $this->signupmodel->insert_data('participant',$participant);
        $idparticipant = $this->db->insert_id();

      $participantmeta = array(
                   'idparticipant'=>$idparticipant,
                   'birthdate' => $_POST['birthdate-year'].'-'.$_POST['birthdate-month'].'-'.$_POST['birthdate-day'],
                   'phone' => $_POST['phone'],
                   'cellphone' => $_POST['cellhone'],
                   'email' => $_POST['email'],
                   'turn' => @$_POST['turn'],
                   'curp' => $_POST['curp'],
                   'bloodType' => @$_POST['blood-type'],
                   'emergencyName' => @$_POST['emergency-name'],
                   'emergencyPhone' => @$_POST['emergency-phone']);

       $this->signupmodel->insert_data('participantmeta',$participantmeta);
      
           if(!$_POST['coach'])
           {
           $address = array(
                   'idparticipant'=>$idparticipant,
                   'addressStreet' => $_POST['address-street'],
                   'addressNumber' => $_POST['address-number'],
                   'addressInteriorNumber' => $_POST['address-interior-number'],
                   'addressColony' => $_POST['address-colony'],
                    'addressZip' => $_POST['address-zip'],
                    'addressLocality' => $_POST['address-locality'],
                    'addressTown' => $_POST['address-town'],
                    'addressState' => $_POST['address-state']);
          $this->signupmodel->insert_data('address',$address);
           }

     
         if(!$_POST['coach'])
            {
               $participantathlete = array(
                   'schoolEnrollment' => $_POST['enrollment'],
                   'idparticipant' => $idparticipant,
                   'jerseyNumber' => $_POST['jersey-number'] ,
                   'semester' => $_POST['semester'] ,
                   'groupParticipant' => $_POST['group'] ,
                   'schoolState' => $_POST['statu'],
                   'allergies' => $_POST['allergies'],
                   'chronicDiseases' => $_POST['chronic-diseases']);
               $this->signupmodel->insert_data('participantathlete',$participantathlete);
            }
            $this->db->trans_complete();

            if(!$this->db->trans_status())
             if($_POST['coach']==0)
                    $this->participant ($_POST['team'],$_POST['sport']);
              else
                    $this->coach($_POST['team'],$_POST['sport']);

              $dir=PATH_FILES.$idparticipant;
               @mkdir($dir,0777);

              $file1=$this->do_upload('file-photo',$dir,$idparticipant.'-file-photo');
              $file2=$this->do_upload('file-CURP',$dir,$idparticipant.'-file-curp');

              $this->participantmodel->update_participant('participantmeta',array('filePhoto'=>$file1,'curpFile'=>$file2),array('idparticipant'=>$idparticipant));

                if(!$_POST['coach'])
                   {
                     $file3 =   $this->do_upload('file-birth',$dir,$idparticipant.'-file-birthCertificate');
                     $file4 =   $this->do_upload('file-Certificate',$dir,$idparticipant.'-file-schoolCertificate');
                     $file5 =   $this->do_upload('file-academicHistory',$dir,$idparticipant.'-file-academicHistory');
                     $file6 =   $this->do_upload('file-schoolCard-front',$dir,$idparticipant.'-file-schoolCardFront');
                     $file7 =   $this->do_upload('file-schoolCard-back',$dir,$idparticipant.'-file-schoolCardBack');

                       $this->participantmodel->update_participant('participantathlete',array('fileBirthCertificate'=>$file3,'fileSchoolCertificate'=>$file4,'fileAcademicHistory'=>$file5,'fileStudentCardFront'=>$file6,'fileStudentCardBack'=>$file7),array('idparticipant'=>$idparticipant));
                   }

              redirect('/stateadmin/view_team/'.$_POST['team'].'/'.$_POST['sport'], 'refresh');
    }
}
       function  select_check($value){
           	if ($value == 0)
                {
                    $this->form_validation->set_message('select_check','Selecciona un valor del campo %s');
                    return FALSE;
                }
		else
                    return TRUE;
       }
    function validate_number_of_years($value){
       /*
        if($value != '0000')
        {
            $numbers_of_years=$this->participantmodel->get_number_of_years_for_team($value,$_POST['team'])->numbers;
        
         if($value == '1993' && $numbers_of_years >= LIMIT_PARTICIPANT_1993)
            return false;
         
        }
        */
        return true;
    }
     function  validate_size_file($value,$id){
        $size=$_FILES[$id]['size'];
           if($size > LIMIT_FILE_SIZE)
           {
                $this->form_validation->set_message('validate_size_file', ' %s debe ser menor o igual a '.(LIMIT_FILE_SIZE/1024).' kb');
               return false;
           }
           return true;
       }

      	function do_upload($file,$dir,$filename)
	{
		$config['upload_path'] = $dir;
		$config['allowed_types'] = 'jpg|png|jpeg|pdf';
		$config['max_size'] = LIMIT_FILE_SIZE;
		$config['overwrite']= TRUE;
		$config['file_name']= $filename;

        $this->upload->initialize($config);
		
		if(!$this->upload->do_upload($file))
			return NULL;
		$file=$this->upload->data();
		return  $file['file_name'];
	}
}