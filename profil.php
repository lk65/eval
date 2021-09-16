<?php
session_start();
 
require_once('injections/connexion.php');
 
if(isset($_SESSION['id_professeur']) AND $_SESSION['id_professeur'] > 0) {
   $getid = intval($_SESSION['id_professeur']);
   $requser = $bdd->prepare('SELECT * FROM professeur WHERE id_professeur = ?');
   $requser->execute(array($getid));
   $userinfo = $requser->fetch();
?>
<html>
   <head>
      <title>Mon profil</title>
      <meta charset="utf-8">
   </head>
   <body>


      <h1 class="profil">Profil de <?php echo $userinfo['prenom']; ?></h1>
      <br/>

      <a href="statistiques.php"> Statistiques </a>

      <!--  SI LE PROPRIÉTAIRE DU COMPTE ACCEDE A SON PROPRE PROFIL... -->
      <?php
      if(isset($_SESSION['id_professeur']) AND $userinfo['id_professeur'] == $_SESSION['id_professeur']) {
      ?>

      <!-- ALORS IL AURA DEUX BOUTONS POUR ÉDITER ET SE DÉCONNECTER -->
      <div class="bouton-container">
         <a class="bouton" href="editionprofil.php">Modifier</a>
         <a class="bouton" href="deconnexion.php">Déconnexion</a>
      </div>

      <?php
      }  // On ferme notre fonction PHP ici
      ?>

<?php
   $sql = "SELECT nom,prenom FROM etudiant;";
   $etudiant=$bdd->query($sql);
   echo "<select>";
   while($etu = $etudiant->fetch()){ 

       echo "<option value='".$etu['id_etudiant']."'>".$etu['nom']." ".$etu['prenom']."</option>";

   } 
echo " </select>";
?>


<?php
   $sql = "SELECT id_matiere, nom FROM matiere";
   $matiere=$bdd->query($sql);
   echo "<select>";
   while($mat = $matiere->fetch()){ 
       echo "<option value='".$mat['id_matiere']."'>".$mat['nom']."</option>";
   } 
echo " </select>";
?>


<?php
   $sql = "SELECT * FROM note";
   $note=$bdd->query($sql);
   echo "<select>";
   while($notation = $note->fetch()){ 
       echo "<option value='".$notation['id_note']."'>".$notation['note']."</option>";
   } 
   echo " </select>";
?>
   </body>
</html>

<?php   
} else { echo " Vous n'êtes pas connecté et donc n'êtes pas autorisé à consulter cette page.";} // On ferme notre fonction PHP créée ligne 6, qui englobe toute la page
?>