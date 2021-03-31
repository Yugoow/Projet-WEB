<?php
namespace core;
class Compte extends Controller{
    protected $head;
    private $username;
    private Controller $parent;

    function __construct(Controller $parent){
    	$this->parent = $parent;
        $this->parent->head->generateHeader();
    }

    public function generateCompte(){
    	if(isset($_SESSION['Identifiant'])){

        	echo $this->parent->twig->render('compte.twig', ['seq'=>$this->parent->head->menu, 'param'=>$_SESSION]);
    	}
    	else{
    		echo $this->parent->twig->render('compte.twig', ['seq'=>$this->parent->head->menu]);
    	}

    }

}
?>