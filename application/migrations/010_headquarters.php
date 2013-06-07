<?php
include_once('mymigration.php');
    class Migration_Headquarters extends MyMigration {

        function up(){
        	
            $table = 'headquarters';
	        
            $idheadquarters = array(
                'type'           => 'int',
                'constraint'     => 11,
                'unsigned'       => TRUE,
                'null'           => FALSE,
                'auto_increment' => TRUE,
                'primary_key'    => TRUE);

            $nameHeadquarters = array(
                'type'       => 'varchar',
                'constraint' => 60,
                'null'       => TRUE);

            $street = array(
                'type'       => 'varchar',
                'constraint' => 60,
                'null'       => TRUE);

            $number = array(
                'type'       => 'varchar',
                'constraint' => 30,
                'null'       => TRUE);

            $colony = array(
                'type'       => 'varchar',
                'constraint' => 60,
                'null'       => TRUE);

            $zipCode = array(
                'type'       => 'int',
                'constraint' => 5,
                'null'       => TRUE);

            $fields = array(
                'idheadquarters' => $idheadquarters,
                'nameHeadquarters' => $nameHeadquarters,
                'street' => $street,
                'number' => $number,
                'colony' => $colony,
                'zipCode' => $zipCode
                );

            $config = array(
                'table'  => $table,
                'fields' => $fields,
            );

            $this->create_table($config);
        }
        function down(){
        	$this->dbforge->drop_table('headquarters');
        }
    }
?>