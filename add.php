<?php
session_start();

require_once('injections/connexion.php');

if(!empty($_POST["nom"]) && !empty($_POST["matiere"]) && !empty($_POST["note"])){
	$sql = "INSERT INTO etudiant (nom,id_matiere,id_note) VALUES (:nom,:matiere,:note)";
	$insert = $bdd->prepare($sql);
	$insert->execute(array(
             "nom"=>$_POST["nom"],
             "matiere"=>$_POST["matiere"],
             "note"=>$_POST["note"]
 ));
}
?> 

<h1> Saisie d'une note </h1>

<form action="" method="post" class="form">
<?php
   $sql = "SELECT * FROM etudiant;";
   $etudiant=$bdd->query($sql);
   echo "<select name='nom'>";
   while($etu = $etudiant->fetch()){ 

       echo "<option value='".$etu['id_etudiant']."'>".$etu['nom']."</option>";

   } 
echo " </select>";
?>


<?php
   $sql = "SELECT * FROM matiere";
   $matiere=$bdd->query($sql);
   echo "<select name='matiere'>";
   while($mat = $matiere->fetch()){ 
       echo "<option value='".$mat['id_matiere']."'>".$mat['nom_matiere']."</option>";
   } 
echo " </select>";
?>


<?php
   $sql = "SELECT * FROM note";
   $note=$bdd->query($sql);
   echo "<select name='note'>";
   while($notation = $note->fetch()){ 
       echo "<option value='".$notation['id_note']."'>".$notation['note']."</option>";
   } 
   echo " </select>";
?>
    <input type="submit" class="submit" value="Envoyer">
</form>