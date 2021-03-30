<?php
namespace core;
class Compte extends Controller{
    protected $head;
    private Controller $parent;

    function __construct(Controller $parent){
    	$this->parent = $parent;
        $this->parent->head->generateHeader();
        echo $this->parent->twig->render('compte.twig', ['seq'=>$this->parent->head->menu]);
    }

}
?>