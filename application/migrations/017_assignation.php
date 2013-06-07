<?php
include_once('mymigration.php');
    class Migration_Assignation extends MyMigration {

        function up(){
        	
            $table = 'assignation';
	        
            $idteam = array(
                'type'           => 'int',
                'constraint'     => 11);

            $idassignationvars = array(
                'type'           => 'int',
                'constraint'     => 11);

            $fields = array(
                'idteam' => $idteam,
                'idassignationvars' => $idassignationvars);

            $config = array(
                'table'  => $table,
                'fields' => $fields,
            );

            $this->create_table($config);
        }
        function down(){
        	$this->dbforge->drop_table('assignation');
        }
    }
?>