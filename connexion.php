<?php 
session_start();

$bdd = new PDO('mysql:host=localhost;dbname=livreor', 'root', '');

if(isset($_POST['formconnexion'])){
    $loginconnect = htmlspecialchars($_POST['login']);
    $passwordconnect = sha1($_POST['password']);

    if(!empty($loginconnect) AND !empty($passwordconnect)){
        $requser = $bdd ->prepare("SELECT * FROM utilisateurs WHERE login = ? AND password = ?");
        $requser ->execute(array($loginconnect, $passwordconnect));
        $userexist = $requser->rowCount();

        if($userexist == 1){
            $userinfo = $requser->fetch();
            $_SESSION['id'] = $userinfo['id'];
            $_SESSION['login'] = $userinfo['login'];
            $_SESSION['password'] = $userinfo['password'];
            header("Location: profil.php?id=".$_SESSION['id']);
        } else{
            $erreur = "mauvais mail ou mot de passe ! ";
        }
    } else{
        $erreur = "Tout les champs doivent être complétés ! ";
    }
}

?>




<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="inscription_connexion.css">
    <link rel="stylesheet" href="nav_footer.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://kit.fontawesome.com/6f0632ca8c.js"> </script>
    <title>Inscription</title>
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

<form class="form_" method="POST" action="connexion.php">

<legend>Connexion</legend><br><br>


<input type="text" name="login" placeholder="login"  /><br><br>


<input type="password" name="password" placeholder="password" id="password" /><br>
<br>
<br><br><br>

<button type="submit" name="formconnexion" class="button_">Se connecter</button><br><br>

<?php
         if(isset($erreur)) {
            echo '<font color="brown"><center>'.$erreur."</center></font>";
         }
         ?>

</form><br>

</div>

</article>



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