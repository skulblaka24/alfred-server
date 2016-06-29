<?php 
	//Démarrage de la session
	session_start();

	if(empty($_SESSION['username'])){
		header('location:../logout.php');
	}

	//Encodage de la page
	date_default_timezone_set("Europe/Paris");
	header('Content-type: text/html; charset=UTF-8');

    //Définition des paramètre de connexion à la base de données
	include ("../auth/authDB.php");

    //Connexion à la base de données
	$pdo = new PDO("mysql:host=".SERVER.";dbname=".NAME, USER, PASSWORD);

	//Définition de l'encodage dans la BDD
	$pdo->exec("SET NAMES 'utf8'");

	$date = date('Y-m-d');
	$date_tmp = explode('-', $date);
	$_SESSION['URL'] = $_SERVER['HTTP_REFERER'];

	
	
 ?>

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=0">

    
    <link rel="shortcut icon" type="image/png" href="../img/favicon.ico" />
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
    <link rel="stylesheet" id="ppstyle" type="text/css" href="../css/settings-dashboard.css" />
    <link rel='stylesheet' href='../css/animate.css' />

    
    <script src="../js/jquery-2.1.0.min.js"></script>
    <script src="../js/bootstrap.js"></script>
    <script src="../js/settings-dashboard_bloc.js"></script>
   	<script type="text/javascript" src="../js/settings-dashboard.js"></script>
    
    <title>Settings - Alfred Server</title>
</head>
<body>
<!-- Main container -->
<div class="page-container">
    
	<!-- Navigation Bloc -->
	<div class="page ">
		<div id="b-nav" class="bloc-container bgc-grey">
			<div id="bloc-nav" class="d-mode">
				<div class="bloc d-bloc" id="nav-bloc">
					<div class="container bloc-sm">
						<nav class="navbar row">
							<div class="navbar-header">
								<div class="navbar-pro">
									<img src="../img/me.jpg" class="img-responsive img-circle nav-link" width="30" height="30" />
								</div>
								<a class="navbar-img" href=""><img src="../img/house.png" alt="logo" width="32" height="26" /></a>
								<button id="nav-toggle" type="button" class="ui-navbar-toggle navbar-toggle" data-toggle="collapse" data-target=".navbar-1">
									<span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
								</button>
							</div>
							<div class="collapse navbar-collapse navbar-1">
								<ul class="site-navigation nav navbar-nav">
									<li>
										<a href="dashboard.php" class="nav-link">Dashboard</a>
									</li>
									<li>
										<a href="control_center.php" class="nav-link">Portail</a>
									</li>
									<li>
										<a href="../logout.php" class="nav-link">Logout</a>
									</li>
								</ul>
							</div>
						</nav>
					</div>
				</div>
			</div>
		</div>
		<!-- Navigation Bloc END -->

		<!-- bloc-2 -->
		<div class="bloc l-bloc bg-citysky" id="bloc-2">
			<div class="container bloc-lg">
				
			</div>
		</div>
		<!-- bloc-2 END -->

		<!-- Footer - bloc-3 -->
		<div class="bloc l-bloc bgc-white" id="bloc-3">
			<div class="container bloc-lg">
				<div class="row">
					<div class="col-xs-12 col-md-8 col-md-offset-2">
						
					</div>
				</div>
			</div>
		</div>
		<!-- Footer - bloc-3 END -->
	</div>


	<!-- Footer container - Bloc 4 -->
	<div>
		<h3 class="text-center mg-md ft-black">
			___________________________________________
		</h3>
		<p class="text-center ft-black">
			Alfred's domotique server / Made by Gauthier Donikian
		</p>
	</div>
	<!-- Footer container END -->
	

	<!-- Affichage Contenu APP -->

	<!-- Affichage Contenu APP END -->

</div>
<!-- Main container END -->


</body>

</html>

