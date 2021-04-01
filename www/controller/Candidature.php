<?php
namespace core;
class Candidature extends Controller{
    protected $head;
    private Controller $parent;
    private Candidatures $candidature;
    private Entreprises $entreprise;

    function __construct(Controller $parent){
    	$this->parent = $parent;
        $this->parent->head->generateHeader();
        $this->candidature = new Candidatures($this->parent->db);
        $this->entreprise = new Entreprises($this->parent->db);

    }

    public function generateCandidature(){

    	$list = $this->genList();
        $msg = $list[0];
        $c_list_offre = $list[1]; 

 		echo $this->parent->twig->render('candidature.twig', ['seq'=>$this->parent->head->menu, 'alert_data'=>$msg, 'contenucand'=>$c_list_offre]);
    }

 public function genList(){
        if(empty($_SESSION['id'])){
            $msg=['warning', "Oops, une erreur est survenue, si la page ne recharge pas veuillez la rafraichir"];
            $c_list_offre='';
            session_destroy();
            header('Refresh:0');
        }
        else {
    
            $id=$_SESSION['id'];
            $offres_c_list = $this->candidature->getbyID($id);
            $c_list_offre=array();
            foreach ($offres_c_list as $item_offre) {
                $test = $this->entreprise->getbyID(array_pop($item_offre));
                $item_offre['Entreprise']=  $test['Nom'];
                array_push($c_list_offre, $item_offre);
            } 
            
            if(empty($c_list_offre)){
                $msg=['warning', "Oops, il semblerait que vous ne possédiez pas d'offres dans vos candidatures ..."];
            }
            else{
                $msg=['success', 'Toutes les données ont été chargéesee'];
            }
        }
        return [$msg, $c_list_offre];
    }


}
?>