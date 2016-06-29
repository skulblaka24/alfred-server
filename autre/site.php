<?php
/*

Page en curl pour récupérer le contenu d'une autre
le problème avec une iframe, c'est que les liens ne suivent pas, donc il faut 
parser la variable $output et remplacer tout les liens de la page par ceux 
de ce fichier pour que l'iframe suives correctement.



*/


    $header = NULL;
    $cookie = NULL;    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_HEADER, $header);
    curl_setopt($ch, CURLOPT_NOBODY, $header);
    curl_setopt($ch, CURLOPT_URL, "http://www.facebook.com");
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_COOKIE, $cookie);
    curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_COOKIEFILE, dirname(__FILE__). '/cookies.txt');
    curl_setopt($ch, CURLOPT_COOKIEJAR, dirname(__FILE__) . '/cookies.txt'); //save cookies here
    curl_setopt($ch, CURLOPT_REFERER, "http://www.facebook.com"); // you don't need that line; it's just the referer
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);;
    $output = curl_exec($ch);
    curl_close($ch);
    //echo '<script>alert("a");</script>';
    echo $output;

?>