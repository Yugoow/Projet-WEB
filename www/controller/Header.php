<?php

class Header extends Controller {
	private $default_menu;
	private $menu;
	private $user;
	private Controller $parent;


	function __construct(Controller $parent){
		$this->parent = $parent;
		$this->default_menu = array(
			1=>array('nom' => 'Offres', 'url' => '?p=offres'),
			2=>array('nom' => 'Entreprises', 'url' => '?p=offres'),
			4=>array('nom' => 'WISH-LIST', 'url' => '?p=connexion'),
			5=>array('nom' => 'Candidature', 'url' => '?p=candidature'),
			6=>array('nom' => 'Compte', 'url' => '?p=connexion'),
			7=>array('nom' => 'Deconnexion', 'url' => '?p=connexion',  'id'=>'id=discret'));

		$this->user = $_SERVER['REMOTE_USER']; //Ici récupérer le role (et pas utilisateur) de l'utilisateur pour vérifier l'accès au menu pour l'accès aux pages. 
	}

	function tryheader($var){
		switch($this->user){
			case 'admin':
				$this->menu = $this->default_menu;
				$this->menu[3]= array('nom'=>'Gestion', 'url'=>'?p=gestion');
				$this->menu[8]= array('nom'=>'TEMP ADMIN', 'url'=>'?p=add');
				ksort($this->menu);
				break;

			case 'tuteur':
				# code...
				break;

			case 'delegue':
				# code...
				break;

			case 'etudiant':
				$this->menu = $this->default_menu;
				break;
			default:
				$denied=true;
				header('HTTP/1.0 403 Forbidden');
				break;
		}

		if(empty($denied)){
			echo $this->parent->twig->render('header.twig', ['seq'=> $this->menu, 'var'=>$var]);
		}
	}
}

?>