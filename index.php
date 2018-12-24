<?php
	/* #####################################################################
   #
   #   Project       : Alfred
   #   Author        : Gauthier Donikian
   #   Version       : 2.0
   #
   ##################################################################### */
	
	//Démarrage d'une session
	session_start();

    //Définition des paramètre de connexion à la base de données
	include ("./auth/authDB.php");

    //Connexion à la base de données
	$pdo = new PDO("mysql:host=".SERVER.";dbname=".NAME, USER, PASSWORD);

	//Déclaration des variables
	$connexion = false;
	$login = false;
	$mdp = false;

	//Récupération des valeurs du formulaires et comparaison avec la base de données
	if(isset($_POST['username']) && isset($_POST['password']))
	{
		$username = $_POST['username'];
		$password = $_POST['password'];
		$req = $pdo->query('SELECT * FROM alf_users');
		

		while ($donnees = $req->fetch()) {
			if($donnees['name'] == $username && $donnees['password'] == sha1($password) && ($donnees['registration_number'] == "Admin" || $donnees['registration_number'] == "User"))
				$connexion = true;
			elseif($donnees['name'] != $username && $donnees['password'] == sha1($password) && ($donnees['registration_number'] == "Admin" || $donnees['registration_number'] == "User"))				
				$login = true;
			elseif ($donnees['name'] == $username && $donnees['password'] != sha1($password) && ($donnees['registration_number'] == "Admin" || $donnees['registration_number'] == "User"))
				$mdp = true;
				continue;
		}
		if($connexion == true){
			$_SESSION['username'] = $username;
			// Attention pas d'espace avant <?php sinon le header ne fonctionne pas /!\
			setCookie('username',$username,(time()+60*60*24*365)); // 1 an
 			setCookie('motdepassecrypte',hash(sha1, $password),(time()+60*60*24*365));
			 
			$req = $pdo->query('SELECT * FROM `alf_users` WHERE name="'.$username.'"');

			while ($data = $req->fetch()) {
				$_SESSION['ad']=$data['access_dash'];
				$_SESSION['ac']=$data['access_cc'];
				$_SESSION['ap']=$data['access_port'];
				$_SESSION['as']=$data['access_set'];
				
				if ($_SESSION['ad'] == 1) {
					header("Location: ./page/dashboard.php");
				}
				else {
					header("Location: ./page/portail.php");
				} 
			}
			
			
		}
		elseif($login == true){
			echo "<div class='alert alert-danger' role='alert'><strong>Warning!</strong> Le login n'est pas correct !</div>";
		}
		elseif($mdp == true){
			echo "<div class='alert alert-danger' role='alert'><strong>Warning!</strong> Le mot de passe n'est pas correct !</div>";
		}
		else {
			echo "<div class='alert alert-danger' role='alert'><strong>Warning!</strong> Le login et le mot de passe ne sont pas corrects !</div>";
		}
	}
	
?>
<!DOCTYPE html>
<html>
<head>



    <meta charset="utf-8">
    <meta name="robots" content="noindex">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=0">

    <link rel="shortcut icon" type="image/png" href="./img/favicon.ico" />

   

    <link href="./css/annexe/bootstrap/3.3.0/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<link href="./css/main/login.css" rel="stylesheet" id="css ppstyle">
    <link rel='stylesheet' href='./css/annexe/animate.css' />
    
    <script src="./js/annexe/jquery-1.10.2.js"></script>
	<script src="./js/annexe/jquery-1.10.2.min.js"></script>
	<script src="./js/annexe/bootstrap/3.3.0/bootstrap.min.js"></script>
	<script src="./js/annexe/jquery-2.1.0.min.js"></script>
    <script src="./js/main/login.js"></script>

    <!--Script de détection et de redirection pour les appareils apple et android. -->
	<script type="text/javascript">
		if((navigator.userAgent.match(/iPhone/i)) || 
 		(navigator.userAgent.match(/iPod/i)) || (navigator.userAgent.match(/Android/i))) {
   			window.location = "./iphone/index.php";
		}
	</script>
    
    
    
    <title>Alfred Server</title>
</head>
<body>
<!-- Main container -->
<div class="page-container">
    
<!-- Hero Bloc -->
<div id="hero-bloc" class="bloc hero bgc-white bg-fond d-bloc">
	<div class="container bloc-sm hero-nav">
		<nav class="navbar row">
			<div class="navbar-header">
				<a class="navbar-brand" href="./page/dashboard.php"><img class="img_logo_nav" src="img/house.png" alt="logo" width="32" height="26" />Alfred Server</a>
			</div>
		</nav>
	</div>
	<div class="v-center">
		<div class="vc-content row">
			<div class="col-sm-12">
				<h1 class=" text-center">
					Welcome to Alfred&rsquo;s Server
				</h1>
				<h3 class=" text-center mg-lg">
				</h3>
				<div class="text-center">
					<a href="#" id="modal_button" class="btn-wire btn btn-xl wire-btn-red-pigment animated fadeIn animDelay04" role="button" data-toggle="modal" data-target="#login-modal">Connectez-vous</a>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Hero Bloc END -->

<!-- BEGIN # MODAL LOGIN -->
<div class="modal fade" id="login-modal" align="center" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    	<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header" align="center">
					<img class="img-circle" id="img_logo" src="./img/house.png">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
					</button>
				</div>
                
                <!-- Begin # DIV Form -->
                <div id="div-forms">
                
                    <!-- Begin # Login Form -->
                    <form id="login-form" action="index.php" method="POST" name="connect_e">
		                <div class="modal-body">
				    		<div id="div-login-msg">
                                <div id="icon-login-msg" class="glyphicon glyphicon-chevron-right"></div>
                                <span id="text-login-msg">Type your username and password.</span>
                            </div>
				    		<input id="username" name="username" class="form-control" type="text" placeholder="Votre identifiant ici" value="skulblaka24" required>
				    		<input id="password" name="password" class="form-control" type="password" placeholder="Password" required>
        		    	</div>
				        <div class="modal-footer">
                            <div>
                                <button type="submit" id="login_button" class="btn btn-danger btn-lg btn-block">Login</button>
                            </div>
				        </div>
                    </form>
                    <!-- End # Login Form -->
                </div>
                <!-- End # DIV Form -->
			</div>
		</div>
	</div>
    <!-- END # MODAL LOGIN -->
<!-- ####################################################################### -->
</div>
<!-- Main container END -->

</body>

</html>

<script type="text/javascript">
	$(document).ready(function(){
		
		$('#modal_button').click(function() {
  			
  			//setTimeout("$('#username').focus()", 500); // 1000 pour 1 sec
  			setTimeout("$('#password').focus()", 600); 
		});
        
	})
</script>
