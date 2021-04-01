<?php
namespace core;
use \PDOException;
class Utilisateurs extends Model{

	private Model $parent;


	public function __construct(Model $parent){
		$this->parent = $parent;
	}



	public function creation($inputs){
		try {
			$sql = "INSERT INTO utilisateurs (Nom, Prenom, Centre, Promotion, Identifiant, id_Roles) 
					VALUES (:Nom, :Prenom, :Centre, :Promotion, :email, :id_R);INSERT INTO wish_list (id_Utilisateurs) SELECT MAX(id) FROM utilisateurs;";
			$stmt = $this->parent->prepare($sql);
			$id=array_shift($inputs); //si id inutile
			$stmt->execute($inputs);
			return ['success',"L'utilisateur ".$inputs["Nom"]." ".$inputs['Prenom']." a été créé avec succès !"];

		}
	    catch(PDOException $e) {
	    	//echo $sql . "<br>" . $e->getMessage();
	    	return ['warning',"L'utilisateur ".$inputs["Nom"]." ".$inputs['Prenom']." n'a pas pu être créé. Verifiez que l'adresse email n'appartienne pas déjà à un utilisateur."];
	    }
	}

	public function suppression($inputs){
		try {
			$sql = "DELETE FROM utilisateurs WHERE id=:ID";
			$stmt = $this->parent->prepare($sql);
			$stmt->execute(['ID'=>$inputs['ID']]);
			return ['success',"L'utilisateur ".$inputs["Nom"]." ".$inputs['Prenom'].", email = ".$inputs['Identifiant']." | ID = ".$inputs['ID']." a été supprimé avec succès !"];

		}
	    catch(PDOException $e) {
	    	//echo $sql . "<br>" . $e->getMessage();
	    	return ['warning',"L'utilisateur ".$inputs["Nom"]." ".$inputs['Prenom']." n'a pas pu être supprimé."];
	    }
	}

	
	public function modification($inputs){
		try {
			$sql = "UPDATE utilisateurs SET Nom =:Nom, Prenom=:Prenom, Centre=:Centre, Promotion=:Promotion, Identifiant=:email, id_Roles=:id_R WHERE id=:ID";
			$stmt = $this->parent->prepare($sql);
			$stmt->execute($inputs);
			return ['success',"L'utilisateur ".$inputs["Nom"]." ".$inputs['Prenom'].", email = ".$inputs['email']." | ID = ".$inputs['ID']." a été modifé avec succès !"];

		}
	    catch(PDOException $e) {
	    	//echo $sql . "<br>" . $e->getMessage();
	    	return ['warning',"L'utilisateur ".$inputs["Nom"]." ".$inputs['Prenom']." n'a pas pu être modifé."];
	    }
	}


	public function getbyID($id){
		try {
			$sql = "SELECT Nom, Prenom , Centre, Promotion, Identifiant, id_Roles FROM utilisateurs WHERE id=:id ";
			$stmt = $this->parent->prepare($sql);
			$stmt->execute(['id'=>$id]);
			$q=$stmt->fetch();
			return $q;

		}
	    catch(PDOException $e) {
	    	echo $sql . "<br>" . $e->getMessage();
	    }
	}

	public function getIDbyArg($args){
		try {
			$sql = "SELECT id FROM utilisateurs WHERE Identifiant = :email";
			$stmt = $this->parent->prepare($sql);
			$stmt->execute(['email'=>$args]);
			$q=$stmt->fetch();
			return $q;

		}
	    catch(PDOException $e) {
	    	echo $sql . "<br>" . $e->getMessage();
	    }		
	}

