<?php
namespace core;
use \PDOException;
class Offres extends Model{

	private Model $parent;

	public function __construct(Model $parent){
		$this->parent = $parent;
	}



	public function creation($inputs){
		try {
			$sql = "INSERT INTO offres (Competence, Type_promo, Duree, Remuneration, Date_offre, Nombre_places, id_Entreprises, Titre) 
					VALUES (:Competences, :Promotion, :Duree, :gratif, :Date, :Places, :id_E, :Titre);";
			$stmt = $this->parent->prepare($sql);
			$id=array_shift($inputs); //si id inutile
			$stmt->execute($inputs);
			return ['success',"L'offre de ".$inputs["id_E"]." ".$inputs["Titre"]." a été créée avec succès !"];

		}
	    catch(PDOException $e) {
	    	//echo $sql . "<br>" . $e->getMessage();
	    	return ['warning',"L'offre n'a pas pu être créée. Verifiez que l'entreprise existe bien dans la base de données"];
	    }
	}

	public function suppression($inputs){
		try {
			$sql = "DELETE FROM offres WHERE id=:ID";
			$stmt = $this->parent->prepare($sql);
			$stmt->execute(['ID'=>$inputs['ID']]);
			return ['success',"L'offre de ".$inputs["id_E"]." a été suprimée avec succès !"];

		}
	    catch(PDOException $e) {
	    	//echo $sql . "<br>" . $e->getMessage();
	    	return ['warning',"L'offre de ".$inputs["id_E"]." n'a pas pu être suprimée"];
	    }
	}



	public function getbyID($id){
		try {
			$sql = "SELECT Type_promo, Duree, Remuneration, Nombre_places, id_Entreprises, Date_offre , Competence, Titre FROM offres WHERE id=:id ";
			$stmt = $this->parent->prepare($sql);
			$stmt->execute(['id'=>$id]);
			$q=$stmt->fetch();
			return $q;

		}
	    catch(PDOException $e) {
	    	echo $sql . "<br>" . $e->getMessage();
	    }
	}

}



?>