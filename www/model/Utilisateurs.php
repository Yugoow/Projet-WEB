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
					VALUES (:Nom, :Prenom, :Centre, :Promotion, :email, :id_R);";
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


/*


	//met à jour le user
	function updateUser($id, $nom, $prenom, $age, $adresse) {
		try {
			$con = getDatabaseConnexion();
			$requete = "UPDATE utilisateurs set 
						nom = '$nom',
						prenom = '$prenom',
						age = '$age',
						adresse = '$adresse' 
						where id = '$id' ";
			$stmt = $con->query($requete);
		}
	    catch(PDOException $e) {
	    	echo $sql . "<br>" . $e->getMessage();
	    }
	}
*/
}



?>