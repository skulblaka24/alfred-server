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
    <link rel="stylesheet" id="ppstyle" type="text/css" href="../../css/settings/settings_ut.css" />
    <link rel='stylesheet' href='../../css/annexe/animate.css' />

    
    <script src="../../js/annexe/jquery-2.1.0.min.js"></script>
    <script src="../../js/annexe/bootstrap.js"></script>
    <script type="text/javascript" src="../../js/settings/settings_ut.js"></script>
    
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
											<span class="">Paramètres de l'utilisateur</span>
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
			<div class="bloc l-bloc bg-mountains" id="bloc-2">
				<div class="settings_nav ft-white">
					<ul class="settings_navbar">
						<li>
							<a href="./settings_dash.php" class="nav-link">Dashboard</a>
						</li>
						<li>
							<a href="./settings_cc.php" class="nav-link">Control Center</a>
						</li>
						<li>
							<a href="./settings_port.php" class="nav-link">Portail</a>
						</li>
						<li>
							<a href="./settings_alfred.php" class="nav-link">Alfred</a>
						</li>
						<li>
							<a href="./settings_ut.php" class="nav-link nav-current">Utilisateur</a>
						</li>
						<li>
							<a href="../dashboard.php" class="nav-link"><img class="nav-img" id="nav-img" src="../../img/logout.png"></img></a>
						</li>
					</ul>

				</div>
				<div class="container bloc-lg">
					
				<!-- ../action/settings_ut_bdd.php -->
					


					<form action="../action/settings_ut_bdd.php" method="POST" name="addsql_e">
						<fieldset>
							<div class="form ft-white">
								<div class="bloc-1-input">
								    <div class="img-ut">
										<img src="../../img/users/unknown.png" class="img-responsive img-circle animated flip" />
									</div>
								</div>

								<div class="bloc-2-input">
								    <label for="label_user">Nom d'utilisateur</label><br>
								    <input class="form-control" type="text" name="user" id="user" placeholder="Tapez le nom du user" style="width: 170px;" required/><br><br><br>
					                
					                <label for="label_mdp">Mot de passe</label><br>
								    <input class="form-control" type="password" name="pass" id="pass" placeholder="Tapez le mdp" style="width: 170px;" /><br><br>
								   
								    <input class="" type="checkbox" name="dash" id="dash" value="1">  Dashboard<br><br>
									<input class="" type="checkbox" name="cc" id="cc" value="1">  Control center<br><br><br>
								    
								</div>
								<div class="bloc-3-input">
								    <label for="label_status">Status</label><br>
								   	<select name="status" id="status" style="width: 170px;">
								    	<option id="status1" name="status1" value="Admin" >Admin</option>
								    	<option id="status2" name="status2" value="User" >User</option>
								    </select>
									
									
									<label for="label_bouton" style="height: 16px;"></label><br>
									<input type="submit" class="btn-submit btn btn-primary btn-block" id="addSqlLine" name="button" value="Ajouter" style="width: 170px;"></input><br><br>
				                	
									
									
									<input class="" type="checkbox" name="port" id="port" value="1">  Portail<br><br>
									<input class="" type="checkbox" name="settings" id="settings" value="1">  Settings<br><br><br>
								</div>
							</div>
			    		</fieldset>
					</form>




				</div>
			</div>
		</div>
		<!-- bloc-2 END -->

		<!-- bloc-3 -->
		<div class="bloc l-bloc bgc-white" id="bloc-3">
			<div class="container bloc-lg">
				<div class="row">
					<div class="col-xs-12 col-md-8 col-md-offset-2">
						<table class="table table-striped table-bordered table-hover">
						    <thead>
						    <tr>
						    	<th>Username</th>
							    <th>Status</th>
								<th></th>
						    </tr>
						    </thead>
					    
						    <?php $req = $pdo->query('SELECT * FROM `alf_users`');

									while ($data = $req->fetch()) {
						    	?>
						    <tr>
							    <td><p class="ut_tab_u<?php echo $data['id'] ?>" data-name="<?php echo $data['name'] ?>"><?php echo $data['name'] ?></p></td>
							    <td><p class="ut_tab_s<?php echo $data['id'] ?>" data-desc="<?php echo $data['registration_number'] ?>"><?php echo $data['registration_number'] ?></p></td>  
					            <td><button id="ut_mod" class="btn btn-default img-mod" data-id="<?php echo $data['id'] ?>"></button>
					            <a href="../action/settings_ut_bdd.php?action=delete&id=<?php echo $data['id'] ?>" class="btn btn-default img-delete"></a></td>
					                 
						    </tr>
						    <?php } ?>
					    </table>
					</div>
				</div>
			</div>
		</div>
		<!-- bloc-3 END -->
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
