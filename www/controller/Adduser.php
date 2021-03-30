<?php
class Adduser extends Controller {
	private Controller $parent;


	function __construct($page, Controller $parent){
		$this->parent = $parent;
		$this->rend();
	}


	function rend(){
		echo $this->parent->twig->render('home.twig');
	}
}


function adduser($pass, $user){	
	$htpasswd ='./.htpasswd';
	$hash = password_hash($pass, PASSWORD_BCRYPT);

	$contents =  $user . ':' . $hash;
	$lines = explode(PHP_EOL, file_get_contents($htpasswd)); // get .htpasswd
	echo '<h4>input:</h4><pre>'.print_r(implode(PHP_EOL, $lines),true).'</pre>';
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
	print('<h4>output:</h4><pre>'.print_r($contents,true).'</pre>');
}



if (isset($_POST["user"]) and isset($_POST["pswd"])){
	$pass=$_POST['pswd'];
	$user = $_POST["user"];
	adduser($pass, $user);
}





?>

