<?php 
	/* #####################################################################
   #
   #   Project       : Alfred
   #   Author        : Gauthier Donikian
   #   Version       : 2.0
   #   Commentaire   :
   #
   ##################################################################### */

	//Démarrage de la session
	session_start();
	include ("action/login.php");

	//Encodage de la page
	date_default_timezone_set("Europe/Paris");
	header('Content-type: text/html; charset=UTF-8');

    //Définition des paramètre de connexion à la base de données
	include ("../../auth/authDB.php");

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
    <link rel="stylesheet" type="text/css" href="../css/annexe/bootstrap.css">
    <link rel='stylesheet' href='../css/annexe/animate.css' />
    <link rel="stylesheet" id="ppstyle" type="text/css" href="../css/main/welcome.css" />
    <link rel="apple-touch-icon" sizes="180x180" href="../img/icon_app.png">

    
    <script src="../js/annexe/jquery-2.1.0.min.js"></script>
    <script src="../js/annexe/bootstrap.js"></script>
   	<!--<script type="text/javascript" src="../js/main/welcome.js"></script>-->
    
    <title>Welcome - Alfred Server</title>
</head>
<body>
<!-- Main container -->
<div class="page-container full-height">
    
	<!-- Navigation Bloc -->
	<div class="page full-height">
		<div id="b-nav" class="bloc-container bgc-grey">
			<div id="bloc-nav" class="d-mode">
				<div class="bloc d-bloc" id="nav-bloc">
					<div class="container bloc-sm">
						<nav class="navbar row">
							<div class="navbar-header">
								<div class="navbar-pro">
									<img src="../../img/users/<?php echo $_SESSION['username'];?>.png" class="img-responsive img-circle nav-link" width="30" height="30" />
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
										<a href="control_center.php" class="nav-link">Control Center</a>
									</li>
									<li>
										<a href="portail.php" class="nav-link">Portail</a>
									</li>
									<li>
										<a href="./settings/settings_dash.php" class="nav-link">Settings</a>
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
		<div class="bloc l-bloc bg-cirques ft-white full-wnav-height" id="bloc-2">
			<div class="container bloc-lg">
				<div id="bloc-w" class="">
					<img src="../../img/users/<?php echo $_SESSION['username'];?>.png" class="img-responsive img-circle animated flip img-user"/>
					<p class="login_title text-center">
						<strong><?php echo $_SESSION['username'];?></strong>
					</p>
				</div>
				<div id="bloc-w" class="">
					<h3 class="text-center ">
						<i class="ft-white">"Welcome Master to Alfred's Dashboard"</i>
					</h3>
					<?php if ($_SESSION['username'] == "skulblaka24") {?> 
                    <a class="next_btn" href="./dashboard.php"><img class="next_btn" src="../img/next_btn.png" alt="logo" /></a>
                    <?php } if ($_SESSION['username'] != "skulblaka24") { ?>
                    <a class="next_btn" href="./portail.php"><img class="next_btn" src="../img/next_btn.png" alt="logo" /></a>
                    <?php } ?>
				</div>
			</div>
		</div>
		<!-- bloc-2 END -->


</body>

</html>

