<?php
include_once('mymigration.php');
    class Migration_Participantathlete extends MyMigration {

        function up(){
        	
            $table = 'participantathlete';
	        
            $schoolEnrollment = array(
                'type'       => 'varchar',
                'constraint' => 15,
                'primary_key' 	 => TRUE);

            $jerseyNumber = array(
                'type'       => 'int',
                'constraint' => 3,
                'null'       => TRUE);

            $semester = array(
                'type'       => 'int',
                'constraint' => 1,
                'null'       => TRUE);

            $group = array(
                'type'       => 'varchar',
                'constraint' => 10,
                'null'       => TRUE);

            $schoolState = array(
                'type'       => 'char',
                'constraint' => 1,
                'null'       => TRUE);

            $fileBirthCertificate = array(
                'type'       => 'varchar',
                'constraint' => 60,
                'null'       => TRUE);

            $fileSchoolCertificate = array(
                'type'       => 'varchar',
                'constraint' => 60,
                'null'       => TRUE);

            $fileAcademicHistory = array(
                'type'       => 'varchar',
                'constraint' => 60,
                'null'       => TRUE);

            $fileStudentCardFront = array(
                'type'       => 'varchar',
                'constraint' => 60,
                'null'       => TRUE);

            $fileStudentCardBack = array(
                'type'       => 'varchar',
                'constraint' => 60,
                'null'       => TRUE);

            $allergies = array(
                'type'       => 'varchar',
                'constraint' => 500,
                'null'       => TRUE);

            $chronicDiseases = array(
                'type'       => 'varchar',
                'constraint' => 500,
                'null'       => TRUE);

            $fields = array(

            	'schoolEnrollment' 		=> $schoolEnrollment,
				'jerseyNumber' 			=> $jerseyNumber,
				'semester' 				=> $semester,
				'group' 				=> $group,
				'schoolState' 			=> $schoolState,
				'fileBirthCertificate' 	=> $fileBirthCertificate,
				'fileSchoolCertificate' => $fileSchoolCertificate,
				'fileAcademicHistory' 	=> $fileAcademicHistory,
				'fileStudentCardFront' 	=> $fileStudentCardFront,
				'fileStudentCardBack' 	=> $fileStudentCardBack,
				'allergies' 			=> $allergies,
				'chronicDiseases' 		=> $chronicDiseases,
                );

            $config = array(
                'table'  => $table,
                'fields' => $fields,
            );

            $this->create_table($config);
        }
        function down(){
        	$this->dbforge->drop_table('participantathlete');
        }
    }
?>