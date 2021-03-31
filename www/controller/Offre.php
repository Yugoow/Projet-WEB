<?php

namespace core;
class Offre extends Controller{
    protected $head;
    private Controller $parent;
    private Offres $offre;
    private Entreprises $entreprise;

    function __construct(Controller $parent){
        $this->parent = $parent;
        $this->parent->head->generateHeader();
        $this->offre = new Offres($this->parent->db);
        $this->entreprise = new Entreprises($this->parent->db);
    }

    protected function generateOffre(){
        $id = $this->getID_offre();
        $donnee = $this->offre->getbyID($id);
        echo $this->parent->twig->render('offre.twig', ['seq'=>$this->parent->head->menu, 'offre'=>$donnee]);


    }

    private function getID_offre(){
        if(isset($_POST['Search_id'])){
            $id = $_POST['Search_id'];
            return $id;
        }
    }


    public function getlastOffre(){
        $offres_list = $this->offre->getlastOffres();

        $list_offre=array();
        foreach ($offres_list as $item_offre) {
            $test = $this->entreprise->getbyID(array_pop($item_offre));
            $item_offre['Entreprise']=  $test['Nom'];
            array_push($list_offre, $item_offre);
        } 
        
        if(empty($list_offre)){
            $msg=['warning', "Oops, il semblerait qu'il n'y ait aucune récentes offres..."];
        }
        else{
            $msg=['success', 'Les dernières offres ont étés chargées'];
        }

        return [$msg, $list_offre];
    }

}


?>