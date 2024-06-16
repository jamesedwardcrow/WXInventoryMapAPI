<?php
    class FindProduct{
        // Connection
        private $conn;
		// Table
        private $db_table = "primarybarsamian";
		// Columns
        public $imf;
        public $description;
        public $type_issue;
        public $vend_num;
		public $man_num;
		public $location;
        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }
	// GET ALL
        public function getProducts(){
			$param = $_GET['v'] ?? null;
			$param2 = $_GET['a'] ?? null;
			
			$sqlQuery = "SELECT imf, description, type_issue, vend_num, man_num, location FROM primarybarsamian WHERE description LIKE CONCAT('%', ?, '%') 
						AND description LIKE CONCAT('%', ?, '%')";
			
			$stmt = $this->conn->prepare($sqlQuery);
			$stmt->bindParam(1, $param);
			$stmt->bindParam(2, $param2);
			
            $stmt->execute();

            return $stmt;
        }
    }
?>