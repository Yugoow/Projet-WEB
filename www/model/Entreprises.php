<?php
namespace core;
use \PDOException;
class Entreprises extends Model{

	private Model $parent;

	public function __construct(Model $parent){
		$this->parent = $parent;
	}


/* A FAIRE CREATION ET SUPPRESSION CAR APS ENCORE FAIT + MODIF ETC*/
	public function creation($inputs){
		try {
			$sql = "INSERT INTO entreprises (Nom , Secteur_activite, Localite, Email, Nombre_etudiants, Confiance) 
					VALUES (:Nom, :Secteur, :Localisation, :email, :E_Acceptes, :Confiance);";
			$stmt = $this->parent->prepare($sql);
			$id=array_shift($inputs); //si id inutile
			$stmt->execute($inputs);
			return ['success',"L'entreprise ".$inputs['Nom']." a été créée avec succès !"];

		}
	    catch(PDOException $e) {
	    	echo $sql . "<br>" . $e->getMessage();
	    	return ['warning',"L'entreprise n'a pas pu être créée. Verifiez que l'adresse email n'appartienne pas déjà à une entreprise."];
	    }
	}

	public function suppression($inputs){
		try {
			$sql = "DELETE FROM entreprises WHERE id=:ID";
			$stmt = $this->parent->prepare($sql);
			$stmt->execute(['ID'=>$inputs['ID']]);
			return ['success',"L'entreprise ".$inputs["Nom"]." | ID : ".$inputs['ID']." a été supprimée avec succès !"];

		}
	    catch(PDOException $e) {
	    	//echo $sql . "<br>" . $e->getMessage();
	    	return ['warning',"L'entreprise n'a pas pu être supprimée."];
	    }
	}



	public function getbyID($id){
		try {
			$sql = "SELECT Nom, Secteur_activite, Localite, Email, Nombre_etudiants, Confiance FROM entreprises WHERE id=:id ";
			$stmt = $this->parent->prepare($sql);
			$stmt->execute(['id'=>$id]);
			$q=$stmt->fetch();
			return $q;

		}
	    catch(PDOException $e) {
	    	echo $sql . "<br>" . $e->getMessage();
	    }
	}

    public function getIDbyArg($arg){
        try {
            $sql = "SELECT id FROM entreprises WHERE Nom=:Nom";
            $stmt = $this->parent->prepare($sql);
            $stmt->execute(['Nom'=>$arg]);
            $q=$stmt->fetch();
            return $q;

        }
        catch(PDOException $e) {
            echo $sql . "<br>" . $e->getMessage();
        }       
    }
}



?>