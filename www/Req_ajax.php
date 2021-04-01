<?php
namespace core;
require_once(__DIR__.'\core\Controller.php');


class Index extends Controller{
    protected $head;
    private Controller $parent;
    private Wishlist $wish;
    private Utilisateurs $user;
    private Roles $role;


    function __construct(Controller $parent){
        $this->parent = $parent;
        $this->parent->head->generateHeader();
        $this->wish = new Wishlist($this->parent);
        $this->user = new Utilisateurs($this->parent->db);
        $this->role = new Roles($this->parent->db);

    }

    public function generateIndex(){

		if(isset($_POST['id_wish'])){
			$id_user = $_SESSION['id'];

			$id['id_wlist']= $this->wish->wish->getIDbyUser($id_user)['id'];
			$id['id']=$_POST['id_wish'];
			$this->creation($id);
		}
		else if(isset($_POST['id_del'])){
			$id=$_POST['id_del'];
			$this->supprimer($id);
		}

		if(isset($_POST['id_modif']) && !empty($_POST['id_modif'])){
			$the_id = $_POST['id_modif'];
			$data = $this->user->getbyID($the_id);
			
			$data['id_Roles']= $this->role->getbyID($data['id_Roles'])['Type'];

			echo json_encode($data);

		}


    } 

    private function creation($id){
    	$verif = $this->wish->contenir->ajout($id);
		if($verif){
			echo "L'offre (id : ".$id['id'].") a été ajoutée à la wish-list";
		}
		else {
			echo "L'offre (id : ".$id['id'].") appartient déjà à la wish-list";
		}
    }

    private function supprimer($id){

        //Suppression d'un article dans la wlist
        $verif = $this->wish->contenir->suppression($id);
		if($verif){
			echo "L'offre (id : ".$id.") a été supprimée de la wish-list";
		}
		else {
			echo "L'offre (id : ".$id.") n'a pas pu être suprimée de la wish-list";
		}
    }


}

$controller = new Controller();

$page='index';

$controller->select($page);

?>