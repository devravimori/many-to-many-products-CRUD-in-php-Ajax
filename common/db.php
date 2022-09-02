<?php
    class db{
        private $hostname="";
        private $username="";
        private $password="";
        private $dbname="";
        private $query="";
        private $conn="";
        public $err =[];

        function __construct($host,$user,$pass,$db){
            $this->hostname = $host;
            $this->username = $user;
            $this->password = $pass;
            $this->dbname = $db;

                try{
                    $this->conn = new mysqli($this->hostname,$this->username,$this->password,$this->dbname);
                        if($this->conn->connect_error){
                            die($this->err['connection']="connection error");
                        }
                }catch(Exception $e){
                    die("exception ".$e->getMessage());
                }
        }

        function statement($query){
            $this->query = $query;
        }

        function execute(){
            try{
                return $this->conn->query($this->query);
            }catch(Exeption $e){
                echo $e->getMessage();
            }
        }

        function getErr(){
            return $this->err;
        }

        // get last inserted id
        function getLastId(){
            return $this->conn->insert_id;
        }

        function realstr($e){
             return  mysqli_real_escape_string($this->conn,$e);
        }   

        function __destruct(){
            if($this->conn){
                $this->conn->close();
            }
        }
    }

?>