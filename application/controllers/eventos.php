<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
class Eventos extends CI_Controller {

    public function __construct() {
        parent::__construct();
	  $this->load->helper('form');
         $this->load->library(array('form_validation'));	
        $this->load->model('eventmodel');
                
    }
	
	public function index()
	{
        $this->schedule();
	}
	
	public function calendario($sport='Futbol'){
		
		$data['events']      = $this->schedule($sport);
		$data['sedes']       = $this->eventmodel->get_sedes();
		$data['username']    = $this->session->userdata('username');	
		$data['sports']      = $this->eventmodel->get_sport();        
		$data['sportName']   = mb_strtoupper($sport, 'UTF-8');
		$data['title']       = "Calendario";
        $data['style']       = "events";
		if($sport == 'Ajedrez')
			$data['content'] = 'events/no-schedule';
		else
			$data['content'] = "events/schedule";
			
		$data['leftcolumn']  = "events/events-left-column";
                
		$this->load->view('includes/template',$data);
	}
	
	public function schedule($sport = 'Futbol'){
		return $this->eventmodel->get_event_x_sport($sport);
	} 
        
	public function register($msg = ''){
           
            if($this->session->userdata('userType') != COORDINATOR_NATIONAL)
                redirect('/login/redir_section/'.$this->session->userdata('userType'), 'refresh');
            
           $data['username'] = $this->session->userdata('username');
                
            $data['title']  =   "";
            $data['style']  =   'events';		
            $data['sports'] =   $this->eventmodel->get_sport();        
            $data['events'] =   $this->eventmodel->get_event_x_sport('FUTBOL');
            $data['sedes']  =   $this->eventmodel->get_sedes();
        
		if($msg){
			$notify = array('msg'=>'<b>'.$msg.'</b>','type'=>'ok');
			$data['notification']   =   $notify;
		}
        $data['content']      =   "events/register_event";
		$data['leftcolumn']   =   "events/events-left-column";
                
		$this->load->view('includes/template',$data);  
	}
	
	public function assign($msg='',$type='error'){
             if($this->session->userdata('userType')!= COORDINATOR_NATIONAL)
                redirect('/eventos/calendario', 'refresh');
				
			   $data['username'] =   $this->session->userdata('username');
					
			$data['title']   =  "";
			$data['style']   =   'sign-up';
			
				$data['sports'] =   $this->eventmodel->get_sport();        
				$data['events'] =   $this->eventmodel->get_event_x_sport('FUTBOL');
				$data['sedes']  =   $this->eventmodel->get_sedes();
			if($msg){
				$notify = array('msg'=>'<b>'.$msg.'</b>','type'=>'ok');
				$data['notification']   =   $notify;
			}
			$data['content']="events/assign_event";
			$data['leftcolumn']="events/events-left-column";
					
			$this->load->view('includes/template',$data);  
	}
        
        public function add_score($msg='',$type='error'){
             if($this->session->userdata('userType')!= COORDINATOR_NATIONAL)
                redirect('/eventos/calendario', 'refresh');
            
           $data['username']=$this->session->userdata('username');
		   if($msg){
				$notify = array('msg'=>'<b>'.$msg.'</b>','type'=>'ok');
				$data['notification']   =   $notify;
			}                
			$data['title']   =   "Registrar Marcador";
			$data['style']   =   'sign-up';
		
            $data['sports']  =   $this->eventmodel->get_sport();        
            $data['sedes']   =   $this->eventmodel->get_sedes();
         
	
            $data['content']     =  "events/add_score";       
		    $data['leftcolumn']  =  "events/events-left-column";
                
		$this->load->view('includes/template',$data);  
        }
        
        public function edit(){
             if($this->session->userdata('userType')!= COORDINATOR_NATIONAL)
                redirect('/eventos/calendario', 'refresh');
            
           $data['username']    =   $this->session->userdata('username');
                
            $data['title']  =   "";
            $data['style']  =   'sign-up';		
            $data['sports'] =   $this->eventmodel->get_sport();        
            $data['sedes']  =   $this->eventmodel->get_sedes();         
	        $data['content']      =   "events/edit_event";       
	   	    $data['leftcolumn']   =   "events/events-left-column";
                
		    $this->load->view('includes/template',$data);  
        }
        
