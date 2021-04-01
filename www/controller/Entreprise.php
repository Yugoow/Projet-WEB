<?php

namespace core;
class Entreprise extends Controller{
    protected $head;
    private Controller $parent;
	private Entreprises $entreprise;

    function __construct(Controller $parent){
    	$this->parent = $parent;
        $this->parent->head->generateHeader();
		$this->entreprise = new Entreprises($this->parent->db);
    }
	
	protected function generateEntreprise(){
		$donnee="";
		
		if(!empty($_POST['in_search'])){
			$id = $_POST['in_search'];
			$donnee = $this->entreprise->getID($id);
		}else if(!empty($_POST['search2'])){
			$id = $_POST['search2'];
			$donnee = $this->entreprise->getName($id);
		}else if(!empty($_POST['sect_act'])){
			$id = $_POST['sect_act'];
			$donnee = $this->entreprise->getSect($id);
		}
			
		echo $this->parent->twig->render('entreprise.twig', ['seq'=>$this->parent->head->menu, 'entreprises'=>$donnee]);
    }
	

}


?>