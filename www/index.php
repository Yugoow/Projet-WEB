<?php
require_once(__DIR__.'\core\Controller.php');

class Index extends Controller{
    protected $head;
    private Controller $parent;

    function __construct($page, Controller $parent){
        $this->parent = $parent;
        $this->head = new Header($parent);
        $this->head->tryheader($page);
    }

}



$controller = new Controller();

$page='index';


if(isset($_GET['p'])){
    $page=$_GET['p'];
}


$controller->select($page);




?>