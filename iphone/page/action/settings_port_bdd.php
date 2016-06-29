<?php 
	//Démarrage de la session
	session_start();

	//Encodage de la page
	date_default_timezone_set("Europe/Paris");
	header('Content-type: text/html; charset=UTF-8');

	// Redirection vers la page settings.php
	header("location:../settings/settings_port.php");

    //Définition des paramètres de connexions à la base de données
	include ("../../../auth/authDB.php");

    //Connexion à la base de données
	$pdo = new PDO("mysql:host=".SERVER.";dbname=".NAME, USER, PASSWORD);

	//Définition de l'encodage dans la BDD
	$pdo->exec("SET NAMES 'utf8'");

	$date = date('Y-m-d');
	$date_tmp = explode('-', $date);
	$_SESSION['URL'] = $_SERVER['HTTP_REFERER'];

	$id = 1;
	$ip = $_POST['ip'];
	$port = $_POST['port'];
	$login = $_POST['id_login'];
	$password=$_POST['id_password'];
	
	if(!empty($_POST['ip']))
	{
		$sql = 'UPDATE alf_port SET ip = ("'.$ip.'") WHERE id = ("'.$id.'")';
		    $pdo->exec($sql);
	}
	if (!empty($_POST['port']))
	{
		$sql1 = 'UPDATE alf_port SET port = ("'.$port.'") WHERE id = ("'.$id.'")';
		    $pdo->exec($sql1);
	}
	if (!empty($_POST['id_login']))
	{
		$sql2 = 'UPDATE alf_port SET login = ("'.$login.'") WHERE id = ("'.$id.'")';
		    $pdo->exec($sql2);
	}
	if (!empty($_POST['id_password']))
	{
		$sql3 = 'UPDATE alf_port SET password = ("'.$password.'") WHERE id = ("'.$id.'")';
		    $pdo->exec($sql3);
	}

 ?>
<link rel="shortcut icon" href="images/favicon.ico">
<title>Alfred Server</title>












