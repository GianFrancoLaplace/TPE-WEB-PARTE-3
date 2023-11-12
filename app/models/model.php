<?php
    include_once 'config.php';
    class Model{
        protected $db;
        function __construct(){
            $this->db = $this->getConnection();     
        }

        protected function getConnection(){
            return new PDO("mysql:host=" . DB_HOST .";dbname=" . DB_NAME . ";charset=utf8", DB_USER, DB_PASS);
        }
    }