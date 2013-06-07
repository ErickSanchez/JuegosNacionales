<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Participant extends CI_Controller{
    
    public function __construct() {
        parent::__construct();

        if(!$this->session->userdata('logged_in'))
			     redirect('/login', 'refresh');

        $this->load->helper('form');
        $this->load->library(array('form_validation','upload','validate'));
        $this->load->model('participantmodel');
        $this->load->model('signupmodel');
        $this->load->model('stateadminmodel');
    }
    
    public function edit($idparticipant=0,$coach=0){
           
        $data['username']=$this->session->userdata('username');
     
           if(!$idparticipant)
                redirect('/stateadmin', 'refresh');

            if($coach)
            {
                $data['title']="Actualizacion del Director Tecnico";
                $data['participant']=$this->participantmodel->get_coach_info($idparticipant);
        
                if(@!$data['participant']->usernameCoach)
                        redirect('/stateadmin', 'refresh');
                
                $data['coach']=$data['participant']->usernameCoach;
		
                $data['participant']->idparticipant=$idparticipant; // because query not sent id
            }
            else
            {
                $data['title']="Actualizacion de Participantes";
                $data['participant']=$this->participantmodel->get_participant_info($idparticipant);
                $data['coach']=0;

                if(@$data['participant']->usernameCoach)
                    redirect('/stateadmin', 'refresh');
                
		//	$data['participant']->idparticipant=$idparticipant; // because query not sent id
            }

            if(!@$data['participant']->idparticipant)
                        redirect('/stateadmin', 'refresh');
            
		$data['states']=$this->stateadminmodel->get_states(-1);

		$data['style']='sign-up';
                $data['ed']=true;
		$data['leftcolumn']="left-column-state";
		$data['content']="participant_edit";
		$data['label_button']="Actualizar datos";
		$data['action_form']="participant/update";
		$this->load->view('includes/template',$data);
    }
    function update(){

        $this->validate->set_rules_update();
		
        $this->validate->set_rules($this->form_validation);

        if ($this->form_validation->run() == false)
        {
           
            $this->edit(@$_POST['participant'],@$_POST['coach']);
        }
        else
        {
		
		$data['title']="Actualizando informacion...";
			$data['style']='state-admin';
			$data['leftcolumn']="left-column-state";
			$data['content']="uploader";
			$this->load->view('includes/template',$data);

      $this->db->trans_start();
       
        $participantmeta = array(
                   'birthdate' => $_POST['birthdate-year'].'-'.$_POST['birthdate-month'].'-'.$_POST['birthdate-day'],
                   'phone' => $_POST['phone'],
                   'cellphone' => $_POST['cellphone'],
                   'email' => $_POST['email'],
                    'turn' => @$_POST['turn'],
                    'curp' => $_POST['curp'],
                    'bloodType' => @$_POST['blood-type'],
                    'emergencyName' => @$_POST['emergency-name'],
                    'emergencyPhone' => @$_POST['emergency-phone']);
        
      $this->participantmodel->update_participant('participantmeta',$participantmeta,array('idparticipant'=>$_POST['participant']));
         
      if(!$_POST['coach'])
       {
         $address = array(
                   'addressStreet' => $_POST['address-street'],
                   'addressNumber' => $_POST['address-number'],
                   'addressInteriorNumber' => $_POST['address-interior-number'],
                   'addressColony' => $_POST['address-colony'],
                    'addressZip' => $_POST['address-zip'],
                    'addressLocality' => $_POST['address-locality'],
                    'addressTown' => $_POST['address-town'],
                    'addressState' => $_POST['address-state']);

           $this->participantmodel->update_participant('address',$address,array('idparticipant'=>$_POST['participant']));
       
          $participantathlete = array(
                   'schoolEnrollment' => $_POST['enrollment'],
                   'jerseyNumber' => $_POST['jersey-number'] ,
                   'semester' => $_POST['semester'] ,
                   'groupParticipant' => $_POST['groupParticipant'] ,
                   'schoolState' => $_POST['statu'],
                   'allergies' => $_POST['allergies'],
                   'chronicDiseases' => $_POST['chronic-diseases']);

               $this->participantmodel->update_participant('participantathlete ',$participantathlete,array('idparticipant'=>$_POST['participant']));
       }

           $participant = array(
                   'lastName' => strtoupper($_POST['lastname']),
                   'sureName' => strtoupper($_POST['surname']),
                   'firstName' => strtoupper($_POST['firstname']));

        $this->participantmodel->update_participant('participant',$participant,array('idparticipant'=>$_POST['participant']));

       
         $this->db->trans_complete();

         if(!$this->db->trans_status())
                    $this->edit($_POST['participant'],$_POST['coach']);

            $dir=PATH_FILES.$_POST['participant'];
            @mkdir($dir,0777);


              $file1=$this->do_upload('file-photo',$dir,$_POST['participant'].'-file-photo');
              
              if($_POST['coach'])
              {
                $idF =   $this->do_upload('file-schoolCard-front',$dir,$_POST['participant'].'-file-CardFront');
                $idB =   $this->do_upload('file-schoolCard-back',$dir,$_POST['participant'].'-file-CardBack');
                if($idF)
                    $files_participantmeta['fileIdentificationFront']=$idF;
                if($idB)
                    $files_participantmeta['fileIdentificationBack']=$idB;
              }

              
              if(!$_POST['coach'])
                $file2=$this->do_upload('file-CURP',$dir,$_POST['participant'].'-file-curp');

              if($file1)
                  $files_participantmeta['filePhoto']=$file1;
              if(@$file2)
                  $files_participantmeta['curpFile']=$file2;
              
              

              if(@$files_participantmeta)
                    $this->participantmodel->update_participant('participantmeta',$files_participantmeta,array('idparticipant'=>$_POST['participant']));

                if(!$_POST['coach'])
                   {
                     $file1 =   $this->do_upload('file-birth',$dir,$_POST['participant'].'-file-birthCertificate');
                     $file2 =   $this->do_upload('file-Certificate',$dir,$_POST['participant'].'-file-schoolCertificate');
                     $file3 =   $this->do_upload('file-academicHistory',$dir,$_POST['participant'].'-file-academicHistory');
                     $file4 =   $this->do_upload('file-schoolCard-front',$dir,$_POST['participant'].'-file-schoolCardFront');
                     $file5 =   $this->do_upload('file-schoolCard-back',$dir,$_POST['participant'].'-file-schoolCardBack');

                     if($file1)
                         $files_participantathlete['fileBirthCertificate']=$file1;
                     if($file2)
                         $files_participantathlete['fileSchoolCertificate']=$file2;
                     if($file3)
                         $files_participantathlete['fileAcademicHistory']=$file3;
                     if($file4)
                         $files_participantathlete['fileStudentCardFront']=$file4;
                     if($file5)
                         $files_participantathlete['fileStudentCardBack']=$file5;

                    if(@$files_participantathlete)
                          $this->participantmodel->update_participant('participantathlete',$files_participantathlete,array('idparticipant'=>$_POST['participant']));
                   }

			redirect('/stateadmin/view_team/'.$_POST['team'].'/'.$_POST['sport'].'/updated', 'refresh');
        }

       }

       function  select_check($value){
           	if ($value == 0)
                {
                    $this->form_validation->set_message('select_check','Selecciona un valor del campo %s');
                    return false;
                }
		else
                    return true;
       }
       function  validate_size_file($value,$id){
           if($_FILES[$id]['size'] > LIMIT_FILE_SIZE)
           {
               
               $this->form_validation->set_message('validate_size_file', ' %s debe ser menor o igual a '.(LIMIT_FILE_SIZE/1024).' kb');
               return false;
           }
           return true;
       }
      function validate_number_of_years($value){
        /*
           
          if($value != '0000')
          {
            $numbers_of_years=$this->participantmodel->get_number_of_years_for_team($value,$_POST['team'],$_POST['participant'])->numbers;      
            if($value == '1993' && $numbers_of_years >= LIMIT_PARTICIPANT_1993)
                return false;
          }
        */
        return true;
    }
      function do_upload($file,$dir,$filename)
	{

              $config['upload_path'] = $dir;
		$config['allowed_types'] = 'jpg|png|jpeg|pdf';
		$config['max_size'] = (LIMIT_FILE_SIZE+5000);
                $config['overwrite']=true;
                $config['file_name']=$filename;

                $this->upload->initialize($config);

                 if (!$this->upload->do_upload($file))
                        return NULL;

                  $file=$this->upload->data();

              return  $file['file_name'];
	}
    function delete($idparticipant=0,$idteam=0,$idsport=0){
        $admin=false;
        $this->load->library('dir');
        
        if($idparticipant)
        {
            if($this->session->userdata('userType') == COORDINATOR_STATE)
            {
                $ids=$this->stateadminmodel->get_idteams_by_coordinator($this->session->userdata('username'));
                $id='idteam';
                $id_valid = $idteam;
            }
            else
            {
                $ids=$this->stateadminmodel->get_idparticipants_by_coach($this->session->userdata('username'));
                $id='idparticipant';
                $id_valid = $idparticipant;
            }
            foreach($ids as $row)
            {
               if($row->$id == $id_valid) 
               {
                   
                   $this->participantmodel->delete($idparticipant,$idteam);
                   
                   if($this->db->trans_status())
                   
                       if(is_dir(PATH_FILES.$idparticipant))
                            $this->dir->delete(PATH_FILES.$idparticipant);
                       break;
               }
            }
        }
     
     redirect('/stateadmin/view_team/'.$idteam.'/'.$idsport, 'refresh');

    }
}
