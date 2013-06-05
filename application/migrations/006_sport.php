<?php
include_once('mymigration.php');
    class Migration_Sport extends MyMigration {

        function up(){
        	
            $table = 'sport';
	        
            $idsport = array(
                'type'           => 'int',
                'constraint'     => 1,
                'unsigned'       => TRUE,
                'null'           => FALSE,
                'auto_increment' => TRUE,
                'primary_key'    => TRUE);

            $sportName = array(
                'type'       => 'varchar',
                'constraint' => 45);

            $sportParticipantsLimit = array(
            	'type'			=> 'int',
            	'constraint'	=> 2
            	);

            $sportParticipantsMin = array(
            	'type'			=> 'int',
            	'constraint'	=> 2
            	);

            $fields = array(
                'idsport'    => $idsport,
                'sportName'  => $sportName,
                'sportParticipantsLimit'	=> $sportParticipantsLimit,
                'sportParticipantsMin'		=> $sportParticipantsMin
                );

            $config = array(
                'table'  => $table,
                'fields' => $fields,
            );

            $this->create_table($config);
        }
        function down(){
        	$this->dbforge->drop_table('sport');
        }
    }
?>