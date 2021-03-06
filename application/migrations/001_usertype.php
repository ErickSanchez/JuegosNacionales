<?php
include_once('mymigration.php');
    class Migration_Usertype extends MyMigration {

        function up(){
            $table = 'usertype';
	        
            $iduserType = array(
                'type'           => 'int',
                'constraint'     => 11,
                'unsigned'       => TRUE,
                'null'           => FALSE,
                'auto_increment' => TRUE,
                'primary_key'    => TRUE);

            $userTypeName = array(
                'type'       => 'varchar',
                'constraint' => 45);

            $fields = array(
                'iduserType'    => $iduserType,
                'userTypeName'  => $userTypeName);

            $config = array(
                'table'  => $table,
                'fields' => $fields,
            );

            $this->create_table($config);
        }
        function down(){
        	$this->dbforge->drop_table('usertype');
        }
    }
?>