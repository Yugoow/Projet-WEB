<?php
namespace core;
require_once('./vendor/autoload.php');
require_once('Model.php');
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
	    $this->head = new Header();
	}


	function select($page){
		switch($page) {
		    case 'index':
		    	$index = new Index($this);
		        break;
		    case 'gestion':
		        $gestion = new Gestion($this);
		        $gestion->generateGestion();
		        break;
		    case 'wishlist':
		        $wishlist = new Wishlist($this);
		        break;
		    case 'candidature':
		        $candidature = new Candidature($this);
		        break;
		    case 'compte':
		        $compte = new Compte($this);
		        break;
		    case 'entreprise':
		        $entreprise = new Entreprise($this);
		        break;
		    case 'offre':
		        $offre = new Offre($this);
		        $offre->generateOffre();
		        break;
		    case 'deconnexion':
		        $deconnexion = new Deconnexion($this);
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

}

