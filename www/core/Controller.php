<?php
require_once('./vendor/autoload.php');

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
	private $index;
	private $user;


	public function __construct(){
		$this->loader =  new \Twig\Loader\FilesystemLoader('./templates');
		$this->twig = new \Twig\Environment($this->loader, [
	    	'cache' => false//__DIR__.'/tmp'
	    ]);
	}


	function select($page){
		switch($page) {
		    case 'index':
		    	$this->index = new Index($page, $this);
		        break;
		    case 'gestion':
		        $this->twig = new Gestion($page, $this);
		        break;
		    case 'wishlist':
		        $this->twig = new Wishlist($page, $this);
		        break;
		    case 'candidature':
		        $this->twig = new Candidature($page, $this);
		        break;
		    case 'compte':
		        $this->twig = new Compte($page, $this);
		        break;
		    case 'deconnexion':
		        $this->twig = new Deconnexion($page, $this);
		        break;
		    case 'add':
		        $this->user = new Adduser($page, $this);
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

