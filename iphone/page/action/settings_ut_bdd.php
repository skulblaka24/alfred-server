<?php 
	//Démarrage de la session
	session_start();

	//Encodage de la page
	date_default_timezone_set("Europe/Paris");
	header('Content-type: text/html; charset=UTF-8');

	// Redirection vers la page settings.php
	header("location:../settings/settings_ut.php");

    //Définition des paramètres de connexions à la base de données
	include ("../../../auth/authDB.php");

    //Connexion à la base de données
	$pdo = new PDO("mysql:host=".SERVER.";dbname=".NAME, USER, PASSWORD);

	//Définition de l'encodage dans la BDD
	$pdo->exec("SET NAMES 'utf8'");

	$date = date('Y-m-d');
	$date_tmp = explode('-', $date);
	$_SESSION['URL'] = $_SERVER['HTTP_REFERER'];

	
	if(!empty($_POST['mdp']))
	{
		$upPass = $_POST['mdp'];
		$downPass = $_POST['mdpr'];
		$user = $_SESSION['username'];
		$pass=sha1($_POST['mdp']);

		if($upPass == $downPass)
		{

		    $sql = 'UPDATE alf_users SET password = ("'.$pass.'") WHERE name = ("'.$user.'")';
		    $pdo->exec($sql);
			//$pdo->closeCursor();
			// Déconnexion de la BDD
			//unset( $pdo );
		}
		else
		{
			echo'Vous n\'avez pas tapé deux fois le même mot de passe';
		}
	}
 ?>
<link rel="shortcut icon" href="images/favicon.ico">
<title>Alfred Server</title>












