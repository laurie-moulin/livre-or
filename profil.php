<?php 

session_start();
 
$bdd = new PDO('mysql:host=localhost;dbname=livreor', 'root', 'root');

if(isset($_SESSION['id'])) {  
  $requser = $bdd->prepare("SELECT * FROM utilisateurs WHERE id = ?");
  $requser->execute(array($_SESSION['id']));
  $user = $requser->fetch();

  if(isset($_POST['formprofil'])){
    $valid = true;
    $login = htmlspecialchars($_POST['newlogin']);
    $mdp1 = sha1($_POST['newmdp1']);
    $mdp2 = sha1($_POST['newmdp2']);

    if(empty($login)){
    $valid = false;
    $msg = "Il faut mettre un login";
    }
    else{
      $reqlogin = $bdd->prepare("SELECT * FROM utilisateurs WHERE login = ?");
      $reqlogin->execute(array($login));
      $loginexist = $reqlogin->rowCount();

      if($loginexist == 1 AND $_POST['newlogin'] != $user['login']) {
        $valid = false;
        $msg = "Le login existe déjà";
      }
    }

    if(empty($mdp1 AND $mdp2)){
      $valid = false;
      $msg = "veuillez entrer les mdp";
    }
    elseif($mdp1 != $mdp2){
      $valid = false;
      $msg = "mdp ne correspodnent pas";
    }
    if($valid){
    $insertmdp = $bdd->prepare("UPDATE utilisateurs SET login = ? , password = ? WHERE id = ?");
    $insertmdp->execute(array($login, $mdp1, $_SESSION['id'])); 
    header("location : profil.php");
  }

  }
}
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="profil.css">
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

<form class="form_" method="POST" action="profil.php">

<legend>Bonjour <?php echo $user['login']; ?> ! </legend><br><br>

<label>Login :</label><br>
<input type="text" name="newlogin" placeholder="login"  value="<?php echo $user['login']; ?>" /><br><br>

<label>Mot de passe :</label><br>
<input type="password" name="newmdp1" placeholder="password" id="password" /><br>
<br>
<label>Confirmation - mot de passe :</label><br>
<input type="password" name="newmdp2" placeholder="Confirmation du mot de passe" />
<br><br><br>

<button type="submit" name="formprofil" class="button_">Modifier votre profil</button><br><br>

<?php
         if(isset($msg)) {
            echo '<font color="red"><center>'.$msg."</center></font>";
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