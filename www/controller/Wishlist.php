<?php
namespace core;
class Wishlist extends Controller{
    protected $head;
    private Controller $parent;

    function __construct(Controller $parent){
    	$this->parent = $parent;
        $this->parent->head->generateHeader();
        echo $this->parent->twig->render('wishlist.twig', ['seq'=>$this->parent->head->menu]);

    }


}




?>