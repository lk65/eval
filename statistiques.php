<?php
session_start();
require_once('injections/connexion.php');

   $sql = "SELECT * FROM etudiant";
   $etudiant=$bdd->query($sql);
   echo "<table>";

   while($etu = $etudiant->fetch()){ 
      echo "<tr>";
       echo "<td>".$etu['nom']."</td>";
       echo "<td>".$etu['prenom']."</td>";
       echo "<td>".$etu['email']."</td>";
       echo '<td class="flex">
      		<a class="bouton modifier" href="read.php?id='.$etu["id_etudiant"].'">Voir</a>
                    </td>';
       echo "</tr>";

   }

    echo "</table>";

?>

<a href ="add.php"> Ajouter une note </a>