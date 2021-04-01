<?php
namespace core;
require_once(__DIR__.'\core\Controller.php');


class Index extends Controller{
    protected $head;
    private Controller $parent;
    private Wishlist $wish;
    private Utilisateurs $user;
    private Roles $role;
    private Candidatures $candidature;


    function __construct(Controller $parent){
        $this->parent = $parent;
        $this->parent->head->generateHeader();
        $this->wish = new Wishlist($this->parent);
        $this->user = new Utilisateurs($this->parent->db);
        $this->role = new Roles($this->parent->db);
        $this->candidature = new Candidatures($this->parent->db);

    }

    public function generateIndex(){

		if(isset($_POST['id_wish'])){
			$id_user = $_SESSION['id'];
			$id['id_wlist']= $this->wish->wish->getIDbyUser($id_user)['id'];
			$id['id']=$_POST['id_wish'];
			$this->wcreation($id);
		}
		else if(isset($_POST['id_del'])){
			$id=$_POST['id_del'];
			$this->wsupprimer($id);
		}

		if(isset($_POST['id_modif']) && !empty($_POST['id_modif'])){
			$the_id = $_POST['id_modif'];
			$data = $this->user->getbyID($the_id);
			
			$data['id_Roles']= $this->role->getbyID($data['id_Roles'])['Type'];

			echo json_encode($data);
		}

		if(isset($_POST['id_cand_add'])){
			$id['id_user'] = $_SESSION['id'];
			$id['id_offre']=$_POST['id_cand_add'];
			$this->cand_creation($id);
		}
		else if(isset($_POST['id_cand_del'])){
			$id=$_POST['id_cand_del'];
			$this->cand_supprimer($id);
		}


    } 

    private function wcreation($id){
    	$verif = $this->wish->contenir->ajout($id);
		if($verif){
			echo "L'offre (id : ".$id['id'].") a été ajoutée à la wish-list";
		}
		else {
			echo "L'offre (id : ".$id['id'].") appartient déjà à la wish-list";
		}
    }

    private function wsupprimer($id){

        //Suppression d'un article dans la wlist
        $verif = $this->wish->contenir->suppression($id);
		if($verif){
			echo "L'offre (id : ".$id.") a été supprimée de la wish-list";
		}
		else {
			echo "L'offre (id : ".$id.") n'a pas pu être suprimée de la wish-list";
		}
    }

    private function cand_creation($id){
    	$verif = $this->candidature->ajout($id);
		if($verif){
			echo "L'offre (id : ".$id['id_offre'].") a été ajouté aux candidatures";
		}
		else {
			echo "L'offre (id : ".$id['id_offre'].") appartient déjà aux candidatures";
		}
    }

    private function cand_supprimer($id_offre){

        //Suppression d'un article dans la wlist
        $verif = $this->candidature->suppression($id_offre);
		if($verif){
			echo "L'offre (id : ".$id_offre.") a été supprimé des candidatures";
		}
		else {
			echo "L'offre (id : ".$id_offre.") n'a pas pu être suprimé des candidatures";
		}
    }

    
}

$controller = new Controller();

$page='index';

$controller->select($page);

?>