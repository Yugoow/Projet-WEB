<?php

namespace core;
use \PDO;
$dir = opendir('model/');

while(($currentFile = readdir($dir)) !== false){
    if ( $currentFile == '.' or $currentFile == '..' ){
        continue;
    }
    require_once('model/'.$currentFile);
}
closedir($dir);

class Model {
	private $db_name;
	private $db_user;
	private $db_pass;
	private $db_host;
	private $pdo;

	public function __construct($db_name, $db_user = 'root', $db_pass ='', $db_host = 'localhost'){
		$this->db_name= $db_name;
		$this->db_user= $db_user;
		$this->db_pass= $db_pass;
		$this->db_host= $db_host;
	}


	private function getPDO() {
		if($this->pdo == null){
			try {
				$this->pdo = new PDO('mysql:host='.$this->db_host.';dbname='.$this->db_name, $this->db_user, $this->db_pass);
				$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				
			} catch (PDOException $e) {
			    print "Erreur !: " . $e->getMessage() . "<br/>";
			    die();
			}
		}
		return $this->pdo;
	}

	public function query($q_string, $class_name){
		$req = $this->getPDO()->query($q_string);
		$data = $req->fetchAll(PDO::FETCH_CLASS, $class_name);
		return $data;
	}

	public function prepare($q_string){
		$req = $this->getPDO()->prepare($q_string);
		return $req;
	}
}
?>