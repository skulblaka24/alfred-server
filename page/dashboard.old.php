<?php 
	/* #####################################################################
   #
   #   Project       : Alfred
   #   Author        : Gauthier Donikian
   #   Version       : 2.0
   #
   ##################################################################### */

	//Démarrage de la session
	session_start();
	include ("./action/login.php");
	
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
    <link rel="stylesheet" type="text/css" href="../css/annexe/bootstrap.css">
    <link rel="stylesheet" id="ppstyle" type="text/css" href="../css/main/dashboard.css" />
    <link rel='stylesheet' href='../css/annexe/animate.css' />

    
    <script src="../js/annexe/jquery-2.1.0.min.js"></script>
    <script src="../js/annexe/bootstrap.js"></script>
   	<script type="text/javascript" src="../js/main/dashboard.js"></script>
    
    <title>Dashboard - Alfred Server</title>
</head>
<body>
<!-- Main container -->
<div class="page-container">
    
	<!-- Navigation Bloc -->
	<div class="page bg-cirques">
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
									<?php if ($_SESSION['ad'] == 1) {?>
									<li>
										<a href="dashboard.php" class="nav-link">Dashboard</a>
									</li>
									<?php } if ($_SESSION['ac'] == 1) {?>
									<li>
										<a href="control_center.php" class="nav-link">Control Center</a>
									</li>
									<?php } if ($_SESSION['ap'] == 1) {?>
									<li>
										<a href="portail.php" class="nav-link">Portail</a>
									</li>
									<?php } if ($_SESSION['as'] == 1) {?>
									<li>
										<a href="./settings/settings_dash.php" class="nav-link">Settings</a>
									</li>
									<?php }?>
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
		<div class="bloc l-bloc bg-cirques" id="bloc-2">
			<div class="container bloc-lg">
				<div class="col-sm-2 col-sm-offset-5 col-xs-6 col-xs-offset-3">
					<img src="../../img/users/<?php echo $_SESSION['username'];?>.png" class="img-responsive img-circle animated flip" />
				</div>
				<div class="col-xs-12 col-md-8 col-md-offset-2">
					<h3 class="text-center">
						<i>"Welcome Master to Alfred's Dashboard"</i>
					</h3>
					<p class="text-center">
						<strong><?php echo $_SESSION['username'];?></strong>
					</p>
				</div>
			</div>
		</div>
		<!-- bloc-2 END -->

		<!-- Footer - bloc-3 -->
		<div class="bloc l-bloc bgc-white" id="bloc-3">
			<div class="container bloc-lg" id="bloc-3">
				<div class="row" id="">
					<div class="col-xs-12 col-md-8 col-md-offset-2" id="bloc-3-i">
						<!-- BODY -->
						<div class="modal-body">
							<div class="container-fluid">
								<!-- Les modules s'insère ici -->
								<div class="app_menu">
								<!-- MENU -->
								<?php

									// Lecture du fichier d'état du ping généré par ping daemon
									$tableau = array();
									$handle = @fopen("./.etat_servers.txt", "r" );
									if ($handle)
									{
									   while (!feof($handle))
									   {
									     $buffer = fgets($handle, 4096);
									     $tableau[] = $buffer;
									   }
									   fclose($handle);
									}

									$req = $pdo->query('SELECT * FROM `alf_dash`');

									while ($data = $req->fetch()) {
									
										/*$ping = exec('ping -c 1 -t 1 ' . $data['dash_machine'], $output, $return);
										echo $data['dash_id']." ".$return."/"; ### DEBUG ###
										$state = !$return;*/

										$state = $tableau[$data['dash_id']-1];
										if ($state == 1) { $state = 1; } else { $state = 0;}
									
										echo '<div class="app" data-id="' . $data['dash_id'] . '" data-url="' . $data['dash_site'] . '" data-load="0">';
											echo '<div class="app_icon" data-state="' . $state . '">';
												echo  '<img class="app_img imgi" src="../img/' . $data['dash_type'] . '.png" />';
												echo  '<img class="app_img imgp" src="../img/Point' . (($state) ? 'Vert' : 'Rouge') . '.png" />';
											echo  '</div>';
											echo  '<div class="app_title">';
												echo  '<span class="app_title">' . $data['dash_name'] . '</span>';
											echo  '</div>';
											
										echo  '</div>';
									}
								?>
								</div>
							</div>
						</div>
						<!-- FIN BODY -->
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
	<?php
								
		$req = $pdo->query('SELECT * FROM `alf_dash`');

		while ($data = $req->fetch()) {

			echo '<div class="app_bg_iframe'. $data['dash_id'] .'" data-id="' . $data['dash_id'] . '" data-url="' . $data['dash_site'] . '" data-load="0">';	
				echo '<div class="app_fond" data="' . $data['dash_id'] . '">';
					echo  '<div class="app_window">';
						echo  '<div class="open_iframe">';
							echo  '<div class="row">';
								echo  '<div class="app_button">';
									echo  '<img class="button" data="' . $data['dash_id'] . '" src="../img/croix.png" />';
									echo  '<img class="button" data="' . $data['dash_id'] . '" src="../img/reduire.png" />';
									echo  '<img class="button" data="' . $data['dash_id'] . '" src="../img/refresh.png" />'; // fais moi penser à la méthode de dieu pour le JS
								echo  '</div>';
								echo  '<span class="app_title_iframe" >' . $data['dash_name'] . '</span>';
							echo  '</div>';
							echo  '<div class="embed-responsive embed-responsive-16by9">';
								echo  '<iframe class="embed-responsive-item window" src=""></iframe>';
							echo  '</div>';
						echo  '</div>';
					echo  '</div>';
				echo  '</div>';
			echo  '</div>';

		}
	?>
	<!-- Affichage Contenu APP END -->

</div>
<!-- Main container END -->


</body>

</html>

