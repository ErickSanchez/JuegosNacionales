<?php
include_once('mymigration.php');
    class Migration_City extends MyMigration {

        function up(){
        	
            $table = 'city';
	        
            $idcity = array(
                'type'           => 'int',
                'constraint'     => 11,
                'unsigned'       => TRUE,
                'null'           => FALSE,
                'auto_increment' => TRUE,
                'primary_key'    => TRUE);

            $idstate = array(
                'type'           => 'int',
                'constraint'     => 11,
                'unsigned'       => TRUE,
                'null'           => FALSE);

            $cityName = array(
                'type'       => 'varchar',
                'constraint' => 45);

            $fields = array(
                'idcity' => $idcity,
                'idstate' => $idstate,
                'cityName' => $cityName);

            $config = array(
                'table'  => $table,
                'fields' => $fields,
            );

            $this->create_table($config);
        }
        function down(){
        	$this->dbforge->drop_table('city');
        }
    }
?>