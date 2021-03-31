<?php
namespace core;
use \PDOException;

class Wish_list extends Model{

	private Model $parent;

	public function __construct(Model $parent){
		$this->parent = $parent;
	}



	public function ajout($param){
		try {
			$sql = "INSERT INTO wish_list (id_Utilisatuers) 
					VALUES (:id_user);";
			$stmt = $this->parent->prepare($sql);
			$stmt->execute(['id_user'=>$param]);

		}
	    catch(PDOException $e) {
	    	echo $sql . "<br>" . $e->getMessage();
	    }
	}

	public function suppression($inputs){
		try {
			$sql = "DELETE FROM container WHERE id=(SELECT id FROM wish_list WHERE id_Utilisateurs=:ID);DELETE FROM wish_list WHERE id_Utilisateurs=:ID";
			$stmt = $this->parent->prepare($sql);
			$stmt->execute(['ID'=>$inputs['ID']]);

		}
	    catch(PDOException $e) {
	    	echo $sql . "<br>" . $e->getMessage();
	    }
	}



	public function getbyID($id){
		try {
			$sql = "SELECT offres.id, `Competence`, `Type_promo`, `Duree`, `Remuneration`, `Date_offre`, `Nombre_places`, `Titre`, `id_Entreprises` FROM offres JOIN (SELECT contenir.id AS id, contenir.id_Offres AS ID_offre FROM contenir JOIN wish_list WHERE contenir.id=wish_list.id AND wish_list.id_Utilisateurs=:id) AS woffre WHERE offres.id=woffre.ID_offre ORDER BY woffre.id";
			$stmt = $this->parent->prepare($sql);
			$stmt->execute(['id'=>$id]);
			$q=$stmt->fetchAll();
			return $q;

		}
	    catch(PDOException $e) {
	    	echo $sql . "<br>" . $e->getMessage();
	    }
	}


	public function getIDbyUser($param){
		try {
			$sql = "SELECT wish_list.id FROM wish_list WHERE wish_list.id_Utilisateurs = :id_user";
			$stmt = $this->parent->prepare($sql);
			$stmt->execute(['id_user'=>$param]);
			$q=$stmt->fetch();
			return $q;

		}
	    catch(PDOException $e) {
	    	echo $sql . "<br>" . $e->getMessage();
	    }
	}



}



?>