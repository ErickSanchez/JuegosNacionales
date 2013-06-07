<?php
include_once('mymigration.php');
    class Migration_Participantmeta extends MyMigration {

        function up(){
        	
            $table = 'participantmeta';
	        
            $idparticipantMeta = array(
                'type'           => 'int',
                'constraint'     => 11,
                'unsigned'       => TRUE,
                'null'           => FALSE,
                'auto_increment' => TRUE,
                'primary_key'    => TRUE);

            $idparticipant = array(
                'type'           => 'int',
                'constraint'     => 10,
                'unsigned'       => TRUE,
                'null'           => FALSE);

            $birthdate = array(
                'type'       => 'date',
                'null'       => TRUE);

            $phone = array(
                'type'       => 'char',
                'constraint' => 14,
                'null'       => TRUE);

            $cellphone = array(
                'type'       => 'char',
                'constraint' => 14,
                'null'       => TRUE);

            $email = array(
                'type'       => 'varchar',
                'constraint' => 250,
                'null'       => TRUE);

            $turn = array(
                'type'       => 'char',
                'constraint' => 1,
                'null'       => TRUE);

            $curp = array(
                'type'       => 'char',
                'constraint' => 18,
                'null'       => TRUE);

            $curpFile = array(
                'type'       => 'varchar',
                'constraint' => 60,
                'null'       => TRUE);

            $bloodType = array(
                'type'       => 'char',
                'constraint' => 2,
                'null'       => TRUE);

            $emergencyName = array(
                'type'       => 'varchar',
                'constraint' => 200,
                'null'       => TRUE);

            $emergencyPhone = array(
                'type'       => 'char',
                'constraint' => 10,
                'null'       => TRUE);

            $filePhoto = array(
                'type'       => 'varchar',
                'constraint' => 60,
                'null'       => TRUE);

            $juegosnacionales = array(
                'type'       => 'varchar',
                'constraint' => 60,
                'null'       => TRUE);

            $fileIdentificationBack = array(
                'type'       => 'varchar',
                'constraint' => 60,
                'null'       => TRUE);

            $fields = array(
                'idparticipantMeta' => $idparticipantMeta,
                'idparticipant' => $idparticipant,
                'birthdate' => $birthdate,
                'phone' => $phone,
                'cellphone' => $cellphone,
                'email' => $email,
                'turn' => $turn,
                'curp' => $curp,
                'curpFile' => $curpFile,
                'bloodType' => $bloodType,
                'emergencyName' => $emergencyName,
                'emergencyPhone' => $emergencyPhone,
                'filePhoto' => $filePhoto,
                'juegosnacionales' => $juegosnacionales,
                'fileIdentificationBack' => $fileIdentificationBack);

            $config = array(
                'table'  => $table,
                'fields' => $fields,
            );

            $this->create_table($config);
        }
        function down(){
        	$this->dbforge->drop_table('participantmeta');
        }
    }
?>