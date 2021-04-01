<?php
namespace core;

class Gestion extends Controller{
    protected $head;
    private $data;
    private Utilisateurs $user;
    private Offres $offre;
    private Entreprises $entreprise;
    private Controller $parent;
    private Roles $role_cl;
    private Contenir $contenir;
    protected $inputs;

    function __construct(Controller $parent){
    	$this->parent = $parent;
        $this->parent->head->generateHeader();
        $this->inputs=array();
        $this->user = new Utilisateurs($this->parent->db);
        $this->offre = new Offres($this->parent->db);
        $this->entreprise = new Entreprises($this->parent->db);
        $this->role_cl = new Roles($this->parent->db);
        $this->wlist = new Wish_list($this->parent->db);
        $this->contenir = new Contenir($this->parent->db);
    }

    protected function generateGestion(){
        if($_SESSION['id_Roles']==3 || $_SESSION['id_Roles']==4){
            header('HTTP/1.0 403 Forbidden');
            return false;

        }


    	$listCat = array('user','offre','entreprise');

    	foreach($listCat as $cat){
    		if(isset($_POST['action_'.$cat])){
    			$inCat = $cat;
    			break;
    		}
    	}

    	if(isset($inCat)){

    		//Récupération des inputs en fonction de la catégorie
    		$method = 'getInput_'.$inCat;

    		$action = htmlspecialchars($_POST['action_'.$inCat]);

            try {
                $this->$method($action, $inCat);
                $this->data = $this->$inCat->$action($this->inputs);
            }
            catch(Exception $e){
                echo $e;
            }
        }
        echo $this->parent->twig->render('gestion.twig', ['seq'=>$this->parent->head->menu, 'alert_data'=>$this->data]);
    }
    	

    function getInput($tab){
        try{
            foreach ($tab as $key) {
                $this->inputs[$key]=htmlspecialchars($_POST[$key]);
            }
        }
        catch(Exception $e){
            $this->data=["warning", "Merci de remplir tous les champs pour réaliser la requête."];
        }
    }



    function getInput_user($action,$inCat){
        $this->inputs = array();

        if($action=="creation"){
            $tab=['ID', 'Nom', 'Prenom', 'Centre', 'Promotion', 'email', 'Role'];
            $mdp_temp = htmlspecialchars($_POST['mdp']);
            $email_temp =htmlspecialchars($_POST['email']);
            $this->getInput($tab);
            try{
                $role = array_pop($this->inputs);
                $r_id = $this->role_cl->getIDbyArg($role);
                if(isset($r_id['id'])){
                    $this->inputs["id_R"]=$r_id['id'];
                }
            }
            catch(Exeption $e){
                $this->data = ["warning", "Erreur"];
            }
        }

        else if($action=="suppression"){
            $tab=['ID', 'Nom', 'Prenom','Promotion'];
            $mdp_temp = null;
            $this->getInput($tab);

            $user_del = $this->$inCat->getbyID($this->inputs['ID']);
            $email_temp =$user_del['Identifiant'];
            $this->inputs = array_replace($this->inputs, $user_del);
            $this->wlist->$action($this->inputs['ID']);
        }
        else if($action=="modification"){
            $tab=['ID', 'Nom', 'Prenom', 'Centre', 'Promotion', 'email', 'Role'];

            $mdp_temp = htmlspecialchars($_POST['mdp']);
            $email_temp =htmlspecialchars($_POST['email']);
            $this->getInput($tab);
            try{
                $role = array_pop($this->inputs);
                $r_id = $this->role_cl->getIDbyArg($role);
                if(isset($r_id['id'])){
                    $this->inputs["id_R"]=$r_id['id'];
                }
            }
            catch(Exeption $e){
                $this->data = ["warning", "Erreur"];
            }
            //$user_del = $this->$inCat->getbyID($this->inputs['ID']);

        }


        if(isset($email_temp) && ($action!="modification" || ($action=="modification" && !empty($mdp_temp)))){
            $this->gest_user($mdp_temp, $email_temp);
        }

    }

    function getInput_offre($action, $inCat){
        $this->inputs = array();
        if($action=="creation"){
            $tab=["ID","Competences", "Promotion", "Duree", "gratif", "Date", "Places", "Titre", 'Entreprise'];
            $this->getInput($tab);

            try{
                $name = array_pop($this->inputs);
                $e_id =$this->entreprise->getIDbyarg($name);
                if(isset($e_id['id'])){
                    $this->inputs["id_E"]=$e_id['id'];
                    $this->inputs['name']=$name;
                }
            }
            catch(Exeption $e){
                $this->data = ["warning", "Il semblerait que cette entreprise n'existe pas, pensez à la créer"];
            }
        }
        else if($action=="suppression"){
            $tab=["ID", "Promotion"];
            $this->getInput($tab);
            $this->contenir->suppression($this->inputs['ID']);

        }

    }

    function getInput_entreprise($action, $inCat){
        $this->inputs = array();
        if($action=="creation"){
            $tab=["ID","Nom","Secteur", "Localisation", "email","E_Acceptes", "Confiance"];
            $this->getInput($tab);
        }
        else if($action=="suppression"){
            $tab=["ID","Nom"];
            $this->getInput($tab);
            $entreprise_del= $this->$inCat->getbyID($this->inputs['ID']);
            $this->inputs = array_merge($this->inputs, $entreprise_del);
        }
    }



    private function gest_user($pass, $user){ 
        $htpasswd ='./.htpasswd';
        $hash = password_hash($pass, PASSWORD_BCRYPT);

        $contents =  $user . ':' . $hash;
        $lines = explode(PHP_EOL, file_get_contents($htpasswd)); // get .htpasswd
        $exists = false;

        foreach($lines as $line){
            $existing_user = explode( ':', $line );

            if ($existing_user[0] == $user) { //checks if user exists
                $contents = str_replace($line, $contents, $lines); //changes password for user
                $contents = implode(PHP_EOL, $contents);
                $exists = true;

                if ($pass == '') { // removes user if password is empty
                    $contents = str_replace($line, '', $lines); //removes user
                    $contents = array_filter($contents); // cleans empty space in array
                    $contents = implode(PHP_EOL, $contents);
                    $exists = true;
                }
            }

        }


        if ($exists == false) {

            $contents = implode(PHP_EOL, $lines) . PHP_EOL . $contents;
        }

        file_put_contents($htpasswd, $contents);
    }


}
?>