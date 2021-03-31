<?php
namespace core;
use \PDOException;
class Contenir extends Model{

	private Model $parent;

	public function __construct(Model $parent){
		$this->parent = $parent;
	}



	public function ajout($param){
		try {
			$sql = "INSERT INTO contenir (id, id_Offres) 
					VALUES (:id_wlist, :id);";
			$stmt = $this->parent->prepare($sql);
			$stmt->execute($param);
			return true;

		}
	    catch(PDOException $e) {
	    	//echo $sql . "<br>" . $e->getMessage();
	    	return false;

	    }
	}

	public function suppression($param){
		try {
			$sql = "DELETE FROM contenir WHERE id_Offres=:id";
			$stmt = $this->parent->prepare($sql);
			$stmt->execute($param);
			return true;


		}
	    catch(PDOException $e) {
	    	//echo $sql . "<br>" . $e->getMessage();
	    	return false;
	    }
	}




}



?>