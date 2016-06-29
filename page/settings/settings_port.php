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

    
    <link rel="shortcut icon" type="image/png" href="../../img/favicon.ico" />
    <link rel="stylesheet" type="text/css" href="../../css/annexe/bootstrap.css">
    <link rel="stylesheet" id="ppstyle" type="text/css" href="../../css/settings/settings_port.css" />
    <link rel='stylesheet' href='../../css/annexe/animate.css' />

    
    <script src="../../js/annexe/jquery-2.1.0.min.js"></script>
    <script src="../../js/annexe/bootstrap.js"></script>
    <script type="text/javascript" src="../../js/settings/settings_port.js"></script>
    
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
										<img src="../../img/users/<?php echo $_SESSION['username'];?>.png" class="img-responsive img-circle nav-link" width="30" height="30" />
									</div>
									<a class="navbar-img" href="../dashboard.php"><img src="../../img/house.png" alt="logo" width="32" height="26" /></a>
									
								</div>
								<div class="collapse navbar-collapse navbar-1">
									<ul class="site-navigation nav navbar-nav">
										<li>
											<span class="">Paramètres du portail</span>
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
			<div class="bloc l-bloc bg-fond" id="bloc-2">
				<div class="settings_nav ft-white">
					<ul class="settings_navbar">
						<li>
							<a href="./settings_dash.php" class="nav-link">Dashboard</a>
						</li>
						<li>
							<a href="./settings_cc.php" class="nav-link">Control Center</a>
						</li>
						<li>
							<a href="./settings_port.php" class="nav-link nav-current">Portail</a>
						</li>
						<li>
							<a href="./settings_alfred.php" class="nav-link">Alfred</a>
						</li>
						<li>
							<a href="./settings_ut.php" class="nav-link">Utilisateur</a>
						</li>
						<li>
							<a href="../dashboard.php" class="nav-link"><img class="nav-img" id="nav-img" src="../../img/logout.png"></img></a>
						</li>
					</ul>

				</div>
				<div class="container bloc-lg">
					
					<form action="../action/settings_port_bdd.php" method="POST" name="addsql_e">
						<fieldset>
							<div class="form ft-white">
								<div class="bloc-1-input">
									<label for="label_ip">Adresse du serveur</label><br>
								    <input class="form-control" type="text" name="ip" id="ip" placeholder="" style="width: 170px;"/><br><br>
					                
					                <label for="label_port">Port ssh du serveur</label><br>
								    <input class="form-control" type="text" name="port" id="port" placeholder="" style="width: 170px;"/><br><br>
								</div>

								<div class="bloc-2-input">
								    <div class="img-ut">
										<img src="../../img/portail.png" class="img-responsive img-circle animated flip" />
									</div>
								</div>

								<div class="bloc-3-input">
								    <label for="label_login">Login ssh du serveur</label><br>
								    <input class="form-control" type="text" name="id_login" id="id_login" placeholder="" style="width: 170px;"/><br><br>
					                
					                <label for="label_pass">Password ssh du serveur</label><br>
								    <input class="form-control" type="password" name="id_password" id="id_password" placeholder="" style="width: 170px;"/><br><br>
								    <br><button type="submit" class="btn btn-primary btn-block" id="addSqlLine" style="width: 170px;" value="Submit">Modifier</button><br><br>
								</div>
							</div>
			    		</fieldset>
					</form>
				</div>
				<div class="label_info">

				 <?php $req = $pdo->query('SELECT * FROM `alf_port`');

									while ($data = $req->fetch()) {
						    	?>
						    <tr>
							    <td><?php echo "L'adresse ip du serveur :".$data['ip'] ?></td>
							    <td><?php echo "  /  Le port du serveur :".$data['port'] ?></td>  
					            <td><?php echo "  /  Le login du serveur :".$data['login'] ?></td>
					                 
						    </tr>
						    <?php } ?>

				</div>





			</div>
		</div>
		<!-- bloc-2 END -->
	</div>


	<!-- Footer - Bloc 4 -->
	<div>
		<h3 class="text-center mg-md ft-black">
			___________________________________________
		</h3>
		<p class="text-center ft-black">
			Alfred's domotique server / Made by Gauthier Donikian
		</p>
	</div>
	<!-- Footer END -->
	

	<!-- Affichage Contenu APP -->

	<!-- Affichage Contenu APP END -->

</div>
<!-- Main container END -->
</body>
</html>
<script type="text/javascript">
	$(document).ready(function(){
		$('#mdp').focus();

		$('#addSqlLine').click(function(){
			document.addsql_e.submit();
		});
	})

</script>
