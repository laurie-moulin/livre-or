<?php
session_start();

$bdd = new PDO('mysql:host=localhost;dbname=livreor', 'root', 'root');

if(isset($_SESSION['id'])) {   
    $requser = $bdd->prepare("SELECT * FROM utilisateurs WHERE login = ?");
    $requser->execute(array($_SESSION['login']));
    $user = $requser->fetch();

    if(isset($_POST['formcom'])){
        $commentaire = $_POST['commentaire'];

        if(isset($commentaire)){
            date_default_timezone_set('Europe/Paris');
            $date = date("Y-m-d");
            $insertcomm = $bdd->prepare("INSERT INTO commentaires(commentaire, id_utilisateur, date) VALUES(?, ?, ?)");
            $insertcomm->execute(array($commentaire, $_SESSION['id'], $date));

        }
    }

}    
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="commentaire.css">
    <link rel="stylesheet" href="nav_footer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://kit.fontawesome.com/6f0632ca8c.js"> </script>
    <title>Commentaire</title>
</head>
<body>

<header>

<nav class=navprofil>
        <a href="index.php">Accueil</a>
        <a href="#">Galerie</a>
        <a href="livre-or.php">Livre d'or</a>
        <?php if (isset($_SESSION['id'] )) {?> 
         <a href="profil.php?id=" <?php $_SESSION['id'] ?> >Profil</a>
          <?php }  else { ?>
         <a href='inscription.php'>Inscription</a>
          <?php } ?>
        <?php if (isset($_SESSION['id'] )) {?> 
          <a href="deconnexion.php">Deconnexion</a>
          <?php }  else { ?>
        <a href="connexion.php">Connexion</a>
          <?php } ?> 
</nav>

</header>

<main>

<article class="container">

<div class="container_title">

<h1>FOCUS</h1>

<img src="ressources/logo.png" alt="logo">

</div>

<div class="container_form">

<form class="form_" method="POST" action="commentaire.php">

<legend>Commentaire</legend><br><br>

<label>Laisser un commentaire dans le livre d'or : </label><br><br>
<textarea id="description" name="commentaire" rows="8" cols="60"></textarea><br><br>


<button type="submit" name="formcom" class="button_">Laisser un commentaire</button><br><br>

</div>

          </main>

<footer>


<div class="menu">
  <input type="checkbox" id="toggle" />
  <label id="show-menu" for="toggle">
    <div class="btn">
    <i class="fas fa-hashtag"></i>
    <i class="fas fa-times"></i>
    </div>
    <div class="btn">
    <a>
    <i class="fab fa-linkedin-in" ></i>
   </a>
    </div>
    <div class="btn">
    <a>
    <i class="fab fa-facebook-f"></i></a>
    </div>
    <div class="btn">
    <a>
    <i class="fab fa-instagram"></i></a>
    </div>
    <div class="btn">
    <a>
    <i class="fab fa-twitter"></i></a>
    </div>
    <div class="btn">
    <a>
    <i class="far fa-envelope"></i></a>
    </div>
    <div class="btn">
    <a>
    <i class="fas fa-phone"></i></a>
    </div>
  </label>
</div>


</footer>
    
</body>
</html>