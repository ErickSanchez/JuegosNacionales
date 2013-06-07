<?php
include_once('mymigration.php');
    class Migration_User extends MyMigration {

        function up(){
        	$table = 'user';
	        
	        $username = array(
                'type' 			 => 'varchar',
                'constraint' 	 => 30,
                'null' 			 => FALSE,
                'primary_key' 	 => TRUE);

            $iduserType = array(
                'type' 			=> 'int',
                'constraint' 	=> 11);

            $userPassword = array(
                'type' 			=> 'varchar',
                'constraint' 	=> 62);

            $userEmail = array(
                'type' 			=> 'varchar',
                'constraint' 	=> 255);

            $userPhone = array(
                'type' 			=> 'varchar',
                'constraint' 	=> 12);

            $fields = array(
                'username'     => $username,
                'iduserType'   => $iduserType,
                'userPassword' => $userPassword,
                'userEmail'    => $userEmail,
                'userPhone'    => $userPhone
            );

            $config = array(
                'table' => $table,
                'fields' => $fields,
            );
            $this->create_table($config);

        }
        function down(){
        	$this->dbforge->drop_table('user');
        }
    }
?>