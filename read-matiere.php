<?php

session_start();
require_once('injections/connexion.php');

if(isset($_GET['id']) AND !empty($_GET['id'])) {   // On vérifie si l'id existe et n'est pas vide

   $getid = htmlspecialchars($_GET['id']);   // On sécurise l'identifiant
   $matiere = $bdd->prepare('SELECT nom_matiere, note FROM matiere INNER JOIN note on matiere.id_note = note.id_note
    WHERE id_matiere = ?');  // On sélectionne toutes les infos de l'article en fonction de son id
   $matiere->execute(array($getid));   // On exécute la requête en faisant un tableau avec l'id
   $matiere = $matiere->fetch();    // On récupère les données avec un fetch


       echo "<p>La matiere ".$matiere['nom_matiere']." possede la note ".$matiere['note']."  </p>";

       echo '
            <a class="bouton modifier" href="matiere-edit.php?id='.$matiere["id_matiere"].'">Modifier</a>
            <a class="bouton supprimer" href="matiere-delete.php?id='.$matiere["id_matiere"].'" onclick="return confirm(`Voulez-vous vraiment supprimer cette recette ?`);">Supprimer</a>
                    ';
       }