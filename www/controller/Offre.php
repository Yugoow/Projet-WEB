<?php

namespace core;
class Offre extends Controller{
    protected $head;
    private Controller $parent;

    function __construct(Controller $parent){
    	$this->parent = $parent;
        $this->parent->head->generateHeader();
    }

    protected function generateOffre(){


    	
    	echo $this->parent->twig->render('offre.twig', ['seq'=>$this->parent->head->menu]);
    }


}


?>