<?php
session_start();
 
require_once('injections/connexion.php');
 
if(isset($_POST['formconnexion'])) {
   $mailconnect = htmlspecialchars($_POST['mailconnect']);
   $mdpconnect = sha1($_POST['mdpconnect']);
   if(!empty($mailconnect) AND !empty($mdpconnect)) {
      $requser = $bdd->prepare("SELECT * FROM professeur WHERE email = ? AND mot_de_passe = ?");
      $requser->execute(array($mailconnect, $mdpconnect));
      $userexist = $requser->rowCount();
      if($userexist == 1) {
         $userinfo = $requser->fetch();
         $_SESSION['id_professeur'] = $userinfo['id_professeur'];
         $_SESSION['nom'] = $userinfo['nom'];
         $_SESSION['prenom'] = $userinfo['prenom'];
         $_SESSION['email'] = $userinfo['email'];
         header("Location: profil.php?id=".$_SESSION['id_professeur']);
      } else {
         $erreur = "Mauvais mail ou mot de passe !";
      }
   } else {
      $erreur = "Tous les champs doivent être complétés !";
   }
}
?>
<html>
   <head>
      <title>Connexion</title>
      <meta charset="utf-8">
      <link rel="stylesheet" type="text/css" href="../css/nav.css">
      <link rel="stylesheet" type="text/css" href="../css/form.css">
      <link rel="stylesheet" type="text/css" href="../css/footer.css">
      <meta name="viewport" content="width=device-width, initial-scale=1"> 
   </head>

   <body>   


      <p class="erreur"><?php if(isset($erreur)){echo $erreur;}?></p>

      <form class="form" method="POST" action="">
         <h1>Connexion</h1>
         <div class="liseret"></div>
         <input class="input" type="email" name="mailconnect" placeholder="Mail" />
         <input class="input" type="password" name="mdpconnect" placeholder="Mot de passe" />
         <input class="button" type="submit" name="formconnexion" value="Se connecter !" />
         <p class="phrase"> Vous n'avez pas de compte ? <a href="inscription.php"> S'inscrire</a></p>
      </form>

   </body>
</html>