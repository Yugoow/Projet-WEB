<?php

class Wishlist extends Controller{
    protected $head;
    private Controller $parent;

    function __construct($page, Controller $parent){
    	$this->parent = $parent;
        $this->head = new Header($parent);
        $this->head->tryheader($page);
    }

}
?>