<?php
include_once('mymigration.php');
    class Migration_Campus extends MyMigration {

        function up(){
        	
            $table = 'campus';
	        
            $idcampus = array(
                'type'           => 'char',
                'constraint'     => 9,
                'unsigned'       => FALSE,
                'null'           => FALSE,
                'auto_increment' => FALSE,
                'primary_key'    => TRUE);

            $idcity = array(
                'type'           => 'int',
                'constraint'     => 11,
                'unsigned'       => TRUE,
                'null'           => FALSE);

            $campusName = array(
                'type'       => 'varchar',
                'constraint' => 45);

            $campusPhone = array(
                'type'       => 'int',
                'constraint' => 14,
                'null'       => TRUE);

            $campusDirectorName = array(
                'type'       => 'varchar',
                'constraint' => 200,
                'null'       => TRUE);

            $campusDirectorPhone = array(
                'type'       => 'char',
                'constraint' => 14,
                'null'       => TRUE);

            $cct = array(
                'type'       => 'char',
                'constraint' => 10,
                'null'       => TRUE);

            $fields = array(
                'idcampus' => $idcampus,
                'idcity' => $idcity,
                'campusName' => $campusName,
                'campusPhone' => $campusPhone,
                'campusDirectorName' => $campusDirectorName,
                'campusDirectorPhone' => $campusDirectorPhone,
                'cct' => $cct);

            $config = array(
                'table'  => $table,
                'fields' => $fields,
            );

            $this->create_table($config);
        }
        function down(){
        	$this->dbforge->drop_table('campus');
        }
    }
?>