<?php
    class MyMigration extends CI_Migration{

        /*function unique($table, $fields=array()){
            foreach ($fields as $field) {
                $sql = "ALTER TABLE
                        `$table`
                    ADD UNIQUE (`$field`)";
                $this->db->query($sql);
            }
        }

        function innodb($table){
            $sql = "ALTER TABLE  `$table` ENGINE = INNODB";
            $this->db->query($sql);
        }

        function foreign_key($table, $keys=array()){
            $table_help = $table . '_ibfk_';
            foreach ($keys as $key => $data) {
                $sql = "ALTER TABLE  `$table`
                    ADD CONSTRAINT `$table_help$key`
                    FOREIGN KEY (`$data[field_from]`)
                    REFERENCES `$data[table_to]` (`id`)";
                $this->db->query($sql);
            }
        }

        function change_character_set($table, $fields=array()){
            $sql = "ALTER TABLE
                        `$table`
                    CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci";
            $this->db->query($sql);
            foreach ($fields as $field) {
                $sql = "ALTER TABLE
                        `$table`
                    MODIFY
                        `$field[0]` VARCHAR($field[1])
                    CHARACTER SET utf8
                    COLLATE utf8_unicode_ci NOT NULL";
                $this->db->query($sql);
            }
        }

        function create_keys($keys=array()){
            foreach ($keys as $key) {
                $this->dbforge->add_key($key[0], $key[1]);
            }
        }

        function sql_extra($sql_extra=array()){
            foreach ($sql_extra as $sql) {
                $this->db->query($sql);
            }
        }*/

        function primary_key($fields=array()) {
            foreach ($fields as $key => $field) {
                if(isset($field['primary_key'])) {
                    $this->dbforge->add_key($key, TRUE);
                }
            }
        }

        function create_table($config){

            $fields = $config['fields'];
            $table = $config['table'];

            $this->dbforge->add_field($fields);
            $this->primary_key($fields);

            //$this->create_keys($keys);
            $this->dbforge->create_table($table, TRUE);


            /*if(isset($config['extra']) && $config['extra']) {
                $this->sql_extra($config['extra']);
            }

            if(!(isset($config['innodb']) && $config['innodb'] === FALSE)) {
                $this->innodb($table);
            }

            if(isset($config['utf8']) && $config['utf8']) {
                $this->change_character_set($table, $config['utf8']);
            }

            if(isset($config['unique']) && $config['unique']) {
                $this->unique($table, $config['unique']);
            }

            if(isset($config['foreigns']) && $config['foreigns']) {
                $this->foreign_key($table, $config['foreigns']);
            }*/

        }

    }
?>
