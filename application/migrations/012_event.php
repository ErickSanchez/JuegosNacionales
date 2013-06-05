<?php
include_once('mymigration.php');
    class Migration_Event extends MyMigration {

        function up(){
        	
            $table = 'event';
	        
            $idevent = array(
                'type'           => 'int',
                'constraint'     => 11,
                'unsigned'       => TRUE,
                'null'           => FALSE,
                'auto_increment' => TRUE,
                'primary_key'    => TRUE);

            $idteamOne = array(
                'type'       => 'int',
                'constraint' => 11,
                'null'       => TRUE);

            $idteamTwo = array(
                'type'       => 'int',
                'constraint' => 11,
                'null'       => TRUE);

            $dateTimeEvent = array(
                'type'       => 'datetime',
                'null'       => TRUE);

            $fields = array(
                'idevent' => $idevent,
                'idteamOne' => $idteamOne,
                'idteamTwo' => $idteamTwo,
                'dateTimeEvent' => $dateTimeEvent);

            $config = array(
                'table'  => $table,
                'fields' => $fields,
            );

            $this->create_table($config);
        }
        function down(){
        	$this->dbforge->drop_table('event');
        }
    }
?>