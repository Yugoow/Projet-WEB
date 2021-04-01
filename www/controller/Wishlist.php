<?php
namespace core;
class Wishlist extends Controller{
    protected $head;
    private Controller $parent;
    public Wish_list $wish;
    public Contenir $contenir;
    private Utilisateurs $user;
    private Entreprises $entreprise;

    function __construct(Controller $parent){
    	$this->parent = $parent;
        $this->parent->head->generateHeader();
        $this->wish = new Wish_list($this->parent->db);
        $this->contenir = new Contenir($this->parent->db);
        $this->user = new Utilisateurs($this->parent->db);
        $this->entreprise = new Entreprises($this->parent->db);
 
    }


    public function generateWishlist(){

        $list = $this->genList();
        $msg = $list[0];
        $wlist_offre = $list[1]; 


		echo $this->parent->twig->render('wishlist.twig', ['seq'=>$this->parent->head->menu, 'alert_data'=>$msg, 'contenu'=>$wlist_offre]);
    }

    public function genList(){
        if(!isset($_COOKIE['id_user'])){
            $msg=['warning', "Oops, une erreur est survenue, si la page ne recharge pas veuillez la rafraichir"];
            $wlist_offre='';
            session_destroy();
            header('Refresh:0');
        }
        else {
    
            $id=$_COOKIE['id_user'];
            $offres_wlist = $this->wish->getbyID($id);
            $wlist_offre=array();
            foreach ($offres_wlist as $item_offre) {
                $test = $this->entreprise->getbyID(array_pop($item_offre));
                $item_offre['Entreprise']=  $test['Nom'];
                array_push($wlist_offre, $item_offre);
            } 
            
            if(empty($wlist_offre)){
                $msg=['warning', "Oops, il semblerait que vous ne possédiez pas d'articles dans votre Wishlist ..."];
            }
            else{
                $msg=['success', 'Toutes les données ont été chargées'];
            }
        }
        return [$msg, $wlist_offre];
    }


}




?>