        public function edit_up(){
               
                    
            $this->form_validation->set_rules('event', 'Evento', 'required');
	        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
            if($this->form_validation->run() == false){
                $this->edit();
            }
            else{                
                   if($_POST['event'] && @$_POST['update']){
                        $event = array();
                        
                        if($_POST['sede'])
                            $event['idheadquarters']=$_POST['sede'];
							
                        if($_POST['field'])
                            $event['field']=$_POST['field'];

                        if($_POST['team-one'])
                            $event['idteamOne'] = $_POST['team-one'];

                        if($_POST['team-two'])
                            $event['idteamTwo'] = $_POST['team-two'];
                     
                        if($_POST['year'] || $_POST['month'] || $_POST['day'] || $_POST['hour'] || $_POST['minute']){
                                $dateTimeEvent  = '';
                                $result     =   $this->eventmodel->get_event($_POST['event']);
                                $dateTime   =   $result[0]->dateTimeEvent;

                                $year   =   substr($dateTime,0,4);
                                $month  =   substr($dateTime,5,2);
                                $day    =   substr($dateTime,8,2);
                                $hour   =   substr($dateTime,11,2);
                                $minute =   substr($dateTime,14,2);
                                
                            if($_POST['year'] && $_POST['year'] != $year)
                                    $dateTimeEvent=$_POST['year'];
                            else
                                $dateTimeEvent=$year;
                                
                            if($_POST['month'] && $_POST['month'] != $month)
                                    $dateTimeEvent.='-'.$_POST['month'];
                            else
                                $dateTimeEvent.='-'.$month;
                                
                            if($_POST['day'] && $_POST['day'] != $day)
                                    $dateTimeEvent.='-'.$_POST['day'];
                            else
                                $dateTimeEvent.='-'.$day;
                                
                            if($_POST['hour'] && $_POST['hour'] != $hour)
                                    $dateTimeEvent.=' '.$_POST['hour'];
                            else
                                $dateTimeEvent.=' '.$hour;
                                
                            if($_POST['minute'] && $_POST['minute'] != $minute)
                                    $dateTimeEvent.=':'.$_POST['minute'].':00';
                            else
                                $dateTimeEvent.=':'.$minute.':00';
                                
                            
                            $event['dateTimeEvent'] = $dateTimeEvent;
                            
                        }

                        $this->eventmodel->update_event('event',$event,array('idevent'=>$_POST['event']));
                   }
                   else
                       if($_POST['delete'])
                       {
                           $this->eventmodel->delete($_POST['event']);
                       }
                    
                      
                    $this->edit();
                }
        }
        
        public function assign_up(){
             
            $this->form_validation->set_rules('sport', 'Deporte', 'required');
            $this->form_validation->set_rules('sport-category', 'categoria', 'required');
             $this->form_validation->set_rules('team', 'Equipo', 'required');
            $this->form_validation->set_rules('groups', 'Grupo', 'required');
            $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
	 
            if ($this->form_validation->run() == false)
			{
						  $this->assign('Todos los datos son obligatorios.');
					 }
			else
			{
				$this->eventmodel->update_assignation_team($_POST['team'],$_POST['vars']);
				$this->assign('GRUPO ASIGNADO');
			}
        }
        public function register_up(){

            $this->form_validation->set_rules('sport-category', 'categoria', 'required');
            $this->form_validation->set_rules('sede', 'sede', 'required');
            $this->form_validation->set_rules('team-one', 'equipo 1', 'required');
            $this->form_validation->set_rules('team-two', 'equipo 2', 'required');
            $this->form_validation->set_rules('hour', 'hora', 'required');
            $this->form_validation->set_rules('day', 'dia', 'required');
			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
            if ($this->form_validation->run() == false)
			{
                             $this->register();
			}
			else
			{
                          
                    $event = array(
                        'idsportCategory'=>$_POST['sport-category'],
                        'idheadquarters' => $_POST['sede'],
                        'field' => $_POST['field'],
                        'idteamOne' => $_POST['team-one'],
                        'idteamTwo' => $_POST['team-two'],
                        'dateTimeEvent' => $_POST['year'].'-'.$_POST['month'].'-'.$_POST['day'].' '.$_POST['hour'].':'.$_POST['minute'].':00');

                    $this->eventmodel->insert_data('event',$event);
                    $this->register('Evento agregado correctamente');
            }


        }
		
