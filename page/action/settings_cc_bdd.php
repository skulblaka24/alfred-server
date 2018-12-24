<?php 
	//Démarrage de la session
	session_start();
	include ("./login.php");
	
	//Encodage de la page
	date_default_timezone_set("Europe/Paris");
	header('Content-type: text/html; charset=UTF-8');

	// Redirection vers la page settings.php
	header("location:../settings/settings_cc.php");

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
	$reqc = $pdo->query('SELECT * FROM `alf_rel`');
	$count = $reqc->rowCount();
	
	if((!empty($_POST['name'])) && ($_POST['button']) == 'Ajouter')
	{
        $count +=1;
		$addName = $_POST['name'];
		$addDescription = $_POST['description'];
		$addRelai = $_POST['relai'];
		$addTime = $_POST['time'];
		$addFreq = $_POST['freq'];
        $addPin = $_POST['pin'];
		$addTel = $_POST['tel'];
		$addRec = $_POST['rec'];
		$addRoom = $_POST['room'];
		$addType = $_POST['type'];
        $addState = 0;
		$addCmd = $_POST['cmd'];
		$addIp = $_POST['ip'];
		$addPort = $_POST['port'];
		$addLogin = $_POST['login'];
		$addPassword = $_POST['password'];


		
		//(dash_id, dash_name, dash_description, dash_machine, dash_site, dash_site)
	    $sql = 'INSERT INTO alf_rel VALUES ("'.$count.'", "'.$addName.'", "'.$addDescription.'", "'.$addRelai.'", "'.$addTime.'", "'.$addFreq.'", "'.$addPin.'", "'.$addTel.'", "'.$addRec.'", "'.$addRoom.'", "'.$addType.'", "'.$addState.'", "'.$addCmd.'", "'.$addIp.'", "'.$addPort.'", "'.$addLogin.'", "'.$addPassword.'")';
	    $pdo->exec($sql);
		//$pdo->closeCursor();
 
		// Déconnexion de la BDD
		//unset( $pdo );
	
	}
	else if(($_POST['button']) == 'Modifier')
	{
		$separate = explode("-", $_POST['name']);
		
		$upId = $separate[1];
		$upName = $separate[0];
		
		$upDescription = $_POST['description'];
		$upRelai = $_POST['relai'];
		$upTime = $_POST['time'];
		$upFreq = $_POST['freq'];
        $upPin = $_POST['pin'];
		$upTel = $_POST['tel'];
		$upRec = $_POST['rec'];
		$upRoom = $_POST['room'];
		$upType = $_POST['type'];
        $upState = 0;
		$upCmd = $_POST['cmd'];
		$upIp = $_POST['ip'];
		$upPort = $_POST['port'];
		$upLogin = $_POST['login'];
		$upPassword = $_POST['password'];

	    $sql = 'UPDATE `alf_rel` SET `rel_id`= ("'.$upId.'"),`rel_name`= ("'.$upName.'"),`rel_desc`= ("'.$upDescription.'"),`rel_relai`=("'.$upRelai.'"),`rel_time`= ("'.$upTime.'"),`rel_freq`= ("'.$upFreq.'"),`rel_pin`= ("'.$upPin.'"),`rel_tel`= ("'.$upTel.'"),`rel_rec`= ("'.$upRec.'"),`rel_room`= ("'.$upRoom.'"),`rel_type`= ("'.$upType.'"),`rel_state`= ("'.$upState.'"),`rel_cmd`= ("'.$upCmd.'"),`rel_ip`= ("'.$upIp.'"),`rel_port`= ("'.$upPort.'"),`rel_login`= ("'.$upLogin.'"),`rel_password`= ("'.$upPassword.'") WHERE `rel_id`= ("'.$upId.'")';
	    $pdo->exec($sql);
		//$pdo->closeCursor();
 
		// Déconnexion de la BDD
		//unset( $pdo );
		
	}
	else if($_GET['action'] == "delete")
	{

		$sql = 'DELETE FROM alf_rel WHERE rel_id = ("'.$_GET['id'].'")';
	    $pdo->exec($sql);

	    //code de réorganisation de la base de données pour éviter les doublons d'id
	    $count +=1;

	    for ($i=$_GET['id']+1; $i < $count; $i++) { 
	    	
	    	$reqs = $pdo->query('SELECT * FROM alf_rel');
	    	
	    	while ($data = $reqs->fetch()) {
				
	    		if ($data["rel_id"] == $i) {

	    			$id = $data['rel_id']-1;
	    			$name = $data['rel_name'];
	    			$desc = $data['rel_desc'];
	    			$relai = $data['rel_relai'];
	    			$time = $data['rel_time'];
	    			$freq = $data['rel_freq'];
                    $pin = $data['rel_pin'];
	    			$tel = $data['rel_tel'];
	    			$rec = $data['rel_rec'];
                    $room = $data['rel_room'];
	    			$type = $data['rel_type'];
	    			$state = $data['rel_state'];
                    $cmd = $data['rel_cmd'];
	    			$ip = $data['rel_ip'];
                    $port = $data['rel_port'];
	    			$login = $data['rel_login'];
                    $password = $data['rel_password'];

	    			$sql = 'UPDATE `alf_rel` SET `rel_id`= ("'.$id.'"),`rel_name`= ("'.$name.'"),`rel_desc`= ("'.$desc.'"),`rel_relai`=("'.$relai.'"),`rel_time`= ("'.$time.'"),`rel_freq`= ("'.$freq.'"),`rel_pin`= ("'.$pin.'"),`rel_tel`= ("'.$tel.'"),`rel_rec`= ("'.$rec.'"),`rel_room`= ("'.$room.'"),`rel_type`= ("'.$type.'"),`rel_cmd`= ("'.$cmd.'"),`rel_ip`= ("'.$ip.'"),`rel_port`= ("'.$port.'"),`rel_login`= ("'.$login.'"),`rel_password`= ("'.$password.'") WHERE `rel_id`= ("'.$i.'")';
	    			$pdo->exec($sql);
	    		}
			}
	    }
	}
 ?>
<link rel="shortcut icon" href="images/favicon.ico">
<title>Alfred Server</title>












