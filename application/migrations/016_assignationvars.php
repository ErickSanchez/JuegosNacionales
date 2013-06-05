<?php
include_once('mymigration.php');
    class Migration_Assignationvars extends MyMigration {

        function up(){
        	
            $table = 'assignationvars';
	        
            $idassignationvars = array(
                'type'           => 'int',
                'constraint'     => 11,
                'unsigned'       => TRUE,
                'null'           => FALSE,
                'auto_increment' => TRUE,
                'primary_key'    => TRUE);

            $assignationvarName = array(
                'type'       => 'char',
                'constraint' => 2,
                'null'       => TRUE);

            $fields = array(
                'idassignationvars' => $idassignationvars,
                'assignationvarName' => $assignationvarName);

            $config = array(
                'table'  => $table,
                'fields' => $fields,
            );

            $this->create_table($config);
        }
        function down(){
        	$this->dbforge->drop_table('assignationvars');
        }
    }
?>