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


       echo "<p>L'élève ".$etudiant['prenom']." ".$etudiant['nom']." a obtenu la note ".$etudiant['note']." dans la matière ".$etudiant['nom_matiere']." </p>";

       echo '
            <a class="bouton modifier" href="edit.php?id='.$etudiant["id_etudiant"].'">Modifier</a>
            <a class="bouton supprimer" href="delete.php?id='.$etudiant["id_etudiant"].'" onclick="return confirm(`Voulez-vous vraiment supprimer cette recette ?`);">Supprimer</a>
                    ';
       }
?>