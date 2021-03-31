<?php
namespace core;
require_once(__DIR__.'\core\Controller.php');

session_start();


class Index extends Controller{
    protected $head;
    private Controller $parent;
    private Wishlist $wish;
    private Offre $offre;

    function __construct(Controller $parent){
        $this->parent = $parent;
        $this->parent->head->generateHeader();
        $this->wish = new Wishlist($this->parent);
        $this->offre = new Offre($this->parent);

    }

    public function generateIndex(){


        $wlist =$this->wish->genList();
        $wlist = $wlist[1];

        $olist = $this->offre->getlastOffre();
        $olist = $olist[1];

        echo $this->parent->twig->render('index.twig', ['seq'=>$this->parent->head->menu, 'contenuoffres'=>$olist, 'contenuwish'=>$wlist]);
    } 

    function getNvlOffre(){
        //call du model de index ?
        //Lien entre Model et model de l'index ?
    }


    function getWlist(){
        //call du model de index ?
    }
}

$controller = new Controller();

$page='index';


if(isset($_GET['p'])){
    $page=$_GET['p'];
}

$controller->select($page);



?>