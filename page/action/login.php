<?php
	//Définition des paramètre de connexion à la base de données
	include ("../../auth/authDB.php");
	include ("../auth/authDB.php");
	include ("./auth/authDB.php");

    //Connexion à la base de données
	$pdo = new PDO("mysql:host=".SERVER.";dbname=".NAME, USER, PASSWORD);

	//Définition de l'encodage dans la BDD
	$pdo->exec("SET NAMES 'utf8'");
	
	
//!\ Checkage du mdp a faire le hasher 3X avec sha1 sha2 et hash et concatener un generic /!\

if(empty($_SESSION['username']))
	{
		$pseudoCookie = (isset($_COOKIE['username'])) ? $_COOKIE['username'] : 'visiteur';
		//$mdp = (isset($_COOKIE['mdp'])) ? $_COOKIE['mdp'] : '';

		if ($pseudoCookie !="visiteur" && $pseudoCookie !="")
		{
		    //=== il est dejas logue sans session on lui crée
		    // mais avant on controle dans Mysql si mdp==OK
		    $pseudo = $pseudoCookie;
		    $_SESSION['username']=$pseudoCookie;
			
			$req = $pdo->query('SELECT * FROM `alf_users` WHERE name="'.$pseudoCookie.'"');

			while ($data = $req->fetch()) {
				$_SESSION['ad']=$data['access_dash'];
				$_SESSION['ac']=$data['access_cc'];
				$_SESSION['ap']=$data['access_port'];
				$_SESSION['as']=$data['access_set'];
			}

		} else if ($pseudoCookie == "visiteur") {
			header('location:../../logout.php');
		}
	}
?>