<?php
namespace core;
class Candidature extends Controller{
    protected $head;
    private Controller $parent;

    function __construct(Controller $parent){
    	$this->parent = $parent;
        $this->parent->head->generateHeader();
        echo $this->parent->twig->render('candidature.twig', ['seq'=>$this->parent->head->menu]);
    }

    public function generateCandidature(){

    }
}
?>