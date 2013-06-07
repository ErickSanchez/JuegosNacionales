<?php
include_once('mymigration.php');
    class Migration_Sportcategory extends MyMigration {

        function up(){
        	
            $table = 'sportcategory';
	        
            $idsportCategory = array(
                'type'           => 'int',
                'constraint'     => 11,
                'unsigned'       => TRUE,
                'null'           => FALSE,
                'auto_increment' => TRUE,
                'primary_key'    => TRUE);

            $sportCategoryName = array(
                'type'       => 'varchar',
                'constraint' => 7);

            $idsport = array(
                'type'           => 'int',
                'constraint'     => 1,
                'unsigned'       => TRUE,
                'null'           => FALSE);

            $fields = array(
                'idsportCategory'    => $idsportCategory,
                'idsport'  => $idsport,
                'sportCategoryName'    => $sportCategoryName
                );

            $config = array(
                'table'  => $table,
                'fields' => $fields,
            );

            $this->create_table($config);
        }
        function down(){
        	$this->dbforge->drop_table('sportcategory');
        }
    }
?>