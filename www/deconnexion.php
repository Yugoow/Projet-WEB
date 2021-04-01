<?php
session_start();

$_SESSION = array();

session_destroy();


$inwish= 0;

?>

<!DOCTYPE html>
<html>
<head>
	<title>Déconnexion</title>
</head>
<body>
	<p style="text-align: center;"><strong>Vous avez été déconnecté de votre session.</strong></p>
</body>
</html>