<?php
include_once('mymigration.php');
    class Migration_Team extends MyMigration {

        function up(){
        	
            $table = 'team';
	        
            $idteam = array(
                'type'           => 'int',
                'constraint'     => 11,
                'unsigned'       => TRUE,
                'null'           => FALSE,
                'auto_increment' => TRUE,
                'primary_key'    => TRUE);

            $fields = array(
                'idteam'    => $idteam
                );

            $config = array(
                'table'  => $table,
                'fields' => $fields,
            );

            $this->create_table($config);
        }
        function down(){
        	$this->dbforge->drop_table('team');
        }
    }
?>