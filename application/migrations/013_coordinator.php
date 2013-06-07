<?php
include_once('mymigration.php');
    class Migration_Coordinator extends MyMigration {

        function up(){
        	
            $table = 'coordinator';
	        
            $idcoordinator = array(
                'type'           => 'int',
                'constraint'     => 11,
                'unsigned'       => TRUE,
                'null'           => FALSE,
                'auto_increment' => TRUE,
                'primary_key'    => TRUE);

            $username = array(
                'type'           => 'varchar',
                'constraint'     => 25,
                'unsigned'       => TRUE,
                'null'           => FALSE);

            $coordinatorName = array(
                'type'       => 'varchar',
                'constraint' => 250,
                'null'       => TRUE);

            $fields = array(
                'idcoordinator' => $idcoordinator,
                'username' => $username,
                'coordinatorName' => $coordinatorName);

            $config = array(
                'table'  => $table,
                'fields' => $fields,
            );

            $this->create_table($config);
        }
        function down(){
        	$this->dbforge->drop_table('coordinator');
        }
    }
?>