<?php
class PDOConfig extends PDO
    {
        private $server;
        private $host;
        private $database;
        private $username;
        private $password;
        public function __construct($database)
        {
            $this->server = 'mysql';
            $this->host = 'localhost';
            $this->database = $database;
            $this->username = 'root';
            $this->password = '';
            $pdo = $this->server . ':dbname=' . $this->database . ";host=" . $this->host;
            parent::__construct( $pdo, $this->username, $this->password );
            $this->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC); 
        }
    }
?>