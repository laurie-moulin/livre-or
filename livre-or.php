<?php
session_start();

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="commentaire.css">
    <link rel="stylesheet" href="nav_footer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://kit.fontawesome.com/6f0632ca8c.js"> </script>
    <title>Livre d'or</title>
</head>

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

<h1>Livre d'or</h1>

<?php
if(isset($_SESSION['id'])){ ?>
  <a href="commentaire.php?id=" <?php $_SESSION['id'] ?> >Laisser un commentaire</a><br><br>
  <?php }  else { ?>
      <a href='connexion.php'>Se connecter pour pouvoir laisser un commentaire </a><br><br>
        <?php } ?>

<?php

$bdd = new PDO('mysql:host=localhost;dbname=livreor', 'root', 'root');


$data = $bdd->prepare('SELECT commentaire, login as "utilisateur",date as "posté le jour/mois/année"  FROM commentaires INNER JOIN utilisateurs ON commentaires.id_utilisateur = utilisateurs.id ORDER BY date DESC');
$data->execute();


$i=0;

echo "<div class=\"table\"><table>" ;
while ($result = $data-> fetch(PDO::FETCH_ASSOC)){
  if ($i == 0){
    foreach ($result as $key => $value){
      echo "<th class=\"key\">$key</th>";
    }
    $i++;
  }
  echo "<tr>";
  foreach ($result as $key => $value) {
    if ($key == "posté le jour/mois/année"){
      date_default_timezone_set('Europe/Paris');
      $value =  date("d-m-Y", strtotime($value));  ;
    echo "<td>$value</td>";
    }
    else
      echo "<td>" .nl2br($value). "</td>";
  }
  echo "</tr>";
}

echo "</div></table><br><br>";

?>


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

</html>

<?php $bdd = null ?>