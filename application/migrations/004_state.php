<?php
include_once('mymigration.php');
    class Migration_State extends MyMigration {

        function up(){
        	
            $table = 'state';
	        
            $idstate = array(
                'type'           => 'int',
                'constraint'     => 11,
                'unsigned'       => TRUE,
                'null'           => FALSE,
                'auto_increment' => TRUE,
                'primary_key'    => TRUE);

            $stateName = array(
                'type'       => 'varchar',
                'constraint' => 45);

            $fields = array(
                'idstate'    => $idstate,
                'stateName'  => $stateName);

            $config = array(
                'table'  => $table,
                'fields' => $fields,
            );

            $this->create_table($config);
        }
        function down(){
        	$this->dbforge->drop_table('state');
        }
    }
?>