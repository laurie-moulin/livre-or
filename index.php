<?php
session_start();

?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="nav_footer.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://kit.fontawesome.com/6f0632ca8c.js"> </script>
    <title>Accueil</title>
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

<h1>FOCUS</h1>

<img src="ressources/logo.png" alt="logo">



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