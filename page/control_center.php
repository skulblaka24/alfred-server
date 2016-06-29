<?php 
/* #####################################################################
#
#   Project       : Alfred
#   Author        : Gauthier Donikian
#   Version       : 2.0
#   Amelioration  : Un bouton par pièce (Toutes lumières) trié par le name de la pièce.
#   Commentaire   :  Vous pouvez envoyer un signal de deux façon différentes :
#
#					En ligne de commande linux :
#						$ /var/www/hcc/radioEmission 0 12325261 1 on
#						$ ./radioEmission 0 8217034 "" on
#
#						0 = le numéro WiringPi du PIN du Raspberry relié a la carte émetteur 433mhz (ici zéro, qui correspond au pin physique 11 du rpi)
#						
#						12325261 = Un code de télécommande que nous attribuons arbitrairement au raspberry PI, ca permet aux prises de n’obéir qu’a ce code et donc qu’a votre raspberry.
#
#						1 = code du récepteur (choisis arbitrairement, c’est ce qui permettra au récepteur de savoir si c’est à lui qu’on donne l’ordre ou a un autre)
#
#						on = état de la prise souhaité on ou off
#
#					nb : Le ./ est obligatoire devant quand vous exécutez le programme depuis le répertoire courant, si vous ne le faite pas vous risquez de tomber sur un “commande not found”
#
##################################################################### */

   
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
    <link rel="stylesheet" type="text/css" href="../css/annexe/bootstrap.css" />
    <link rel='stylesheet' href='../css/annexe/animate.css' />
    <link rel="stylesheet" id="ppstyle" type="text/css" href="../css/main/control_center.css" />
    <link rel="apple-touch-icon" sizes="180x180" href="../img/icon_app.png">

    
    <script src="../js/annexe/jquery-2.1.0.min.js"></script>
    <script src="../js/annexe/bootstrap.js"></script>
   	<script type="text/javascript" src="../js/main/control_center.js"></script>
    
    <title>Control center - Alfred Server</title>
