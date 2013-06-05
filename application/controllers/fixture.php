<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Fixture extends CI_Controller {
		public function index() {
			if(ENVIRONMENT =='development') {
				
				$this->db->empty_table('annotator');
				$this->db->empty_table('event');
				$this->db->empty_table('address');
				$this->db->empty_table('participantmeta');
				$this->db->empty_table('participantathlete');
				$this->db->empty_table('participant');
				$this->db->empty_table('team');
				$this->db->empty_table('headquarters');
				$this->db->empty_table('assignation');
				$this->db->empty_table('assignationvars');
				$this->db->empty_table('groups');
				$this->db->empty_table('sportcategory');
				$this->db->empty_table('sport');
				$this->db->empty_table('campus');
				$this->db->empty_table('city');
				$this->db->empty_table('state');
				$this->db->empty_table('coordinator');
				$this->db->empty_table('user');
				$this->db->empty_table('usertype');
			    
			    $this->_usertype();
				$this->_user();
				$this->_coordinator();
				$this->_state();
				$this->_city();
				$this->_campus();
				$this->_sport();
				$this->_sportcategory();
				$this->_groups();				
				$this->_assignationvars();
				$this->_team();
				$this->_assignation();
				$this->_headquarters();
				$this->_participant();
				$this->_participantathlete();
				$this->_participantmeta();
				$this->_address();
				$this->_event();
				$this->_annotator();
																
			}	
		}
		private function _annotator() {
				$datos = array(
					array(
					'idannotator' 	=> 1,
					'idevent' 		=> '1',
					'idparticipant' => '2',
					'annotations' 	=> '2',
					'minute' 		=> '45'
					),
					array(
					'idannotator' => 2,
					'idevent' => '1',
					'idparticipant' => '5',
					'annotations' => '2',
					'minute' => '45'
					)
				);				
				$this->db->insert_batch('annotator', $datos);
				echo "<br/>Fixture Anotador";
		}
		private function _city() {
				$datos = array(
					array(
					'idcity' 	=> 1,
					'idstate' 	=> '1',
					'cityName' 	=> 'Las Vegas'
					),
					array(
					'idcity' 	=> 2,
					'idstate' 	=> '2',
					'cityName' 	=> 'Los Angueles'					
					),
					array(
					'idcity' 	=> 3,
					'idstate' 	=> '3',
					'cityName' 	=> 'Buenos Aires'
					)			
				);
				$this->db->insert_batch('city', $datos);
				echo "<br/>Fixture city";
		}
		private function _event() {
				$datos = array(
					array(
					'idevent' 		  => 1,
					'idsportCategory' => 1,
					'idheadquarters'  => 1,
					'idteamOne' 	  => 1,
					'idteamTwo' 	  => 2,
					'dateTimeEvent'   => '2013-06-03 12:23:25',
					)			
				);
				$this->db->insert_batch('event', $datos);
				echo "<br/>Fixture Event";
		}
		private function _user() {
				$datos = array(
			array(	'username' 		=> 'kaka',
					'iduserType' 	=> 1,
					'userPassword' 	=> md5('admin'),
					'userEmail' 	=> 'kaka@hotmail.com',
					'userPhone' 	=> '4568564551'	),

			array(	'username' 		=> 'messi',
					'iduserType' 	=> 1,
					'userPassword' 	=> md5('admin'),
					'userEmail' 	=> 'messi@hotmail.com',
					'userPhone' 	=> '4568564545'	),
			array(
					'username' 		=> 'ronaldo',
					'iduserType' 	=> 1,
					'userPassword'  => md5('admin'),
					'userEmail' 	=> 'ranaldo@hotmail.com',
					'userPhone' 	=> '4568564566'	),
			array(
					'username' 		=> 'figo',
					'iduserType' 	=> 2,
					'userPassword' 	=> md5('admin'),
					'userEmail' 	=> 'figoa@hotmail.com',
					'userPhone' 	=> '4568564565'	),
			array(
					'username' 		=> 'van persey',
					'iduserType' 	=> 2,
					'userPassword' 	=> md5('admin'),
					'userEmail' 	=> 'van@hotmail.com',
					'userPhone' 	=> '4568564568'	),
			array(
					'username' 		=> 'roney',
					'iduserType' 	=> 2,
					'userPassword' 	=> md5('admin'),
					'userEmail' 	=> 'roney@hotmail.com',
					'userPhone' 	=> '4568564551'	),
			array(
					'username' 		=> 'admin',
					'iduserType' 	=> 3,
					'userPassword' 	=> md5('admin'),
					'userEmail' 	=> 'admin@hotmail.com',
					'userPhone' 	=> '4568564555'	));
				$this->db->insert_batch('user',$datos);
				echo "<br/>Fixture Usuario";
		}
		private function _coordinator() {
				$datos = array(
					array(
						'idcoordinator' 	=> '1',
						'username' 			=> 'figo',
						'coordinatorName' 	=> 'Fidel Castro'
					),
					array(
						'idcoordinator' 	=> '2',
						'username' 			=> 'van persey',
						'coordinatorName' 	=> 'Maradona'
					),
					array(
						'idcoordinator' 	=> '3',
						'username' 			=> 'roney',
						'coordinatorName' 	=> 'Rommel'
					)							
				);
				$this->db->insert_batch('coordinator', $datos);
				echo "<br/> Fixture coordinator";
		}
		private function _address() {
				$datos = array(
					array(
					'idaddress' 		=> '1',
					'idparticipant' 	=> '1',
					'addressStreet' 	=> 'Av. Mexico',
					'addressNumber' 	=> '1544',
					'addressInteriorNumber' => '20',
					'addressColony' 	=> 'Santa Ana',
					'addressZip' 		=> '56',
					'addressLocality' 	=> 'Durango',
					'addressTownship' 	=> 'KASS',
					'addressTown' 		=> 'POSS',
					'addressState' 		=> 'Durango'
					),
					array(
					'idaddress' 		=> '2',
					'idparticipant' 	=> '2',
					'addressStreet' 	=> 'Av. Mexico2',
					'addressNumber' 	=> '1544',
					'addressInteriorNumber' => '202',
					'addressColony' 	=> 'Santa Ana2',
					'addressZip' 		=> '56',
					'addressLocality' 	=> 'Durango2',
					'addressTownship' 	=> 'KASS2',
					'addressTown' 		=> 'POSS2',
					'addressState' 		=> 'Durango2'
					
					),
					array(
					'idaddress' 		=> '3',
					'idparticipant' 	=> '3',
					'addressStreet' 	=> 'Av. Mexico3',
					'addressNumber' 	=> '15443',
					'addressInteriorNumber' => '23',
					'addressColony' 	=> 'Santa Ana3',
					'addressZip' 		=> '56',
					'addressLocality' 	=> 'Durango3',
					'addressTownship' 	=> 'KASS3',
					'addressTown' 		=> 'POSS3',
					'addressState' 		=> 'Durango3'
					)		
				);
				$this->db->insert_batch('address', $datos);
				echo "<br/>Fixture address";
		}
		private function _assignation() {
				$datos = array(
					array(
					'idteam' 			=> '1',
					'idassignationvars' => '1'
					),
					array(
					'idteam' 			=> '2',
					'idassignationvars' => '1'
					)		
				);
				$this->db->insert_batch('assignation', $datos);
				echo "<br/>Fixture assignation";
		}
		private function _assignationvars() {
				$datos = array(
					array(
					'idassignationvars'  => '1',
					'idgroup' 			 => '1',
					'assignationvarName' => 'prueba1'
					),
					array(
					'idassignationvars'  => '2',
					'idgroup' 			 => '2',
					'assignationvarName' => 'prueba2'
					)		
				);
				$this->db->insert_batch('assignationvars', $datos);
				echo "<br/>Fixture assignationvars";
		}
		
		private function _campus() {
				$datos = array(
					array(
					'idcampus' 		=> '1',
					'idcity' 		=> '1',
					'campusName' 	=> 'Weber',
					'campusPhone' 	=> '865656555',
					'campusDirectorName' => 'Atlanta',
					'campusDirectorPhone' => '12345',
					'cct' 			=> '123'
					),
					array(
					'idcampus' 		=> '2',
					'idcity' 		=> '2',
					'campusName' 	=> 'Sao Paulo',
					'campusPhone' 	=> '78265666',
					'campusDirectorName' => 'Amazonas',
					'campusDirectorPhone' => '23456',
					'cct' 			=> '234'
					),					
					array(					
					'idcampus' 		=> '3',
					'idcity' 		=> '3',
					'campusName' 	=> 'Tecate',
					'campusPhone' 	=> '6546633',
					'campusDirectorName' => 'Mexicali',
					'campusDirectorPhone' => '345678',
					'cct' 			=> '345'
					)	
				);
				$this->db->insert_batch('campus', $datos);
				echo "<br/>Fixture campus";
		}
		
		private function _headquarters() {
				$datos = array(
					array(
					'idheadquarters' 	=> '1',
					'nameHeadquarters' 	=> '1',
					'street' 			=> 'Morelos',
					'number' 			=> '45465565',
					'colony' 			=> 'Centro',
					'zipCode' 			=> '45666'
					),
					array(
					'idheadquarters' 	=> '2',
					'nameHeadquarters' 	=> '2',
					'street' 			=> 'Benito Juarez',
					'number' 			=> '65868999',
					'colony' 			=> 'Norte',
					'zipCode' 			=> '66000'
					),
					array(					
					'idheadquarters' 	=> '3',
					'nameHeadquarters' 	=> '3',
					'street' 			=> 'Zapata',
					'number' 			=> '654555555',
					'colony' 			=> 'Oriente',
					'zipCode' 			=> '12008'
					)	
				);
				$this->db->insert_batch('headquarters', $datos);
				echo "<br/>Fixture headquarters";
		}
		private function _participant() {
				$datos = array(
					array(
					'idparticipant' => '1',
					'idteam' 		=> '1',
					'usernameCoach' => 'kaka',
					'lastName' 		=> 'Mourinho',
					'sureName' 		=> 'Mou',
					'firstName' 	=> 'Jose'
					),
					array(
					'idparticipant' => '2',
					'idteam' 		=> '1',
					'usernameCoach' => null,
					'lastName' 		=> 'Mourinho2',
					'sureName' 		=> 'Mou2',
					'firstName' 	=> 'Jose2'
					),
					array(					
					'idparticipant' => '3',
					'idteam' 		=> '1',
					'usernameCoach' => null,
					'lastName' 		=> 'Mourinho3',
					'sureName' 		=> 'Mou3',
					'firstName' 	=> 'Jose3'
					),
					array(
					'idparticipant' => '4',
					'idteam' 		=> '2',
					'usernameCoach' => 'ronaldo',
					'lastName' 		=> 'Brailovski',
					'sureName' 		=> 'Ruso',
					'firstName' 	=> 'Daniel'
					),
					array(
					'idparticipant' => '5',
					'idteam' 		=> '2',
					'usernameCoach' => null,
					'lastName' 		=> 'Brailovski2',
					'sureName' 		=> 'Ruso2',
					'firstName' 	=> 'Daniel2'
					),
					array(					
					'idparticipant' => '6',
					'idteam' 		=> '2',
					'usernameCoach' => null,
					'lastName' 		=> 'Bra3',
					'sureName' 		=> 'Ruso3',
					'firstName' 	=> 'Da3'
					),
					array(
					'idparticipant' => '7',
					'idteam' 		=> '3',
					'usernameCoach' => 'messi',
					'lastName' 		=> 'Aguirre',
					'sureName' 		=> 'Vasco',
					'firstName' 	=> 'Javier'),
					array(
					'idparticipant' => '8',
					'idteam' 		=> '3',
					'usernameCoach' => null,
					'lastName' 		=> 'Agui2',
					'sureName' 		=> 'Va2',
					'firstName' 	=> 'Ja2'),
					array(					
					'idparticipant' => '9',
					'idteam' 		=> '3',
					'usernameCoach' => null,
					'lastName' 		=> 'Agui3',
					'sureName' 		=> 'Vasco3',
					'firstName' 	=> 'Ja3'));
				$this->db->insert_batch('participant', $datos);
				echo "<br/>Fixture participant";
		}
		private function _participantmeta() {
				$datos = array(
					array(
					'idparticipantMeta' => '1',
					'idparticipant' 	=> '2'
					),
					array(
					'idparticipantMeta' => '2',
					'idparticipant' 	=> '3'
					),
					array(					
					'idparticipantMeta' => '3',
					'idparticipant' 	=> '5'
					),
					array(
					'idparticipantMeta' => '4',
					'idparticipant' 	=> '6'
					),
					array(					
					'idparticipantMeta' => '5',
					'idparticipant' 	=> '8'
					),
					array(
					'idparticipantMeta' => '6',
					'idparticipant' 	=> '9'
					)						
				);
				$this->db->insert_batch('participantmeta', $datos);
				echo "<br/>Fixture participantmeta";
		}
		private function _usertype() {
			$datos = array(
							array('iduserType'	=>1,
								  'userTypeName'=>'Coordinador de Equipo'),
							array('iduserType'	=>2,
								  'userTypeName'=>'Coordinador Estatal'),
							array('iduserType'	=>3,
								  'userTypeName'=>'Coordinador de Registro Nacional'));
		
			$this->db->insert_batch('usertype',$datos);
			echo "<br/>Fixture usertype";
		}

		private function _sport(){
					$datos = array(
						array('idsport'		=>1,
							  'sportName'	=>'FUTBOL',	
							  'sportParticipantsLimit'	=>20,	
							  'sportParticipantsMin'	=>11),	
						array('idsport'		=>2,
							  'sportName'	=>'BASQUETBOL',
							  'sportParticipantsLimit'	=>12,
							  'sportParticipantsMin'	=>9),
						array('idsport'		=>3,
							  'sportName'	=>'VOLEIBOL',
							  'sportParticipantsLimit'	=>14,
							  'sportParticipantsMin'	=>6),
						array('idsport'		=>4,
							  'sportName'	=>'AJEDREZ',
							  'sportParticipantsLimit'	=>1,
							  'sportParticipantsMin'	=>1));
	
		$this->db->insert_batch('sport',$datos);
		echo "<br/>Fixture sport";	
	}
	
	private function _sportcategory(){
		//$this->db->truncate('sportcategory');
		$datos = array(
						array('idsportCategory'	  =>1,
							  'idsport'			  =>1,	
							  'sportCategoryName' =>'VARONIL'),	
						array('idsportCategory'   =>2,
							  'idsport'			  =>1,
							  'sportCategoryName' =>'FEMENIL'),
						array('idsportCategory'   =>3,
							  'idsport'			  =>2,
							  'sportCategoryName' =>'VARONIL'),
						array('idsportCategory'   =>4,
							  'idsport'			  =>2,
							  'sportCategoryName' =>'FEMENIL'),
						array('idsportCategory'	  =>5,
							  'idsport'			  =>3,
							  'sportCategoryName' =>'VARONIL'),
						array('idsportCategory'   =>6,
							  'idsport'			  =>3,
							  'sportCategoryName' =>'FEMENIL'),
						array('idsportCategory'   =>7,
							  'idsport'			  =>4,
							  'sportCategoryName' =>'UNICA')
						);
	
		$this->db->insert_batch('sportcategory',$datos);
		echo "<br/>Fixture sportcategory";
	}
	
	private function _state(){
		$state = array(
						array('idstate'		   =>1,
							  'stateName'	   =>'Michoacan',	
							  'idcoordinator'  =>1),	
						array('idstate'		   =>2,
							  'stateName'	   =>'Jalisco',
							  'idcoordinator'  =>2),
						array('idstate'		   =>3,
							  'stateName'      =>'Mexico',
							  'idcoordinator'  =>3));
	
		$this->db->insert_batch('state',$state);
		echo "<br/>Fixture state";	
	}
	
	private function _team(){
		$team = array(
						array('idteam'		     =>1,
							  'idcampus'	   	 =>1,	
							  'idsportCategory'  =>1),	
						array('idteam'		     =>2,
							  'idcampus'	     =>2,
							  'idsportCategory'  =>1),
						array('idteam'		     =>3,
							  'idcampus'         =>3,
							  'idsportCategory'  =>2));
	
		$this->db->insert_batch('team',$team);
		echo "<br/>Fixture team";	
	}
	
	private function _groups(){
		$groups = array(
						array('idgroup'		     =>1,
							  'idsportCategory'  =>1,	
							  'groupName'  		 =>'A'),
						array('idgroup'		     =>2,
							  'idsportCategory'  =>2,	
							  'groupName'  		 =>'A')
						);
	
		$this->db->insert_batch('groups',$groups);
		echo "<br/>Fixture groups";	
	}
	
	private function _participantathlete(){
		$participantathlete = array(
						array('schoolEnrollment' =>'09120972',
							  'idparticipant'  	 =>2),
						array('schoolEnrollment' =>'09120973',
							  'idparticipant'    =>3),
						array('schoolEnrollment' =>'09120975',
							  'idparticipant'    =>5),
						array('schoolEnrollment' =>'09120976',
							  'idparticipant'    =>6),
						array('schoolEnrollment' =>'09120978',
							  'idparticipant'    =>8),
						array('schoolEnrollment' =>'09120979',
							  'idparticipant'    =>9));
	
		$this->db->insert_batch('participantathlete',$participantathlete);	
		echo "<br/>Fixture particippanthtele";
	}
}