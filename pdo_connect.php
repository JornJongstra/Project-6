<?php
    //data base class
    class Database{
		protected $dbh = null;

		protected $Host = 'localhost';
		protected $db1 = 'project-6';
		protected $user = 'root';
		protected $pass = '';

		public function Connect(){
			try{
				$this->dbh = new PDO('mysql:host='.$this->Host.';dbname='.$this->db1, $this->user, $this->pass);
				return $this->dbh;
			}catch(PDOException $Exception){
				die('error');
			}
		}

		public function Close(){
			$this->dbh = null;
		}
	}
?>