	public function getID($id){
		try {
			$sql = "SELECT k.id as Id, k.Nom as Nom, k.Prenom as Prenom, k.Centre as Centre, k.Promo as Promo, k.Identifiant as Identifiant, k.Role as Role from (SELECT utilisateurs.id as id, utilisateurs.Nom as Nom, utilisateurs.Prenom as Prenom, utilisateurs.Centre as Centre, utilisateurs.Promotion as Promo, utilisateurs.Identifiant as Identifiant, utilisateurs.id_Roles as id_role, roles.Type as Role FROM utilisateurs INNER JOIN roles where utilisateurs.id_Roles=roles.id)as K where id=:id;";
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
			$sql = "SELECT k.id as Id, k.Nom as Nom, k.Prenom as Prenom, k.Centre as Centre, k.Promo as Promo, k.Identifiant as Identifiant, k.Role as Role from (SELECT utilisateurs.id as id, utilisateurs.Nom as Nom, utilisateurs.Prenom as Prenom, utilisateurs.Centre as Centre, utilisateurs.Promotion as Promo, utilisateurs.Identifiant as Identifiant, utilisateurs.id_Roles as id_role, roles.Type as Role FROM utilisateurs INNER JOIN roles where utilisateurs.id_Roles=roles.id)as K where Nom=:nom;";
			$stmt = $this->parent->prepare($sql);
			$stmt->execute(['nom'=>$id]);
			$q=$stmt->fetchAll();
			return $q;

		}
	    catch(PDOException $e) {
	    	echo $sql . "<br>" . $e->getMessage();
	    }
	}
	
	public function getPromo($id){
		try {
			$sql = "SELECT k.id as Id, k.Nom as Nom, k.Prenom as Prenom, k.Centre as Centre, k.Promo as Promo, k.Identifiant as Identifiant, k.Role as Role from (SELECT utilisateurs.id as id, utilisateurs.Nom as Nom, utilisateurs.Prenom as Prenom, utilisateurs.Centre as Centre, utilisateurs.Promotion as Promo, utilisateurs.Identifiant as Identifiant, utilisateurs.id_Roles as id_role, roles.Type as Role FROM utilisateurs INNER JOIN roles where utilisateurs.id_Roles=roles.id)as K where Promo=:promo;";
			$stmt = $this->parent->prepare($sql);
			$stmt->execute(['promo'=>$id]);
			$q=$stmt->fetchAll();
			return $q;

		}
	    catch(PDOException $e) {
	    	echo $sql . "<br>" . $e->getMessage();
	    }
	}
	
	public function getCentre($id){
		try {
			$sql = "SELECT k.id as Id, k.Nom as Nom, k.Prenom as Prenom, k.Centre as Centre, k.Promo as Promo, k.Identifiant as Identifiant, k.Role as Role from (SELECT utilisateurs.id as id, utilisateurs.Nom as Nom, utilisateurs.Prenom as Prenom, utilisateurs.Centre as Centre, utilisateurs.Promotion as Promo, utilisateurs.Identifiant as Identifiant, utilisateurs.id_Roles as id_role, roles.Type as Role FROM utilisateurs INNER JOIN roles where utilisateurs.id_Roles=roles.id)as K where Centre=:centre;";
			$stmt = $this->parent->prepare($sql);
			$stmt->execute(['centre'=>$id]);
			$q=$stmt->fetchAll();
			return $q;

		}
	    catch(PDOException $e) {
	    	echo $sql . "<br>" . $e->getMessage();
	    }
	}
	
	public function getIdentifiant($id){
		try {
			$sql = "SELECT k.id as Id, k.Nom as Nom, k.Prenom as Prenom, k.Centre as Centre, k.Promo as Promo, k.Identifiant as Identifiant, k.Role as Role from (SELECT utilisateurs.id as id, utilisateurs.Nom as Nom, utilisateurs.Prenom as Prenom, utilisateurs.Centre as Centre, utilisateurs.Promotion as Promo, utilisateurs.Identifiant as Identifiant, utilisateurs.id_Roles as id_role, roles.Type as Role FROM utilisateurs INNER JOIN roles where utilisateurs.id_Roles=roles.id)as K where Identifiant=:mail;";
			$stmt = $this->parent->prepare($sql);
			$stmt->execute(['mail'=>$id]);
			$q=$stmt->fetchAll();
			return $q;

		}
	    catch(PDOException $e) {
	    	echo $sql . "<br>" . $e->getMessage();
	    }
	}

}



?>