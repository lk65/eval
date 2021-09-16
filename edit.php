<?php

session_start();
require_once('injections/connexion.php');


if(isset($_GET['id']) AND !empty($_GET['id'])) {   // On vérifie si l'id existe et n'est pas vide

   $getid = htmlspecialchars($_GET['id']);   // On sécurise l'identifiant
   $etudiant = $bdd->prepare('SELECT * FROM etudiant INNER JOIN note ON etudiant.id_note = note.id_note 
   INNER JOIN matiere ON etudiant.id_matiere = matiere.id_matiere
    WHERE id_etudiant = ?');  // On sélectionne toutes les infos de l'article en fonction de son id
   $etudiant->execute(array($getid));   // On exécute la requête en faisant un tableau avec l'id
   $etudiant = $etudiant->fetch();    // On récupère les données avec un fetch



   $edit 
   echo "<h1>".$etudiant['nom']." ".$etudiant['prenom']."</h1>";
   echo "<p> aura obtenu un ".$etudiant['note']." en ".$etudiant['nom_matiere']."</p>";
   echo "<h2> Modification </h2>";

   echo "<form class='form' action='' method='post'>";
   

   $sql2 = "SELECT * FROM matiere";
   $matiere=$bdd->query($sql2);
   echo "<select>";
   while($mat = $matiere->fetch()){ 
       echo "<option value='".$mat['id_matiere']."'>".$mat['nom_matiere']."</option>";
   } 
	echo " </select>";


   $sql3 = "SELECT * FROM note";
   $note=$bdd->query($sql3);
   echo "<select>";
   while($notation = $note->fetch()){ 
       echo "<option value='".$notation['id_note']."'>".$notation['note']."</option>";
   } 
   echo " </select>";


   echo "<input class='bouton' type='submit'>";
   echo "</form>";

       }
?>