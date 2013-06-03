<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class fixture extends CI_Controller {
		public function index() {
			if(ENVIRONMENT =='development') {
			    $this->_user();
				
				//$this->_anotador();
				//$this->_city();
				
			}	
		}
		private function _annotador() {
				//$this->load->database();
				$datos = array(
					array(
					'idannotator' => 17,
					'idevent' => '235',
					'idparticipant' => '56',
					'annotations' => '2',
					'minute' => '45'
					),
					/*array(
					'idannotator' => 18,
					'idevent' => '236',
					'idparticipant' => '57',
					'annotations' => '3',
					'minute' => '46'					
					),
					array(
					'idannotator' => 19,
					'idevent' => '237',
					'idparticipant' => '58',
					'annotations' => '4',
					'minute' => '47'
					)*/			
				);
				$this->load->library('table');
				$this->table->generate($this->db->get('aannota'));
				$this->db->insert_batch('annotator', $datos);
				echo "Fixture realizado1";
		}
		private function _city() {
				//$this->load->database();
				$datos = array(
					array(
					'idcity' => 1,
					'idstate' => '1',
					'cityName' => 'Las Vegas'
					),
					array(
					'idcity' => 2,
					'idstate' => '2',
					'cityName' => 'Los Angueles'					
					),
					array(
					'idcity' => 3,
					'idstate' => '3',
					'cityName' => 'Buenos Aires'
					)			
				);
				$this->db->insert_batch('city', $datos);
				echo "Fixture realizad2o";
		}
		private function _user() {
				$datos = array(
					array(
					'username' => 'kaka',
					'iduserType' => '1',
					'userPassword' => md5('admin'),
					'userEmail' => 'kaka@hotmail.com',
					'userPhone' => '4568564551'
					
					),
					array(
					'username' => 'messi',
					'iduserType' => '1',
					'userPassword' => md5('admin'),
					'userEmail' => 'messi@hotmail.com',
					'userPhone' => '4568564552'					
					),
					array(
					'username' => 'ronaldo',
					'iduserType' => '1',
					'userPassword' => md5('admin'),
					'userEmail' => 'ronaldo@hotmail.com',
					'userPhone' => '4568564553'					
					),
					array(
					'username' => 'coordina1',
					'iduserType' => '2',
					'userPassword' => md5('admin'),
					'userEmail' => 'coordina1@hotmail.com',
					'userPhone' => '4568564553'					
					),
					array(
					'username' => 'coordina2',
					'iduserType' => '2',
					'userPassword' => md5('admin'),
					'userEmail' => 'coordina1@hotmail.com',
					'userPhone' => '4568564553'					
					),
					array(
					'username' => 'coordina2',
					'iduserType' => '2',
					'userPassword' => md5('admin'),
					'userEmail' => 'coordina1@hotmail.com',
					'userPhone' => '4568564553'					
					),
					array(
					'username' => 'admin',
					'iduserType' => '3',
					'userPassword' => md5('admin'),
					'userEmail' => 'admin@hotmail.com',
					'userPhone' => '4568564553'					
					)			
				);
				$this->db->insert_batch('user', $datos);
				echo "Fixture realizad2o";
		}
		private function _coordinador() {
				$datos = array(
					array(
						'idcoordinador' => '1',
						'username' => 'fc',
						'coordinatorName' => 'Fidel Castro'
					),
					array(
						'idcoordinador' => '2',
						'username' => 'dam',
						'coordinatorName' => 'Maradona'
					),
					array(
						'idcoordinador' => '3',
						'username' => 'rm',
						'coordinatorName' => 'Rommel'
					),
					array(
						'idcoordinador' => '4',
						'username' => 'ht',
						'coordinatorName' => 'Hiroito'
					)								
				);
				$this->db->insert_batch('coordinator', $datos);
				echo "Fixture realizadoC3";
		}
		private function _address() {
				$datos = array(
					array(
					'idaddress' => '1',
					'idparticipant' => '1',
					'addressStreet' => 'Av. Mexico',
					'addressNumber' => '1544',
					'addressInteriorNumber' => '20',
					'addressColony' => 'Santa Ana',
					'addressZip' => '56',
					'addressLocality' => 'Durango',
					'addressTownship' => 'KASS',
					'addressTown' => 'POSS',
					'addressState' => 'Durango'
					),
					array(
					'idaddress' => '2',
					'idparticipant' => '2',
					'addressStreet' => 'Av. Mexico2',
					'addressNumber' => '1544',
					'addressInteriorNumber' => '202',
					'addressColony' => 'Santa Ana2',
					'addressZip' => '56',
					'addressLocality' => 'Durango2',
					'addressTownship' => 'KASS2',
					'addressTown' => 'POSS2',
					'addressState' => 'Durango2'
					
					),
					array(
					'idaddress' => '3',
					'idparticipant' => '3',
					'addressStreet' => 'Av. Mexico3',
					'addressNumber' => '15443',
					'addressInteriorNumber' => '23',
					'addressColony' => 'Santa Ana3',
					'addressZip' => '56',
					'addressLocality' => 'Durango3',
					'addressTownship' => 'KASS3',
					'addressTown' => 'POSS3',
					'addressState' => 'Durango3'
					)		
				);
				$this->db->insert_batch('address', $datos);
				echo "Fixture realizadoA1";
		}
		private function _assignation() {
				$datos = array(
					array(
					'idteam' => '1',
					'idassignationvars' => '1'
					),
					array(
					'idteam' => '2',
					'idassignationvars' => '1'
					),
					array(
					'idteam' => '3',
					'idassignationvars' => '2'
					)		
				);
				$this->db->insert_batch('assignation', $datos);
				echo "Fixture realizadoA2";
		}
		private function _assignationvars() {
				$datos = array(
					array(
					'idassignationvars' => '1',
					'idgroup' => '1',
					'assinationvarName' => 'prueba1'
					),
					array(
					'idassignationvars' => '2',
					'idgroup' => '2',
					'assinationvarName' => 'prueba2'
					)		
				);
				$this->db->insert_batch('assignationvars', $datos);
				echo "Fixture realizadoA2";
		}
		private function _sport() {
				$datos = array(
					array(
					'idsport' => '1',
					'sportName' => 'Futbol',
					'sportParticipantsLimit' => '18',
					'sportParticipantsMin' => '11'
					),
					array(
					'idsport' => '2',
					'sportName' => 'Basquetball',
					'sportParticipantsLimit' => '12',
					'sportParticipantsMin' => '6'
					),
					array(
					'idsport' => '3',
					'sportName' => 'Beisbol',
					'sportParticipantsLimit' => '15',
					'sportParticipantsMin' => '12'
					)	
				);
				$this->db->insert_batch('sport', $datos);
				echo "Fixture realizadoS1";
		}
		private function _campus() {
				$datos = array(
					array(
					'idcampus' => '1',
					'idcity' => '1',
					'campusName' => 'Weber',
					'campusPhone' => '865656555',
					'campusDirectorName' => 'Atlanta',
					'campusDirectorPhone' => '12345',
					'cct' => '123'
					),
					array(
					'idcampus' => '2',
					'idcity' => '2',
					'campusName' => 'Sao Paulo',
					'campusPhone' => '78265666',
					'campusDirectorName' => 'Amazonas',
					'campusDirectorPhone' => '23456',
					'cct' => '234'
					),					
					array(					
					'idcampus' => '3',
					'idcity' => '3',
					'campusName' => 'Tecate',
					'campusPhone' => '6546633',
					'campusDirectorName' => 'Mexicali',
					'campusDirectorPhone' => '345678',
					'cct' => '345'
					)	
				);
				$this->db->insert_batch('campus', $datos);
				echo "Fixture realizadoCA2";
		}
		
		private function _headquarters() {
				$datos = array(
					array(
					'idheadquarters' => '1',
					'nameHeadquarters' => '1',
					'street' => 'Morelos',
					'number' => '45465565',
					'colony' => 'Centro',
					'zipCode' => '45666'
					),
					array(
					'idheadquarters' => '2',
					'nameHeadquarters' => '2',
					'street' => 'Benito Juarez',
					'number' => '65868999',
					'colony' => 'Norte',
					'zipCode' => '66000'
					),
					array(					
					'idheadquarters' => '3',
					'nameHeadquarters' => '3',
					'street' => 'Zapata',
					'number' => '654555555',
					'colony' => 'Oriente',
					'zipCode' => '12008'
					)	
				);
				$this->db->insert_batch('headquarters', $datos);
				echo "Fixture realizadoCA2";
		}
		private function _participant() {
				$datos = array(
					array(
					'idparticipant' => '1',
					'idteam' => '1',
					'usernameCoach' => 'kaka',
					'lastName' => 'Mourinho',
					'sureName' => 'Mou',
					'firstName' => 'Jose'
					),
					array(
					'idparticipant' => '2',
					'idteam' => '1',
					'lastName' => 'Mourinho2',
					'sureName' => 'Mou2',
					'firstName' => 'Jose2'
					),
					array(					
					'idparticipant' => '3',
					'idteam' => '1',
					'lastName' => 'Mourinho3',
					'sureName' => 'Mou3',
					'firstName' => 'Jose3'
					)
					array(
					'idparticipant' => '4',
					'idteam' => '2',
					'usernameCoach' => 'ronaldo',
					'lastName' => 'Brailovski',
					'sureName' => 'Ruso',
					'firstName' => 'Daniel'
					),
					array(
					'idparticipant' => '5',
					'idteam' => '2',
					'lastName' => 'Brailovski2',
					'sureName' => 'Ruso2',
					'firstName' => 'Daniel2'
					),
					array(					
					'idparticipant' => '6',
					'idteam' => '2',
					'lastName' => 'Bra3',
					'sureName' => 'Ruso3',
					'firstName' => 'Da3'
					)
					array(
					'idparticipant' => '7',
					'idteam' => '3',
					'usernameCoach' => 'messi',
					'lastName' => 'Aguirre',
					'sureName' => 'Vasco',
					'firstName' => 'Javier'
					),
					array(
					'idparticipant' => '8',
					'idteam' => '3',
					'lastName' => 'Agui2',
					'sureName' => 'Va2',
					'firstName' => 'Ja2'
					),
					array(					
					'idparticipant' => '9',
					'idteam' => '3',
					'lastName' => 'Agui3',
					'sureName' => 'Vasco3',
					'firstName' => 'Ja3'
					)	
				);
				$this->db->insert_batch('participant', $datos);
				echo "Fixture realizadoCA2";
		}
		private function _participantmeta() {
				$datos = array(
					array(
					'idparticipantMeta' => '1',
					'idparticipant' => '2'
					),
					array(
					'idparticipantMeta' => '2',
					'idparticipant' => '3'
					),
					array(					
					'idparticipantMeta' => '3',
					'idparticipant' => '5'
					),
					array(
					'idparticipantMeta' => '4',
					'idparticipant' => '6'
					),
					array(					
					'idparticipantMeta' => '5',
					'idparticipant' => '8'
					)
					array(
					'idparticipantMeta' => '6',
					'idparticipant' => '9'
					)						
				);
				$this->db->insert_batch('participantmeta', $datos);
				echo "Fixture realizadoCA2";
		}
		
	}
?>
