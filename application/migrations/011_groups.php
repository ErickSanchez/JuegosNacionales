<?php
include_once('mymigration.php');
    class Migration_Groups extends MyMigration {

        function up(){
        	
            $table = 'groups';
	        
            $idgroup = array(
                'type'           => 'int',
                'constraint'     => 11,
                'unsigned'       => TRUE,
                'null'           => FALSE,
                'auto_increment' => TRUE,
                'primary_key'    => TRUE);

            $groupName = array(
                'type'       => 'varchar',
                'constraint' => 2,
                'null' => TRUE
                );

            $fields = array(
                'idgroup' => $idgroup,
                'groupName' => $groupName);

            $config = array(
                'table'  => $table,
                'fields' => $fields,
            );

            $this->create_table($config);
        }
        function down(){
        	$this->dbforge->drop_table('groups');
        }
    }
?>