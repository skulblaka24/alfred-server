<?php 
	//Démarrage de la session
	session_start();
	include ("./action/login.php");
	
	//Encodage de la page
	date_default_timezone_set("Europe/Paris");
	header('Content-type: text/html; charset=UTF-8');

	// Redirection vers la page settings.php
	header("location:../settings/settings_dash.php");

    //Définition des paramètres de connexions à la base de données
	include ("../../auth/authDB.php");

    //Connexion à la base de données
	$pdo = new PDO("mysql:host=".SERVER.";dbname=".NAME, USER, PASSWORD);

	//Définition de l'encodage dans la BDD
	$pdo->exec("SET NAMES 'utf8'");

	$date = date('Y-m-d');
	$date_tmp = explode('-', $date);
	$_SESSION['URL'] = $_SERVER['HTTP_REFERER'];

	// Comptage de la base
	$reqc = $pdo->query('SELECT * FROM `alf_dash`');
	$count = $reqc->rowCount();
	
	
	if((!empty($_POST['name'])) && ($_POST['button']) == 'Ajouter')
	{
		$addName = $_POST['name'];
		$addDescription = $_POST['description'];
		$addIp = $_POST['ip'];
		$addSite = $_POST['site'];
		$addType = $_POST['type'];
		
		$count +=1;

		//(dash_id, dash_name, dash_description, dash_machine, dash_site, dash_site)
	    $sql = 'INSERT INTO alf_dash VALUES ("'.$count.'", "'.$addName.'", "'.$addDescription.'", "'.$addIp.'", "'.$addSite.'", "'.$addType.'")';
	    $pdo->exec($sql);
		//$pdo->closeCursor();
 
		// Déconnexion de la BDD
		//unset( $pdo );
	
	} else if(($_POST['button']) == 'Modifier')
	{
		$separate = explode("-", $_POST['name']);
		
		$upId = $separate[1];
		$upName = $separate[0];
		
		$upDescription = $_POST['description'];
		$upMach = $_POST['ip'];
		$upSite = $_POST['site'];
		$upType = $_POST['type'];

	    $sql = 'UPDATE `alf_dash` SET `dash_id`= ("'.$upId.'"),`dash_name`= ("'.$upName.'"),`dash_description`= ("'.$upDescription.'"),`dash_machine`= ("'.$upMach.'"),`dash_site`= ("'.$upSite.'"),`dash_type`= ("'.$upType.'") WHERE `dash_id`= ("'.$upId.'")';
		$pdo->exec($sql);
		//$pdo->closeCursor();
 
		// Déconnexion de la BDD
		//unset( $pdo );
		
	}
	if($_GET['action'] == "delete")
	{

		$sql = 'DELETE FROM alf_dash WHERE dash_id = ("'.$_GET['id'].'")';
	    $pdo->exec($sql);

	    //code de réorganisation de la base de données pour éviter les doublons d'id
	    $count +=1;

	    for ($i=$_GET['id']+1; $i < $count; $i++) { 
	    	
	    	$reqs = $pdo->query('SELECT * FROM alf_dash');
	    	
	    	while ($data = $reqs->fetch()) {
				
	    		if ($data["dash_id"] == $i) {

	    			$id = $data['dash_id']-1;
	    			$name = $data['dash_name'];
	    			$desc = $data['dash_description'];
	    			$machine = $data['dash_machine'];
	    			$site = $data['dash_site'];
	    			$type = $data['dash_type'];

	    			$sql = 'UPDATE `alf_dash` SET `dash_id`= ("'.$id.'"),`dash_name`= ("'.$name.'"),`dash_description`= ("'.$desc.'"),`dash_machine`=("'.$machine.'"),`dash_site`= ("'.$site.'"),`dash_type`= ("'.$type.'") WHERE `dash_id`= ("'.$i.'")';
	    			$pdo->exec($sql);
	    		}
			}
	    }
	}

	// Ecriture du fichier input pour le ping des machines
	while ($data = $reqc->fetch()) {
		$contenu = $data['dash_machine']."\r\n";
		$h = fopen("./.input.txt", "a");
		fwrite($h, $contenu);
		fclose($h);
		
	}
	// Déplacement du fichier input dans le repertoire de ping_daemon
	$rm=shell_exec('mv ./.input.txt ./ping_daemon/.input.txt'); 



 ?>
<link rel="shortcut icon" href="images/favicon.ico">
<title>Alfred Server</title>












