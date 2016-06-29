<?php 
/*#########################################################################################
#       Project       : Alfred
#       Author        : Gauthier Donikian
#       Version       : 2.0
#       Commentaire   : $monUrl = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']; echo $monUrl;
#       Instruction   : - Dé-zippez le code dans un répertoire var/www/hcc (radioEmission)
#						- Faites un sudo chown -R www-data:www-data /var/www/hcc
#						sur tous le dossier hcc (changez /var/www/hcc si votre chemin est différent, important sinon rien ne fonctionnera)
#
#						- Faites :
#							$ sudo chown root:www-data /var/www/hcc/radioEmission
#						- puis un
#							$ sudo chmod 4777 radioEmission
#						sur l’exécutable nommé radioEmission (important sinon l’interface web ne fonctionnera pas)
#						- Le script est installé !! -------
##########################################################################################*/

	//Démarrage de la session
	session_start();
	include ("./login.php");

	//Encodage de la page
	date_default_timezone_set("Europe/Paris");
	header('Content-type: text/html; charset=UTF-8');

    //Définition des paramètres de connexions à la base de données
	include ("../../auth/authDB.php");

    //Connexion à la base de données
	$pdo = new PDO("mysql:host=".SERVER.";dbname=".NAME, USER, PASSWORD);

	//Définition de l'encodage dans la BDD
	$pdo->exec("SET NAMES 'utf8'");

	$date = date('Y-m-d');
	$date_tmp = explode('-', $date);
	$_SESSION['URL'] = $_SERVER['HTTP_REFERER'];	
	
	 
	
	// Fonctionnement des commandes pour tous les relais (arg = yes or else)
	$activated = "no";
	// Fonctionnement mode debug oral /!\ only MACOSX (arg = yes or else)
	$debug = "yes";
	
	if (isset($_POST['relai'])) {
		if ($debug == "yes") {$test=shell_exec('say "laille di du relai à été transmis, c est le' .$_POST['relai'].'"');} /* Debug */

		$relaiId = "WHERE rel_id = \"". $_POST['relai'] ."\"";
		$req = $pdo->query('SELECT * FROM `alf_rel` '.$relaiId);

		while ($data = $req->fetch()) {
			
			// Check des differents types de relais
			if ($data['rel_relai'] == 'filaire') {
			//##################################################################
			
			//#                    Relai filaire en local
			
			//##################################################################
				if ($debug == "yes") {$test=shell_exec('say filaire');} /* Debug */
				
				if ($activated == "yes") {
					$filaire=shell_exec('gpio mode '. $data['rel_pin'] .' out');
					
					// Mode On/Off
					if ($data['rel_time'] == 'normal') {
						
						if ($data['rel_state'] == "0") {
							$filaire=shell_exec('gpio write '. $data['rel_pin'] .' 1');
							
							$state = 1;
							$sql = 'UPDATE `alf_rel` SET `rel_state`= ("'.$state.'") WHERE `rel_id`= ("'. $_POST['relai'] .'")';
							$pdo->exec($sql);
							if ($debug == "yes") {$test=shell_exec('say "Base mise à jour à 1"');} /* Debug */
							
						} elseif ($data['rel_state'] == "1") {
							$filaire=shell_exec('gpio write '. $data['rel_pin'] .' 0');
							
							$state = 0;
							$sql = 'UPDATE `alf_rel` SET `rel_state`= ("'.$state.'") WHERE `rel_id`= ("'. $_POST['relai'] .'")';
							$pdo->exec($sql);
							if ($debug == "yes") {$test=shell_exec('say "Base mise à jour à 0"');} /* Debug */
						}					
					// Mode Impulsion
					} elseif ($data['rel_time'] == 'impulsion') {
						$filaire=shell_exec('gpio write '. $data['rel_pin'] .' 1');
						
						sleep($data['rel_freq']);
						
						$filaire=shell_exec('gpio write '. $data['rel_pin'] .' 0');
					}
				}
			} elseif ($data['rel_relai'] == 'radio') {
			//##################################################################
			
			//#                    Emetteur radio en local
			
			//##################################################################
				if ($debug == "yes") {$test=shell_exec('say radio');} /* Debug */
				
				if ($activated == "yes") {
				
					$radio=shell_exec('gpio mode '. $data['rel_pin'] .' out');
					
					// Mode On/Off
					if ($data['rel_time'] == 'normal') {
						
						if ($data['rel_state'] == "0") {
							$radio=shell_exec('./radioEmission '. $data['rel_pin'] .' '. $data['rel_tel'] .' '. $data['rel_rec'] .' on');
							
							$state = 1;
							$sql = 'UPDATE `alf_rel` SET `rel_state`= ("'.$state.'") WHERE `rel_id`= ("'. $_POST['relai'] .'")';
							$pdo->exec($sql);
							if ($debug == "yes") {$test=shell_exec('say "Base mise à jour à 1"');} /* Debug */
							
						} elseif ($data['rel_state'] == "1") {
							$radio=shell_exec('./radioEmission '. $data['rel_pin'] .' '. $data['rel_tel'] .' '. $data['rel_rec'] .' off');
							
							$state = 0;
							$sql = 'UPDATE `alf_rel` SET `rel_state`= ("'.$state.'") WHERE `rel_id`= ("'. $_POST['relai'] .'")';
							$pdo->exec($sql);
							if ($debug == "yes") {$test=shell_exec('say "Base mise à jour à 0"');} /* Debug */
						}					
					// Mode Impulsion
					} elseif ($data['rel_time'] == 'impulsion') {
						$radio=shell_exec('./radioEmission '. $data['rel_pin'] .' '. $data['rel_tel'] .' '. $data['rel_rec'] .' on');
						
						sleep($data['rel_freq']);
						
						$radio=shell_exec('./radioEmission '. $data['rel_pin'] .' '. $data['rel_tel'] .' '. $data['rel_rec'] .' off');
					}
				}
			} elseif ($data['rel_relai'] == 'cmd') {
			//##################################################################
			
			//#           Executer une commande ou script en local
			
			//##################################################################
				if ($debug == "yes") {$test=shell_exec('say command');}
				
				if ($activated == "yes") {
					$radio=shell_exec(''. $data['rel_cmd'] .'');	
				}
			} elseif ($data['rel_relai'] == 'rfilaire') {
			//##################################################################
			
			//#                   Relai filaire en remote
			
			//##################################################################
				if ($debug == "yes") {$test=shell_exec('say "remote filaire"');} /* Debug */
				
				if ($activated == "yes") {
					
					$connection = ssh2_connect(''. $data['rel_ip'] .'', $data['rel_port']);
                    ssh2_auth_password($connection, ''. $data['rel_login'] .'', ''. $data['rel_password'] .'');
					$stream = ssh2_exec($connection, 'gpio mode '. $data['rel_pin'] .' out');

					// Mode On/Off
					if ($data['rel_time'] == 'normal') {
						
						if ($data['rel_state'] == "0") {
							$stream = ssh2_exec($connection, 'gpio write '. $data['rel_pin'] .' 1');
							
							$state = 1;
							$sql = 'UPDATE `alf_rel` SET `rel_state`= ("'.$state.'") WHERE `rel_id`= ("'. $_POST['relai'] .'")';
							$pdo->exec($sql);
							if ($debug == "yes") {$test=shell_exec('say "Base mise à jour à 1"');} /* Debug */
							
						} elseif ($data['rel_state'] == "1") {
							$stream = ssh2_exec($connection, 'gpio write '. $data['rel_pin'] .' 0');
							
							$state = 0;
							$sql = 'UPDATE `alf_rel` SET `rel_state`= ("'.$state.'") WHERE `rel_id`= ("'. $_POST['relai'] .'")';
							$pdo->exec($sql);
							if ($debug == "yes") {$test=shell_exec('say "Base mise à jour à 0"');} /* Debug */
						}					
					// Mode Impulsion
					} elseif ($data['rel_time'] == 'impulsion') {
					
						$stream = ssh2_exec($connection, 'gpio write '. $data['rel_pin'] .' 1');

                        sleep($data['rel_freq']);

                        $stream = ssh2_exec($connection, 'gpio write '. $data['rel_pin'] .' 0');
					}
				}
			} elseif ($data['rel_relai'] == 'rradio') {
			//##################################################################
			
			//#                   Relai radio en remote
			
			//##################################################################
				if ($debug == "yes") {$test=shell_exec('say "remote radio"');} /* Debug */
				
				if ($activated == "yes") {
					
					$connection = ssh2_connect(''. $data['rel_ip'] .'', $data['rel_port']);
                    ssh2_auth_password($connection, ''. $data['rel_login'] .'', ''. $data['rel_password'] .'');
					$stream = ssh2_exec($connection, 'gpio mode '. $data['rel_pin'] .' out');
					
					// Mode On/Off
					if ($data['rel_time'] == 'normal') {
						
						if ($data['rel_state'] == "0") {
							$stream = ssh2_exec($connection, './radioEmission '. $data['rel_pin'] .' '. $data['rel_tel'] .' '. $data['rel_rec'] .' on');
							
							$state = 1;
							$sql = 'UPDATE `alf_rel` SET `rel_state`= ("'.$state.'") WHERE `rel_id`= ("'. $_POST['relai'] .'")';
							$pdo->exec($sql);
							if ($debug == "yes") {$test=shell_exec('say "Base mise à jour à 1"');} /* Debug */
							
						} elseif ($data['rel_state'] == "1") {
							$stream = ssh2_exec($connection, './radioEmission '. $data['rel_pin'] .' '. $data['rel_tel'] .' '. $data['rel_rec'] .' off');
							
							$state = 0;
							$sql = 'UPDATE `alf_rel` SET `rel_state`= ("'.$state.'") WHERE `rel_id`= ("'. $_POST['relai'] .'")';
							$pdo->exec($sql);
							if ($debug == "yes") {$test=shell_exec('say "base mise à jour à 0"');} /* Debug */
						}					
					// Mode Impulsion
					} elseif ($data['rel_time'] == 'impulsion') {
						$stream = ssh2_exec($connection, './radioEmission '. $data['rel_pin'] .' '. $data['rel_tel'] .' '. $data['rel_rec'] .' on');
						
						sleep($data['rel_freq']);
						
						$stream = ssh2_exec($connection, './radioEmission '. $data['rel_pin'] .' '. $data['rel_tel'] .' '. $data['rel_rec'] .' off');
					}
				}
			} elseif ($data['rel_relai'] == 'rcmd') {
			//##################################################################
			
			//#            Executer une commande ou script en remote
			
			//##################################################################
				if ($debug == "yes") {$test=shell_exec('say "remote command"');} /* Debug */
				
				$connection = ssh2_connect(''. $data['rel_ip'] .'', $data['rel_port']);
				ssh2_auth_password($connection, ''. $data['rel_login'] .'', ''. $data['rel_password'] .'');
				$stream = ssh2_exec($connection, ''. $data['rel_cmd'] .'');
			}
		}
	}
 ?>












