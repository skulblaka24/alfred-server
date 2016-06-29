<?php 
	/* #####################################################################
   #
   #   Project       : Alfred
   #   Author        : Gauthier Donikian
   #   Version       : 2.0
   #   Commentaire   :
   #
   ##################################################################### */

        //Démarrage de la session
        session_start();
        include ("action/login.php");

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
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=0">


    <link rel="shortcut icon" type="image/png" href="../img/favicon.ico" />
    <link rel="stylesheet" type="text/css" href="../css/annexe/bootstrap.css">
    <link rel='stylesheet' href='../css/annexe/animate.css' />

    <link href="../css/main/portail.css" rel="stylesheet">
    <link rel="apple-touch-icon" sizes="180x180" href="../img/portail_icon.png">

    <script src="../js/annexe/jquery-2.1.0.min.js"></script>
    <script src="../js/annexe/bootstrap.js"></script>
    <script type="text/javascript" src="../js/main/portail.js"></script>

    <title>Portail - Alfred Server</title>
</head>

<body>
<div class="page-container">
    
    <!-- Navigation Bloc -->
    <div class="page">
        <div id="b-nav" class="bloc-container bgc-grey">
            <div id="bloc-nav" class="d-mode">
                <div class="bloc d-bloc" id="nav-bloc">
                    <div class="container bloc-sm">
                        <nav class="navbar row">
                            <div class="navbar-header">
                                <div class="navbar-pro">
                                    <img src="../img/users/<?php echo $_SESSION['username'];?>.jpg" class="img-responsive img-circle nav-link" width="30" height="30" />
                                </div>
                                <div class="navbar-img">
                                    <img src="../img/portail.png" class="title_img" width="40" height="40" />
                                    <h5 class="title">
                                        <i class="ft-white">Portail Control</i>
                                    </h5>
                                </div>
                                <button id="nav-toggle" type="button" class="ui-navbar-toggle navbar-toggle" data-toggle="collapse" data-target=".navbar-1">
                                    <span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
                                </button>
                            </div>
                            <div class="collapse navbar-collapse navbar-1">
                                <ul class="site-navigation nav navbar-nav">
                                    <li>
                                        <a href="dashboard.php" class="nav-link">Dashboard</a>
                                    </li>
                                    <li>
                                        <a href="control_center.php" class="nav-link">Control Center</a>
                                    </li>
                                    <li>
                                        <a href="portail.php" class="nav-link">Portail</a>
                                    </li>
                                    <li>
                                        <a href="../logout.php" class="nav-link">Logout</a>
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
        <div class="bloc l-bloc pbloc-all bg-fond" id="bloc-2">
            <div class="container bloc-lg pbloc-btn">
                    
                <div class="cadre_btn">
                    <div class="row">
                        <form id="form" action="./action/portail_op.php" method="POST" name="addsql_e">
                            <input id="connexion" class="btn-wire btn btn-xl wire-btn-red-pigment animated fadeIn animDelay02" type="submit" name="connexion" value="Ouvrir le portail">
                            <input id="ouvert" class="btn-wire btn btn-xl wire-btn-red-pigment animated fadeIn animDelay02" type="submit" name="ouvert" value="Garder le portail ouvert">
                        </form> 
                    </div>     
                </div>
                <div id="sign_div">
                    <p class="sign_bar ft-white">
                        _______________________________________
                    </p>
                    <h5 id="sign_text"><i class="ft-white" id="sign_text_i">Alfred's domotique server / Made by Gauthier Donikian</i></h5>
                </div>

            </div>
        </div>
        <!-- bloc-2 END -->
    </div>
</div>
<!-- Main container END -->


</body>
</html>
<script type="text/javascript">
        $(document).ready(function(){

                $('#addSqlLine').click(function(){
                        document.addsql_e.submit();
                });
        })
</script>