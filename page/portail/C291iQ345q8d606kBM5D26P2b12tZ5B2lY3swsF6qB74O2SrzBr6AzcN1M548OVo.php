<?php
if (isset($_POST['connexion'])) {

                header('Location: C291iQ345q8d606kBM5D26P2b12tZ5B2lY3swsF6qB74O2SrzBr6AzcN1M548OVo.php');
        
        $connection = ssh2_connect('192.168.1.6', 3004);
                                        ssh2_auth_password($connection, 'AlfredP24', 'Skulblaka24');

                                        $stream = ssh2_exec($connection, 'gpio mode 1 out');

                                        $stream = ssh2_exec($connection, 'gpio write 1 1');

                                        sleep(1);

                                        $stream = ssh2_exec($connection, 'gpio write 1 0');


}
if (isset($_POST['ouvert'])) {
                
                header('Location: C291iQ345q8d606kBM5D26P2b12tZ5B2lY3swsF6qB74O2SrzBr6AzcN1M548OVZ.php');

                $connection = ssh2_connect('192.168.1.6', 3004);
                                        ssh2_auth_password($connection, 'AlfredP24', 'Skulblaka24');

                                        $stream = ssh2_exec($connection, 'gpio mode 1 out');

                                        $stream = ssh2_exec($connection, 'gpio write 1 1');
                                        
                                                                                
                                                                                
}
if (isset($_POST['fermer'])) {
                
                header('Location: C291iQ345q8d606kBM5D26P2b12tZ5B2lY3swsF6qB74O2SrzBr6AzcN1M548OVo.php');

                $connection = ssh2_connect('192.168.1.6', 3004);
                                        ssh2_auth_password($connection, 'AlfredP24', 'Skulblaka24');

                                        $stream = ssh2_exec($connection, 'gpio mode 1 out');

                                        $stream = ssh2_exec($connection, 'gpio write 1 0');
                                        
                                                                                
}

?>
<html>
<head>
<title>Portail</title>
<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
<link href="css/index.css" rel="stylesheet" media="screen">

<link rel="apple-touch-icon" sizes="180x180" href="http://zupimages.net/up/16/07/jl6e.png">


</head>

<body>
<!-- Titre -->
<div class="titre">
<img src="./img/house.png" id="house">

</div>  

<div class="cadre_arrondi">
                         
                        <div class="hg"></div>
                        <div class="haut"></div>
                        <div class="hd"></div>                      
                        <div class="gauche"></div>

                        <!--Contenu du cadre -->
                        <!--<div class="contenu"><div id="" class="row" text-align:"center"><p>Connexion &agrave; l'espace membre :<br /></p></div>-->
                        <div class="contenu"><div id="" class="row" text-align:"center"></div>


                                <div class="row"><span>
                                <form id="form" action="C291iQ345q8d606kBM5D26P2b12tZ5B2lY3swsF6qB74O2SrzBr6AzcN1M548OVo.php" method="post">
                                <input id="connexion" class="" type="submit" name="connexion" value="">
                                <input id="ouvert" class="" type="submit" name="ouvert" value="">

                                </form>
                                <?php
                                if (isset($erreur)) echo '<br /><br />',$erreur;
                                ?></span></div></div>


                        <div class="droite"></div>
                         
                        <div class="bg"></div>
                        <div class="bas"></div>
                        <div class="bd"></div>
                 
</div>



</body>
</html>