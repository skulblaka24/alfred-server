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

	include ("../action/login.php");

	//Encodage de la page
	date_default_timezone_set("Europe/Paris");
	header('Content-type: text/html; charset=UTF-8');

    //Définition des paramètre de connexion à la base de données
	include ("../../../auth/authDB.php");

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
    <link rel="stylesheet" id="ppstyle" type="text/css" href="../../css/settings/settings_dash.css" />
    <link rel='stylesheet' href='../../css/annexe/animate.css' />

    
    <script src="../../js/annexe/jquery-2.1.0.min.js"></script>
    <script src="../../js/annexe/bootstrap.js"></script>
    <script type="text/javascript" src="../../js/settings/settings_dash.js"></script>
    
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
										<img src="../../img/users/<?php echo $_SESSION['username'];?>.jpg" class="img-responsive img-circle nav-link" width="30" height="30" />
									</div>
									<a class="navbar-img" href="../dashboard.php"><img src="../../img/house.png" alt="logo" width="32" height="26" /></a>
									<button id="nav-toggle" type="button" class="ui-navbar-toggle navbar-toggle" data-toggle="collapse" data-target=".navbar-1">
										<span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
									</button>
								</div>
								<div class="collapse navbar-collapse navbar-1">
									<ul class="site-navigation nav navbar-nav">
										<li>
											<span class="">Paramètres du dashboard</span>
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
				<div class="settings_nav ft-white">
					<ul class="settings_navbar">
						<li>
							<a href="./settings_dash.php" class="nav-link nav-current">Dashboard</a>
						</li>
						<li>
							<a href="./settings_port.php" class="nav-link">Portail</a>
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
					<form action="../action/settings_dash_bdd.php" method="POST" name="addsql_e">
						<fieldset>
							<div class="form ft-white">
								<div class="bloc-1-input">
								    <label for="label_name">Nom</label><br>
								    <!--<input type="text" id="name" onkeyup="$('#vocalCommand').html($(this).val());" name="name" placeholder="Nom de la machine"/> <small>Commande vocale associée : "<span id="vocalCommand"></span>"</small></label>-->
								    <input class="form-control" type="text" id="name" name="name" placeholder="Nom de la machine" style="width: 170px;"/><br><br>

								    <label for="label_description">Description</label><br>
								    <input class="form-control" type="text" name="description" id="description" placeholder="Description" style="width: 170px;" /><br><br>
								</div>

								<div class="bloc-2-input">
								    <label for="label_ip">Adresse IP</label><br>
								    <input class="form-control" type="text" name="ip" id="ip" placeholder="Adresse IP" style="width: 170px;" /><br><br>
					                
					                <label for="label_site">Contenu</label><br>
								    <input class="form-control" type="text" name="site" id="site" placeholder="Site, shell, etc" style="width: 170px;" /><br><br> 
								</div>

								<div class="bloc-3-input">
								    <label for="label_type">Type</label><br>
					                <select name="type" id="type" style="width: 170px;">
								    	<option id="type1" name="type1" value="SERVEUR" >Serveur</option>
								    	<option id="type2" name="type2" value="PCP" >PC Portable</option>
								    	<option id="type3" name="type3" value="WIFI" >Bornes Wifi</option>
								    </select><br><br><br><br>
								    <br><button type="submit" class="btn btn-primary btn-block" id="addSqlLine" style="width: 170px;" value="Submit">Ajouter</button><br><br>
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
						    	<th>Nom</th>
							    <th>Description</th>
							    <th>Adresse IP</th>
					            <th>Contenu</th>
								<th>Type</th>
								<th></th>
						    </tr>
						    </thead>
					    
						    <?php $req = $pdo->query('SELECT * FROM `alf_dash`');

									while ($data = $req->fetch()) {
						    	?>
						    <tr>
							    <td><?php echo $data['dash_name'] ?></td>
							    <td><?php echo $data['dash_description'] ?></td>  
					            <td><?php echo $data['dash_machine'] ?></td>
					            <td><?php echo $data['dash_site'] ?></td>
					            <td><?php echo $data['dash_type'] ?></td> 
					            <td><button id="dash_mod" class="btn btn-default img-mod"></button>
					            <a href="../action/settings_dash_bdd.php?action=delete&id=<?php echo $data['dash_id'] ?>" class="btn btn-default img-delete"></a></td>
					                 
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
<script type="text/javascript">
	$(document).ready(function(){
		$('#name').focus();

		$('#addSqlLine').click(function(){
			document.addsql_e.submit();
		});

	})
</script>
