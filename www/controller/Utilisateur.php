<?php

namespace core;
class Utilisateur extends Controller{
    protected $head;
    private Controller $parent;
	private Utilisateurs $utilisateur;

    function __construct(Controller $parent){
    	$this->parent = $parent;
        $this->parent->head->generateHeader();
		$this->utilisateur = new Utilisateurs($this->parent->db);
    }
	
	protected function generateUtilisateur(){
        if($_SESSION['id_Roles']==3 || $_SESSION['id_Roles']==4 ){
            header('HTTP/1.0 403 Forbidden');
            return false;
        }

		$donnee="";
		
		if(!empty($_POST['Search_id'])){
			$id = $_POST['Search_id'];
			$donnee = $this->utilisateur->getID($id);
		}else if(!empty($_POST['in_search'])){
			$id = $_POST['in_search'];
			$donnee = $this->utilisateur->getName($id);
		}else if(!empty($_POST['promo_selec'])){
			$id = $_POST['promo_selec'];
			$donnee = $this->utilisateur->getPromo($id);
		}else if(!empty($_POST['centre_search'])){
			$id = $_POST['centre_search'];
			$donnee = $this->utilisateur->getCentre($id);
		}else if(!empty($_POST['mail_search'])){
			$id = $_POST['mail_search'];
			$donnee = $this->utilisateur->getIdentifiant($id);
		}

		echo $this->parent->twig->render('utilisateurs.twig', ['seq'=>$this->parent->head->menu, 'utilisateurs'=>$donnee, 'myid'=>$_SESSION['id_Roles']]);


	}

	

}


?>