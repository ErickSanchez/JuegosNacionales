<?php
include_once('mymigration.php');
    class Migration_Participant extends MyMigration {

        function up(){
        	
            $table = 'participant';
	        
            $idparticipant = array(
                'type'           => 'int',
                'constraint'     => 10,
                'unsigned'       => TRUE,
                'null'           => FALSE,
                'auto_increment' => TRUE,
                'primary_key'    => TRUE);

            $lastName = array(
                'type'       => 'varchar',
                'constraint' => 45);

            $sureName = array(
                'type'       => 'varchar',
                'constraint' => 45);

            $firstName = array(
                'type'       => 'varchar',
                'constraint' => 45);

            $fields = array(
                'idparticipant' => $idparticipant,
                'lastName' => $lastName,
                'sureName' => $sureName,
                'firstName' => $firstName);

            $config = array(
                'table'  => $table,
                'fields' => $fields,
            );

            $this->create_table($config);
        }
        function down(){
        	$this->dbforge->drop_table('participant');
        }
    }
?>