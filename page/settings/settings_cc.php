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
    <link rel="stylesheet" id="ppstyle" type="text/css" href="../../css/settings/settings_cc.css" />
    <link rel='stylesheet' href='../../css/annexe/animate.css' />

    
    <script src="../../js/annexe/jquery-2.1.0.min.js"></script>
    <script src="../../js/annexe/bootstrap.js"></script>
    <script type="text/javascript" src="../../js/settings/settings_cc.js"></script>
    
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
			<div class="bloc l-bloc bg-citysky" id="bloc-2">
				<div class="settings_nav ft-white">
					<ul class="settings_navbar">
						<li>
							<a href="./settings_dash.php" class="nav-link">Dashboard</a>
						</li>
                        <li>
							<a href="./settings_cc.php" class="nav-link nav-current">Control Center</a>
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
					<form action="../action/settings_cc_bdd.php" method="POST" name="addsql_e">
						<fieldset>
							<div class="form ft-white">
								<div class="bloc-1-input">
								    <label for="label_name">Nom</label><br>
								    <!--<input type="text" id="name" onkeyup="$('#vocalCommand').html($(this).val());" name="name" placeholder="Nom de la machine"/> <small>Commande vocale associée : "<span id="vocalCommand"></span>"</small></label>-->
								    <input class="form-control" type="text" id="name" name="name" placeholder="Nom de la machine" style="width: 170px;"/><br><br>

								    <label for="label_description">Description</label><br>
								    <input class="form-control" type="text" name="description" id="description" placeholder="Description" style="width: 170px;"/><br><br>
                                    
                                    <label for="label_relai">Type</label><br>
                                    <select name="relai" id="relai" style="width: 170px;">
								    	<option id="relai1" name="relai1" value="filaire" >Filaire en local</option>
								    	<option id="relai2" name="relai2" value="radio" >Radio en local</option>
								    	<option id="relai3" name="relai3" value="cmd" >Cmd en local</option>
                                        <option id="relai4" name="relai4" value="rfilaire" >Filaire en remote</option>
								    	<option id="relai5" name="relai5" value="rradio" >Radio en remote</option>
								    	<option id="relai6" name="relai6" value="rcmd" >Cmd en remote</option>
								    </select><br><br><br><br>
   								</div>

								<div class="bloc-2-input">
								    <label for="label_time">Impulsion</label><br>
								    <select name="time" id="time" style="width: 170px;">
								    	<option id="time1" name="time1" value="normal" >False</option>
								    	<option id="time2" name="time2" value="impulsion" >True</option>
								    </select><br><br><br><br>
                                    
					                <label for="label_freq">Temps impulsion</label><br>
								    <input class="form-control" type="text" name="freq" id="freq" placeholder="Temps en seconde" style="width: 170px;" disabled/><br><br>
                                    
                                    <label for="label_pin">Pin GPIO</label><br>
								    <input class="form-control" type="text" name="pin" id="pin" placeholder="Pin Gpio" style="width: 170px;"/><br><br> 
								</div>

								<div class="bloc-3-input">
								    <label for="label_tel">Code télécommande</label><br>
								    <input class="form-control" type="text" name="tel" id="tel" placeholder="Code radio" style="width: 170px;" disabled/><br><br>
					                
					                <label for="label_room">Pièce</label><br>
								    <select name="room" id="room" style="width: 170px;">
								    	<option id="room1" name="room1" value="Salon" >Salon</option>
								    	<option id="room2" name="room2" value="Salle à manger" >Salle à manger</option>
								    	<option id="room3" name="room3" value="Chambre" >Chambre</option>
                                        <option id="room4" name="room4" value="Toilettes" >Toilettes</option>
								    	<option id="room5" name="room5" value="Cuisine" >Cuisine</option>
								    	<option id="room6" name="room6" value="Salle de bain" >Salle de bain</option>
                                        <option id="room7" name="room7" value="Autre" >Autre</option>
								    </select><br><br><br><br>
                                    
									<label for="label_rec">Code Recepteur</label><br>
								    <input class="form-control" type="text" name="rec" id="rec" placeholder="Code id recepteur" style="width: 170px;" disabled/><br><br>
								    
				                </div>
                                
                                <div class="bloc-4-input">
								    <label for="label_type">Genre</label><br>
								    <select name="type" id="type" style="width: 170px;">
								    	<option id="type1" name="type1" value="ampoule" >Ampoule</option>
								    	<option id="type2" name="type2" value="prise" >Prise</option>
                                        <option id="type3" name="type3" value="cmd" >Commande</option>
                                        <option id="type4" name="type4" value="autre" >Autre</option>
								    </select><br><br><br><br>
                                    
					                <label for="label_cmd">Commande système</label><br>
								    <input class="form-control" type="text" name="cmd" id="cmd" placeholder="Commande shell" style="width: 170px;" disabled/><br><br>
                                    
                                    <label for="label_ip">Ip Remote</label><br>
								    <input class="form-control" type="text" name="ip" id="ip" placeholder="Ip de la machine en remote" style="width: 170px;" disabled/><br><br> 
								</div>
                                
                                <div class="bloc-5-input">
								    <label for="label_port">Port SSH</label><br>
								    <input class="form-control" type="text" name="port" id="port" placeholder="Port connection SSH" style="width: 170px;" disabled/><br><br>
					                
					                <label for="label_login">Login SSH</label><br>
								    <input class="form-control" type="text" name="login" id="login" placeholder="Login root SSH" style="width: 170px;" disabled/><br><br>
                                    
                                    <label for="label_password">Password</label><br>
								    <input class="form-control" type="password" name="password" id="passwordsite" placeholder="Password root SSH" style="width: 170px;" disabled/><br><br> 
								</div> 
								<br><input type="submit" class="btn-submit btn btn-primary btn-block" id="addSqlLine" name="button" value="Ajouter" style="width: 170px;"></input><br><br> 

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
							    <th>Type</th>
					            <th>Impulsion</th>
								<th>Temps</th>
                                <th>Pin GPIO</th>
					            <th>Code Tel</th>
								<th>Code rec</th>
                                <th>Pièce</th>
					            <th>Genre</th>
								<th>Cmd</th>
                                <th>Ip</th>
					            <th>Port</th>
								<th>Login</th>
					            <th>Password</th>
								<th></th>
						    </tr>
						    </thead>
					    
						    <?php $req = $pdo->query('SELECT * FROM `alf_rel`');

									while ($data = $req->fetch()) {
						    	?>
						    <tr>
							    <td><p class="rel_tab_n<?php echo $data['rel_id'] ?>" data-name="<?php echo $data['rel_name'] ?>"><?php echo $data['rel_name'] ?></p></td>
							    <td><p class="rel_tab_d<?php echo $data['rel_id'] ?>" data-desc="<?php echo $data['rel_desc'] ?>"><?php echo $data['rel_desc'] ?></p></td>  
					            <td><p class="rel_tab_r<?php echo $data['rel_id'] ?>" data-relai="<?php echo $data['rel_relai'] ?>"><?php echo $data['rel_relai'] ?></p></td>
					            <td><p class="rel_tab_t<?php echo $data['rel_id'] ?>" data-time="<?php echo $data['rel_time'] ?>"><?php echo $data['rel_time'] ?></p></td>
					            <td><p class="rel_tab_f<?php echo $data['rel_id'] ?>" data-freq="<?php echo $data['rel_freq'] ?>"><?php echo $data['rel_freq'] ?></p></td>
                                <td><p class="rel_tab_p<?php echo $data['rel_id'] ?>" data-pin="<?php echo $data['rel_pin'] ?>"><?php echo $data['rel_pin'] ?></p></td>
							    <td><p class="rel_tab_te<?php echo $data['rel_id'] ?>" data-tel="<?php echo $data['rel_tel'] ?>"><?php echo $data['rel_tel'] ?></p></td>  
					            <td><p class="rel_tab_re<?php echo $data['rel_id'] ?>" data-rec="<?php echo $data['rel_rec'] ?>"><?php echo $data['rel_rec'] ?></p></td>
					            <td><p class="rel_tab_ro<?php echo $data['rel_id'] ?>" data-room="<?php echo $data['rel_room'] ?>"><?php echo $data['rel_room'] ?></p></td>
					            <td><p class="rel_tab_ty<?php echo $data['rel_id'] ?>" data-type="<?php echo $data['rel_type'] ?>"><?php echo $data['rel_type'] ?></p></td>
                                <td><p class="rel_tab_c<?php echo $data['rel_id'] ?>" data-cmd="<?php echo $data['rel_cmd'] ?>"><?php echo $data['rel_cmd'] ?></p></td>
							    <td><p class="rel_tab_i<?php echo $data['rel_id'] ?>" data-ip="<?php echo $data['rel_ip'] ?>"><?php echo $data['rel_ip'] ?></p></td>  
					            <td><p class="rel_tab_po<?php echo $data['rel_id'] ?>" data-port="<?php echo $data['rel_port'] ?>"><?php echo $data['rel_port'] ?></p></td>
								<td><p class="rel_tab_l<?php echo $data['rel_id'] ?>" data-login="<?php echo $data['rel_login'] ?>"><?php echo $data['rel_login'] ?></p></td>  
					            <td><p class="rel_tab_pa<?php echo $data['rel_id'] ?>" data-password="<?php echo $data['rel_passport'] ?>"><?php echo $data['rel_passport'] ?></p></td>
					            <td><button id="rel_mod" class="btn btn-default img-mod" data-id="<?php echo $data['rel_id'] ?>"></button>
					            <a href="../action/settings_cc_bdd.php?action=delete&id=<?php echo $data['rel_id'] ?>" class="btn btn-default img-delete"></a></td>
					                 
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

