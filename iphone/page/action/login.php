<?php

//!\ Checkage du mdp a faire le hasher 3X avec sha1 sha2 et hash et concatener un generic /!\

if(empty($_SESSION['username']))
	{
		$pseudoCookie = (isset($_COOKIE['username'])) ? $_COOKIE['username'] : 'visiteur';
		//$mdp = (isset($_COOKIE['mdp'])) ? $_COOKIE['mdp'] : '';

		if ($pseudoCookie !="visiteur" && $pseudoCookie !="")
		{
		    //=== il est dejas logue sans session on lui crée
		    // mais avant on controle dans Mysql si mdp==OK
		    $pseudo = $pseudoCookie;
		    $_SESSION['username']=$pseudoCookie;

		} else if ($pseudoCookie == "visiteur") {
			header('location:../../logout.php');
		}
	}
?>