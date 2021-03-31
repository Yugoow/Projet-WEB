<?php

namespace core;
class Entreprise extends Controller{
    protected $head;
    private Controller $parent;

    function __construct(Controller $parent){
    	$this->parent = $parent;
        $this->parent->head->generateHeader();

    }

    public function generateEntreprise(){
        echo $this->parent->twig->render('entreprise.twig', ['seq'=>$this->parent->head->menu]);
    	
    }

}


?>