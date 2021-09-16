<?php
 // Connexion à la BDD avec PDO try et catch (à enlever quand on passe en prod)
 try{
     //Connexion à la base
     $bdd = new PDO('mysql:host=mysql-loickissling.alwaysdata.net; dbname=loickissling_db', '243024', 'lk65000lk');
     //On définit UTF8 comme étape de caractère
     $bdd->exec('SET NAMES "UTF8"');
 } catch (PDOException $e){
     echo 'Erreur : ' . $e->getMessage();
     die();
 }
 ?>