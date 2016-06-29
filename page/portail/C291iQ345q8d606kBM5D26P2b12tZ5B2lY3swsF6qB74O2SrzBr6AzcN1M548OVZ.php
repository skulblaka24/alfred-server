<?php
?>
<html>
<head>
<title>Portail</title>
<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
<link href="css/index.css" rel="stylesheet" media="screen">

</head>

<body>
<!-- Titre -->
<div class="titre">
 <!--<strong><span class="orange">P</span><span class="bleu">O</span><span class="rose">R</span><span class="vert">T</span><span class="deux">A</span>I<span class="zero">L</span></strong>-->
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
												<input id="fermer" class="" type="submit" name="fermer" value="">

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