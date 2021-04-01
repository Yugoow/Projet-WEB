<?php
namespace core;
use \PDOException;
class Candidatures extends Model{

	private Model $parent;

	public function __construct(Model $parent){
		$this->parent = $parent;
	}



	public function ajout($param){
		try {
			$sql = "INSERT INTO postuler (id, id_Offres, Etat) 
					VALUES (:id_user, :id_offre, 0);";
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
			$sql = "DELETE FROM postuler WHERE id_Offres=:id";
			$stmt = $this->parent->prepare($sql);
			$stmt->execute(['id'=>$param]);
			return true;


		}
	    catch(PDOException $e) {
	    	//echo $sql . "<br>" . $e->getMessage();
	    	return false;
	    }
	}

	public function getbyID($id){
		try {
			$sql = "SELECT offres.id, postule.Etat, `Competence`, `Type_promo`, `Duree`, `Remuneration`, `Date_offre`, `Nombre_places`,  `Titre`, `id_Entreprises`FROM offres JOIN (SELECT postuler.id AS id,postuler.Etat AS Etat, postuler.id_Offres AS ID_offre FROM postuler WHERE id =:id) AS postule WHERE ID_offre=offres.id";
			$stmt = $this->parent->prepare($sql);
			$stmt->execute(['id'=>$id]);
			$q=$stmt->fetchAll();
			return $q;

		}
	    catch(PDOException $e) {
	    	echo $sql . "<br>" . $e->getMessage();
	    }
	}

}



?>