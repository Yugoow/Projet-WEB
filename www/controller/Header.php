<?php
namespace core;
class Header extends Controller {
	private $default_menu;
	public $menu;
	private $user;


	function __construct(){
		$this->default_menu = array(
			1=>array('nom' => 'Accueil', 'url' => '/'),
			2=>array('nom' => 'Offres', 'url' => '?p=offre'),
			5=>array('nom' => 'Entreprises', 'url' => '?p=entreprise'),
			7=>array('nom' => 'Candidature', 'url' => '?p=candidature'),
			8=>array('nom' => 'Compte', 'url' => '?p=compte'),
			9=>array('nom' => 'Deconnexion', 'url' => 'deconnexion.php',  'id'=>'id=discret'));

		$this->user = $_SESSION['id_Roles'];
	}

	function generateHeader(){

		switch($this->user){
			case 1:
				$this->menu = $this->default_menu;
				$this->menu[3]= array('nom'=>'Gestion', 'url'=>'?p=gestion');
				$this->menu[4]= array('nom' => 'Utilisateurs', 'url' => '?p=utilisateur');
				$this->menu[6]= array('nom' => 'WISH-LIST', 'url' => '?p=wishlist');
				ksort($this->menu);
				break;

			case 2:
				$this->menu = $this->default_menu;
				$this->menu[4]= array('nom' => 'Utilisateurs', 'url' => '?p=utilisateur');
				ksort($this->menu);
				break;

			case 3:
				$this->menu = $this->default_menu;
				$this->menu[6]= array('nom' => 'WISH-LIST', 'url' => '?p=wishlist');
				ksort($this->menu);
				break;

			case 4:
				$this->menu = $this->default_menu;
				$this->menu[6]= array('nom' => 'WISH-LIST', 'url' => '?p=wishlist');
				ksort($this->menu);
				break;
			default:
				$denied=true;
				header('HTTP/1.0 403 Forbidden');
				break;
		}

	}
}

?>