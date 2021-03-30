<?php
namespace core;
class Header extends Controller {
	private $default_menu;
	public $menu;
	private $user;


	function __construct(){
		$this->default_menu = array(
			1=>array('nom' => 'Offres', 'url' => '?p=offre'),
			2=>array('nom' => 'Entreprises', 'url' => '?p=entreprise'),
			4=>array('nom' => 'WISH-LIST', 'url' => '?p=wishlist'),
			5=>array('nom' => 'Candidature', 'url' => '?p=candidature'),
			6=>array('nom' => 'Compte', 'url' => '?p=compte'),
			7=>array('nom' => 'Deconnexion', 'url' => '?p=deconnexion',  'id'=>'id=discret'));

		$this->user = $_SERVER['REMOTE_USER']; //Ici récupérer le role (et pas utilisateur) de l'utilisateur pour vérifier l'accès au menu pour l'accès aux pages. 
	}

	function generateHeader(){
		switch($this->user){
			case 'admin':
				$this->menu = $this->default_menu;
				$this->menu[3]= array('nom'=>'Gestion', 'url'=>'?p=gestion');
				ksort($this->menu);
				break;

			case 'tuteur':
				$this->menu = $this->default_menu;
				break;

			case 'delegue':
				$this->menu = $this->default_menu;
				break;

			case 'etudiant':
				$this->menu = $this->default_menu;
				break;
			default:
				$denied=true;
				header('HTTP/1.0 403 Forbidden');
				break;
		}

	}
}

?>