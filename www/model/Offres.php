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
			$name = array_pop($inputs);
			$stmt->execute($inputs);
			return ['success',"L'offre de ".$name." ".$inputs["Titre"]." a été créée avec succès !"];

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


	public function getlastOffres(){
		try {
			$sql = "SELECT id, Competence, Type_promo, Duree, Remuneration, Date_offre, Nombre_places, Titre, id_Entreprises FROM offres ORDER BY id DESC LIMIT 6;";
			$stmt = $this->parent->prepare($sql);
			$stmt->execute();
			$q=$stmt->fetchAll();
			return $q;

		}
	    catch(PDOException $e) {
	    	echo $sql . "<br>" . $e->getMessage();
	    }
	}


public function getbyID($id){
		try {
			$sql = "SELECT k.id as id, k.Competence as Competence, k.Promo as Promo, k.Duree as Duree, k.Remuneration as Remuneration, k.Date_offre as Date_offre, k.Nombre_place as Nombre_place, k.Nom as Nom, k.Titre as Titre from (SELECT offres.id as id, offres.Competence as Competence, offres.Type_Promo as Promo, offres.Duree as Duree, offres.Remuneration as Remuneration, offres.Date_offre as Date_offre, offres.Nombre_places as Nombre_place, entreprises.Nom as Nom, offres.Titre as Titre FROM entreprises INNER JOIN offres where offres.id_Entreprises=entreprises.id)as K where id=:id;";
			$stmt = $this->parent->prepare($sql);
			$stmt->execute(['id'=>$id]);
			$q=$stmt->fetchAll();
			return $q;

		}
	    catch(PDOException $e) {
	    	echo $sql . "<br>" . $e->getMessage();
	    }
	}
	
	public function getName($id){
		try {
			$sql = "SELECT k.id as id, k.Competence as Competence, k.Promo as Promo, k.Duree as Duree, k.Remuneration as Remuneration, k.Date_offre as Date_offre, k.Nombre_place as Nombre_place, k.Nom as Nom, k.Titre as Titre from (SELECT offres.id as id, offres.Competence as Competence, offres.Type_Promo as Promo, offres.Duree as Duree, offres.Remuneration as Remuneration, offres.Date_offre as Date_offre, offres.Nombre_places as Nombre_place, entreprises.Nom as Nom, offres.Titre as Titre FROM entreprises INNER JOIN offres where offres.id_Entreprises=entreprises.id)as K where Titre=:titre;";
			$stmt = $this->parent->prepare($sql);
			$stmt->execute(['titre'=>$id]);
			$q=$stmt->fetchAll();
			return $q;

		}
	    catch(PDOException $e) {
	    	echo $sql . "<br>" . $e->getMessage();
	    }
	}
	
	public function getPromo($id){
		try {
			$sql = "SELECT k.id as id, k.Competence as Competence, k.Promo as Promo, k.Duree as Duree, k.Remuneration as Remuneration, k.Date_offre as Date_offre, k.Nombre_place as Nombre_place, k.Nom as Nom, k.Titre as Titre from (SELECT offres.id as id, offres.Competence as Competence, offres.Type_Promo as Promo, offres.Duree as Duree, offres.Remuneration as Remuneration, offres.Date_offre as Date_offre, offres.Nombre_places as Nombre_place, entreprises.Nom as Nom, offres.Titre as Titre FROM entreprises INNER JOIN offres where offres.id_Entreprises=entreprises.id)as K where Promo=:promo;";
			$stmt = $this->parent->prepare($sql);
			$stmt->execute(['promo'=>$id]);
			$q=$stmt->fetchAll();
			return $q;
			
			

		}
	    catch(PDOException $e) {
	    	echo $sql . "<br>" . $e->getMessage();
	    }
	}
	
	public function getDuree($id){
		try {
			$sql = "SELECT k.id as id, k.Competence as Competence, k.Promo as Promo, k.Duree as Duree, k.Remuneration as Remuneration, k.Date_offre as Date_offre, k.Nombre_place as Nombre_place, k.Nom as Nom, k.Titre as Titre from (SELECT offres.id as id, offres.Competence as Competence, offres.Type_Promo as Promo, offres.Duree as Duree, offres.Remuneration as Remuneration, offres.Date_offre as Date_offre, offres.Nombre_places as Nombre_place, entreprises.Nom as Nom, offres.Titre as Titre FROM entreprises INNER JOIN offres where offres.id_Entreprises=entreprises.id)as K where Duree=:duree;";
			$stmt = $this->parent->prepare($sql);
			$stmt->execute(['duree'=>$id]);
			$q=$stmt->fetchAll();
			return $q;

		}
	    catch(PDOException $e) {
	    	echo $sql . "<br>" . $e->getMessage();
	    }
	}

}



?>