<?php
namespace core;
require_once('./vendor/autoload.php');
require_once('Model.php');
require_once('model/Utilisateurs.php');
$dir = opendir('controller/');

while(($currentFile = readdir($dir)) !== false){
    if ( $currentFile == '.' or $currentFile == '..' ){
        continue;
    }
    require_once('controller/'.$currentFile);
}
closedir($dir);


class Controller{
	protected $loader;
	protected $twig;
	protected $head;
	private $index;
	private $user;
	protected $db;


	public function __construct(){
		$this->loader =  new \Twig\Loader\FilesystemLoader('./templates');
		$this->twig = new \Twig\Environment($this->loader, [
	    	'cache' => false//__DIR__.'/tmp'
	    ]);
	    $this->db = new Model('projet_web');
	    if(empty($_SESSION)){
	    	$this->setSession();
	    }
	    $this->head = new Header();

	}


	function select($page){
		switch($page) {
		    case 'index':
		    	$index = new Index($this);
		    	$index->generateIndex();
		        break;
		    case 'gestion':
		        $gestion = new Gestion($this);
		        $gestion->generateGestion();
		        break;
		    case 'wishlist':
		        $wishlist = new Wishlist($this);
		        $wishlist->generateWishlist();
		        break;
		    case 'candidature':
		        $candidature = new Candidature($this);
		        $candidature->generateCandidature();
		        break;
		    case 'compte':
		        $compte = new Compte($this);
		        $compte->generateCompte();
		        break;
		    case 'entreprise':
		        $entreprise = new Entreprise($this);
		        $entreprise->generateEntreprise();
		        break;
		    case 'offre':
		        $offre = new Offre($this);
		        $offre->generateOffre();
		        break;

		    // A SUPPRIMER
		    case 'test':
		        echo $this->twig->render('test.twig', ['title'=>"toi"]);
		        break;

		    default:
		        header('HTTP/1.0 404 Not Found');
		        echo $this->twig->render('404.twig');
		        break;
		}
	}

	function setSession(){

		$username = $_SERVER['REMOTE_USER'];

		$_SESSION['Identifiant'] = $username;
		$user = new Utilisateurs($this->db);
		$id_array = $user->getIDbyArg($_SESSION['Identifiant']);
		$informations =$user->getbyID($id_array['id']);

		setcookie("id_user", $id_array['id'], time()+3600);
		$_SESSION['id']=$id_array['id'];
		$_SESSION['Nom']=$informations['Nom'];
		$_SESSION['Prenom']=$informations['Prenom'];
		$_SESSION['Centre']=$informations['Centre'];
		$_SESSION['Promotion']=$informations['Promotion'];
		$_SESSION['id_Roles']=$informations['id_Roles'];
		//header("Refresh:0"); //Si il y a des erreurs de rafraichissement


	}

}

