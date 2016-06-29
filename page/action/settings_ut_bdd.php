<?php 
	// Démarrage de la session
	session_start();
	include ("./action/login.php");

	// Encodage de la page
	date_default_timezone_set("Europe/Paris");
	header('Content-type: text/html; charset=UTF-8');

	// Redirection vers la page settings.php
	header("location:../settings/settings_ut.php");

    // Définition des paramètres de connexions à la base de données
	include ("../../auth/authDB.php");

    // Connexion à la base de données
	$pdo = new PDO("mysql:host=".SERVER.";dbname=".NAME, USER, PASSWORD);

	// Définition de l'encodage dans la BDD
	$pdo->exec("SET NAMES 'utf8'");

	$date = date('Y-m-d');
	$date_tmp = explode('-', $date);
	$_SESSION['URL'] = $_SERVER['HTTP_REFERER'];

	// Comptage de la base
	$reqc = $pdo->query('SELECT * FROM `alf_users`');
	$count = $reqc->rowCount();
	
	if((!empty($_POST['user'])) && ($_POST['button']) == 'Ajouter')
	{
		$addName = $_POST['user'];
		$addPass = sha1($_POST['pass']);
		$addStat = $_POST['status'];
		$addADash = $_POST['dash'];
		$addACC = $_POST['cc'];
		$addAPort = $_POST['port'];
		$addASet = $_POST['settings'];
		
		$count +=1;

	    $sql = 'INSERT INTO alf_users VALUES ("'.$count.'", "'.$addName.'", "'.$addPass.'", "'.$addStat.'", "'.$addADash.'", "'.$addACC.'", "'.$addAPort.'", "'.$addASet.'")';
	    $pdo->exec($sql);
		
		
	} else if(($_POST['button']) == 'Modifier')
	{
		$separate = explode("-", $_POST['user']);
		
		$upId = $separate[1];
		$upName = $separate[0];
		
		$upPass = sha1($_POST['password']);
		$upRN = $_POST['status'];
		
		$upAD = $_POST['dash'];
		$upAC = $_POST['cc'];
		$upAP = $_POST['port'];
		$upAS = $_POST['settings'];

	    $sql = 'UPDATE `alf_users` SET `id`= ("'.$upId.'"),`name`= ("'.$upName.'"),`password`= ("'.$upPass.'"),`registration_number`= ("'.$upRN.'"),`access_dash`= ("'.$upAD.'"),`access_cc`= ("'.$upAC.'"),`access_port`= ("'.$upAP.'"),`access_set`= ("'.$upAS.'") WHERE `id`= ("'.$upId.'")';
		$pdo->exec($sql);
		
		
	}
	if($_GET['action'] == "delete")
	{

		$sql = 'DELETE FROM alf_users WHERE id = ("'.$_GET['id'].'")';
	    $pdo->exec($sql);

	    //code de réorganisation de la base de données pour éviter les doublons d'id
	    $count +=1;

	    for ($i=$_GET['id']+1; $i < $count; $i++) { 
	    	
	    	$reqs = $pdo->query('SELECT * FROM alf_users');
	    	
	    	while ($data = $reqs->fetch()) {
				
	    		if ($data["id"] == $i) {

	    			$id = $data['id']-1;
	    			$name = $data['name'];
	    			$pass = $data['password'];
	    			$rn = $data['registration_number'];
	    			$adash = $data['access_dash'];
	    			$acc = $data['access_cc'];
					$aport = $data['access_port'];
	    			$aset = $data['access_set'];

	    			$sql = 'UPDATE `alf_dash` SET `id`= ("'.$id.'"),`name`= ("'.$name.'"),`password`= ("'.$pass.'"),`registration_number`=("'.$rn.'"),`access_dash`= ("'.$adash.'"),`access_cc`= ("'.$acc.'"),`access_port`= ("'.$aport.'"),`access_set`= ("'.$aset.'") WHERE `id`= ("'.$i.'")';
	    			$pdo->exec($sql);
	    		}
			}
	    }
	}
 ?>
<link rel="shortcut icon" href="images/favicon.ico">
<title>Alfred Server</title>












