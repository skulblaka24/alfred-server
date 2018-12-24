<?php 
	session_start();
	session_destroy();
	setCookie('username',$username,(time()-60*60*24*365)); // 1 an
 	setCookie('motdepassecrypte',hash(sha1, $password),(time()-60*60*24*365));
	header('location: ./index.php');
 ?>