		public function register_score(){
            $this->form_validation->set_rules('scoreTeamOne', 'Marcador local', 'required');
            $this->form_validation->set_rules('scoreTeamTwo', 'Marcador visitante', 'required');
			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
            if ($this->form_validation->run() == false){
                             $this->add_score();
			}
			else{
				if($_POST){
					if( $_POST['scoreTeamOne']>=0 && $_POST['scoreTeamTwo']>=0){
						//print_r($_POST);
						$this->eventmodel->setScore($_POST['idevent'],$_POST['scoreTeamOne'],$_POST['scoreTeamTwo']);
						$this->add_score('Marcador registrado correctamente','ok');
					}
					else
						$this->add_score('Marcador inválido. Intente nuevamente','error');
				}					
			}
		}
		
        public function get_sports(){

            $data['tag']= array(
                        'id'=>'idsport',
                        'name'=>'sportName');
             $data['arr']=$this->eventmodel->get_sport();
             $this->load->view('includes/select',$data);
       }
       public function get_teams_by_group($idgroup=0){

            $data['tag'] = array(
                    'id' => 'idassignation',
                    'name' => 'assignationVarName');
             $data['arr'] = $this->eventmodel->get_group($idgroup);
             $this->load->view('includes/select',$data);
       }
       public function get_groups($idsportcategory=0){
            $data['tag'] = array(
                    'id' => 'idgroup',
                    'name' => 'groupName');
             $data['arr']=$this->eventmodel->get_groups($idsportcategory);
             $this->load->view('includes/select',$data);
       }
	   
       public function get_vars_not_assigned($idgroup=0){
            $data['tag']= array(
                    'id'=>'idassignation',
                    'name'=>'assignationVarName');
             $data['arr']=$this->eventmodel->get_vars_not_assigned($idgroup);
             $this->load->view('includes/select',$data);
       }
        public function get_campus($idsportcategory=0){

            $data['tag']= array(
                    'id'=>'idteam',
                    'name'=>'name');
             $data['arr']=$this->eventmodel->get_campus($idsportcategory);
             $this->load->view('includes/select',$data);
       }
       
        public function get_events($idsportcategory=0){

            $data['tag'] = array(
                        'id'=>'idevent',
                        'name'=>'name');
             $data['arr']   =   $this->eventmodel->get_events($idsportcategory);
             $this->load->view('includes/select',$data);
       }
	   
        public function get_events_no_record($idsportcategory=0){

            $data['tag'] = array(
                        'id'=>'idevent',
                        'name'=>'name');
             $data['arr']   =   $this->eventmodel->get_events_no_record($idsportcategory);
             $this->load->view('includes/select',$data);
       }
	   
        public function get_team_one($idevent=0){
            $data['tag'] = array(
                        'id'=>'idteamOne',
                        'name'=>'name');
             $data['arr']    =   $this->eventmodel->get_team_one($idevent);
			 $data['unique'] =    'unique';
             $this->load->view('includes/select',$data);
       }
	   
        public function get_team_two($idevent=0){
            $data['tag'] = array(
                        'id'=>'idteamTwo',
                        'name'=>'name');
             $data['arr']    = $this->eventmodel->get_team_two($idevent);
             $data['unique'] = 'unique';
             $this->load->view('includes/select',$data);
       }
}