</head>
<body>
<!-- Main container -->
<div class="page-container">
    
	<!-- Navigation Bloc -->
	<div class="page">
		<div id="b-nav" class="bloc-container bgc-grey">
			<div id="bloc-nav" class="d-mode">
				<div class="bloc d-bloc" id="nav-bloc">
					<div class="container bloc-sm">
						<nav class="navbar row">
							<div class="navbar-header">
								<div class="navbar-pro">
									<img src="../../img/users/<?php echo $_SESSION['username'];?>.png" class="img-responsive img-circle nav-link" width="30" height="30" />
								</div>
								<div class="navbar-img">
                                    <img src="../img/ccontrol.png" class="title_img" width="45" height="35" />
                                    <h5 class="title">
                                            <i class="ft-white">Control Center</i>
                                    </h5>
                                </div>
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
		<div class="bloc l-bloc bg-iphone-bloc" id="bloc-2">
			<div class="container bloc-lg full">
				<div class="modal-body">
						<div class="container-fluid">
							
							<div class="relai_menu">
								<div class="amp_menu_title">
									<p class="amp_txt_title">Ampoule</p>
								</div>	
								<?php
									$ccLocation = "WHERE rel_type = \"ampoule\"";
									$rel_div = "amp_menu";
									
									// Création de tous les sets d'icones sauf pour le tri par pièce
									$req = $pdo->query('SELECT * FROM `alf_rel` '.$ccLocation);

									echo '<div class="' . $rel_div . '">';
									while ($data = $req->fetch()) {
										echo '<div id="" class="amp_btn btn_'. $data['rel_room'] .' animated fadeIn animDelay02" data-id="' . $data['rel_id'] . '" data-room="' . $data['rel_room'] . '" data-type="' . $data['rel_type'] . '">';
											echo  '<div class="btn_title">';
												echo  '<span class="btn_title">' . $data['rel_name'] . '</span>';
											echo  '</div>';
											echo  '<div class="room_name">';
												echo  '<span class="room_name">' . $data['rel_room'] . '</span>';
											echo  '</div>';


											echo '<div class="btn_icon" data-state="' . $state . '">';
												echo  '<img class="btn_img imgi" src="../img/' . $data['rel_type'] . '.png" />';
												echo  '<img class="btn_img imgp" src="../img/Point' . (($state) ? 'Vert' : 'Rouge') . '.png" />';
											echo  '</div>';
										echo  '</div>';
									}
									echo '</div>';
								?>
							</div>
							<div class="relai_menu">
								<div class="pri_menu_title">
									<p class="pri_txt_title">Prise</p>
								</div>	
								<?php
									$ccLocation = "WHERE rel_type = \"prise\"";
									$rel_div = "pri_menu";
									
									// Création de tous les sets d'icones sauf pour le tri par pièce
									$req = $pdo->query('SELECT * FROM `alf_rel` '.$ccLocation);

								echo '<div class="' . $rel_div . '">';
									while ($data = $req->fetch()) {
										echo '<div id="" class="pri_btn btn_'. $data['rel_room'] .' animated fadeIn animDelay02" data-id="' . $data['rel_id'] . '" data-room="' . $data['rel_room'] . '" data-type="' . $data['rel_type'] . '">';
											echo  '<div class="btn_title">';
												echo  '<span class="btn_title">' . $data['rel_name'] . '</span>';
											echo  '</div>';
											echo  '<div class="room_name">';
												echo  '<span class="room_name">' . $data['rel_room'] . '</span>';
											echo  '</div>';


											echo '<div class="btn_icon" data-state="' . $state . '">';
												echo  '<img class="btn_img imgi" src="../img/' . $data['rel_type'] . '.png" />';
												echo  '<img class="btn_img imgp" src="../img/Point' . (($state) ? 'Vert' : 'Rouge') . '.png" />';
											echo  '</div>';
										echo  '</div>';
									}
								echo '</div>';	
								?>
							</div>
							<div class="relai_menu">
								<div class="room_menu_title">
									<p class="room_txt_title">Pièces</p>
								</div>
								
								
							</div>
							<div class="relai_menu">
								<div class="cmd_menu_title">
									<p class="cmd_txt_title">Commandes</p>
								</div>	
									<?php
										$ccLocation = "WHERE rel_type = \"cmd\"";
										$rel_div = "cmd_menu";
										
										// Création de tous les sets d'icones sauf pour le tri par pièce
										$req = $pdo->query('SELECT * FROM `alf_rel` '.$ccLocation);

									echo '<div class="' . $rel_div . '">';
										while ($data = $req->fetch()) {
											echo '<div id="" class="cmd_btn btn_'. $data['rel_room'] .' animated fadeIn animDelay02" data-id="' . $data['rel_id'] . '" data-room="' . $data['rel_room'] . '" data-type="' . $data['rel_type'] . '">';
												echo  '<div class="btn_title">';
													echo  '<span class="btn_title">' . $data['rel_name'] . '</span>';
												echo  '</div>';
												echo  '<div class="room_name">';
													echo  '<span class="room_name">' . $data['rel_room'] . '</span>';
												echo  '</div>';


												echo '<div class="btn_icon" data-state="' . $state . '">';
													echo  '<img class="btn_imgc imgic" src="../img/' . $data['rel_type'] . '.png" />';
													echo  '<img class="btn_imgc imgpc" src="../img/Point' . (($state) ? 'Vert' : 'Rouge') . '.png" />';
												echo  '</div>';
											echo  '</div>';
										}
									echo '</div>';
									?>
								
								
							</div>
							<div class="relai_menu">
								<div class="oth_menu_title">
									<p class="oth_txt_title">Autre</p>
								</div>	
									<?php
										$ccLocation = "WHERE rel_type = \"autre\"";
										$rel_div = "oth_menu";
										
										// Création de tous les sets d'icones sauf pour le tri par pièce
										$req = $pdo->query('SELECT * FROM `alf_rel` '.$ccLocation);

									echo '<div class="' . $rel_div . '">';
										while ($data = $req->fetch()) {
											echo '<div id="" class="oth_btn btn_'. $data['rel_room'] .' animated fadeIn animDelay02" data-id="' . $data['rel_id'] . '" data-room="' . $data['rel_room'] . '" data-type="' . $data['rel_type'] . '">';
												echo  '<div class="btn_title">';
													echo  '<span class="btn_title">' . $data['rel_name'] . '</span>';
												echo  '</div>';
												echo  '<div class="room_name">';
													echo  '<span class="room_name">' . $data['rel_room'] . '</span>';
												echo  '</div>';


												echo '<div class="btn_icon" data-state="' . $state . '">';
													echo  '<img class="btn_imgo imgio" src="../img/' . $data['rel_type'] . '.png" />';
													echo  '<img class="btn_imgo imgpo" src="../img/Point' . (($state) ? 'Vert' : 'Rouge') . '.png" />';
												echo  '</div>';
											echo  '</div>';
										}
									echo '</div>';
									?>
							</div>
							
						</div>
				</div>
				<!-- Signature de bas de page -->
				<div id="sign_div">
					<p class="ft-white" id="sign_text_i">
						_______________________________________________
					</p>
					<h5 id="sign_text"><i class="ft-white">Alfred's domotique server / Made by Gauthier Donikian</i></h5>
				</div>
			</div>
		</div>
	</div>
	<!-- bloc-2 END -->
	

	<!-- Affichage choix par piece avec fond blanc -->
	<?php
			$req = $pdo->query('SELECT * FROM `alf_room` ');				

			echo '<div id="" class="room_choice">';
				echo  '<span class="room_title">Choisissez une pièce :</span>';
				echo '<div id="" class="room_btn_block">';
					while ($data = $req->fetch()) {
					$rn = str_replace(' ', '_', $data['room_name']);
					
						echo '<div id="btn_room" class="btn_room btn animated fadeIn animDelay02" room_name="'. $rn .'">';
							echo  '<div class="btn_room_title">';
								echo  '<span class="btn_room_title">' . $data['room_name'] . '</span>';
							echo  '</div>';
							
						echo  '</div>';
					}
				echo '</div>';
			echo  '</div>';	
	?>
	<!-- Affichage choix par piece avec fond blanc END -->
</div>
<!-- Main container END -->


</body>

</html>

