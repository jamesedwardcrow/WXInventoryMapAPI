<?php
class DBClass {

    public $conn;

    public function getConnection(){

        $this->conn = null;

        try{
			$this->conn = new PDO("mysql:host=HOSTNAME;dbname=DATABASENAME;charset=UTF8", "USERNAME", "PASSWORD");

        }catch(PDOException $exception){
            echo "Error: " . $exception->getMessage();
        }

        return $this->conn;
    }
}
?>