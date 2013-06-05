<?php
include_once('mymigration.php');
    class Migration_Annotator extends MyMigration {

        function up(){
        	
            $table = 'annotator';
	        
            $idannotator = array(
                'type'           => 'int',
                'constraint'     => 11,
                'unsigned'       => TRUE,
                'null'           => FALSE,
                'auto_increment' => TRUE,
                'primary_key'    => TRUE);

            $annotations = array(
                'type'       => 'int',
                'constraint' => 11,
                'null'       => TRUE);

            $minute = array(
                'type'       => 'varchar',
                'constraint' => 20,
                'null'       => TRUE);

            $fields = array(
                'idannotator' => $idannotator,
                'annotations' => $annotations,
                'minute' => $minute);

            $config = array(
                'table'  => $table,
                'fields' => $fields,
            );

            $this->create_table($config);
        }
        function down(){
        	$this->dbforge->drop_table('annotator');
        }
    }
?>