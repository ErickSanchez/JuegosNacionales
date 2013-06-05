<?php
include_once('mymigration.php');
    class Migration_Address extends MyMigration {

        function up(){
        	
            $table = 'address';
	        
            $idaddress = array(
                'type'           => 'int',
                'constraint'     => 11,
                'unsigned'       => TRUE,
                'null'           => FALSE,
                'auto_increment' => TRUE,
                'primary_key'    => TRUE);

            $idparticipant = array(
                'type'           => 'int',
                'constraint'     => 10,
                'unsigned'       => TRUE,
                'null'           => FALSE);

            $addressStreet = array(
                'type'       => 'varchar',
                'constraint' => 100,
                'null'       => TRUE);

            $addressNumber = array(
                'type'       => 'varchar',
                'constraint' => 10,
                'null'       => TRUE);

            $addressInteriorNumber = array(
                'type'       => 'varchar',
                'constraint' => 8,
                'null'       => TRUE);

            $addressColony = array(
                'type'       => 'varchar',
                'constraint' => 200,
                'null'       => TRUE);

            $addressZip = array(
                'type'       => 'int',
                'constraint' => 5,
                'null'       => TRUE);

            $addressLocality = array(
                'type'       => 'varchar',
                'constraint' => 60,
                'null'       => TRUE);

            $addressTownship = array(
                'type'       => 'varchar',
                'constraint' => 60,
                'null'       => TRUE);

            $addressTown = array(
                'type'       => 'varchar',
                'constraint' => 60,
                'null'       => TRUE);

            $addressState = array(
                'type'       => 'varchar',
                'constraint' => 60,
                'null'       => TRUE);

            $fields = array(
                'idaddress' => $idaddress,
                'idparticipant' => $idparticipant,
                'addressStreet' => $addressStreet,
                'addressNumber' => $addressNumber,
                'addressInteriorNumber' => $addressInteriorNumber,
                'addressColony' => $addressColony,
                'addressZip' => $addressZip,
                'addressLocality' => $addressLocality,
                'addressTownship' => $addressTownship,
                'addressTown' => $addressTown,
                'addressState' => $addressState
                );

            $config = array(
                'table'  => $table,
                'fields' => $fields,
            );

            $this->create_table($config);
        }
        function down(){
        	$this->dbforge->drop_table('address');
        }
    }
?>