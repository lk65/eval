<?php

// Connexion à la database
require_once('injections/connexion.php');

// Si l'on clique sur le bouton d'inscription
if(isset($_POST['forminscription']))
{
	// On sécurise les données
	$nom = htmlspecialchars($_POST['nom']);
	$prenom = htmlspecialchars($_POST['prenom']); 
	$mail = htmlspecialchars($_POST['mail']);
	$mail2 = htmlspecialchars($_POST['mail2']);
	$mdp = sha1($_POST['mdp']);						// on va crypter le mot de passe
	$mdp2 = sha1($_POST['mdp2']);


	// Si ces valeurs ne sont pas vides
	if(!empty($_POST['nom']) AND !empty($_POST['prenom']) AND !empty($_POST['mail']) AND !empty($_POST['mail2']) AND !empty($_POST['mdp']) AND !empty($_POST['mdp2']))
	{
		// $pseudolength = strlen($pseudo);	// On vérifie la longueur du pseudo
		// if($pseudolength <= 255)		
		// {
			$nomlength = strlen($nom);
			if($nomlength <= 30)
			{	
				$prenomlength = strlen($prenom);
				if($prenomlength <= 30)
				{					
					if($mail == $mail2)		// Si les deux mails sont identiques
					{
						if(filter_var($mail, FILTER_VALIDATE_EMAIL))	
						{
							$reqmail = $bdd->prepare("SELECT * FROM cuisto WHERE mail = ?");	// On vérifie si l'email a déjà été utilisé
							$reqmail->execute(array($mail));
							$mailexist = $reqmail->rowCount();
							if($mailexist == 0)		// Si le mail n'a pas été utilisé
							{
								if($mdp == $mdp2)	// Alors on vérifie si les 2 mot de passe sont identiques.
								{
									$insertmbr = $bdd->prepare("INSERT INTO professeur(nom,prenom,email,mot_de_passe) VALUES (?,?,?,?)");
									$insertmbr->execute(array($nom, $prenom, $mail, $mdp));
									$success = " Votre compte a bien été créé";
									// Si les deux mots de passe sont identiques, on crée le compte grâce à une requête préparée
								}
								else
								{
									$erreur = "Vos mots de passe ne correspondant pas";
								}
							}
							else
							{
								$erreur = "Le mail est déjà utilisé";
							}
						}
						else
						{
							$erreur = "Votre adresse mail n'est pas valide";
						}
					}
					else
					{
						$erreur = "Vos adresses mail ne correspondent pas";
					}
				}
				else
				{
					$erreur = "Votre prénom ne doit pas dépasser 30 caractères";
				}
			}
			else
			{
				$erreur = "Votre nom ne doit pas dépasser 30 caractères";
			}
		// }
		// else
		// {
		// 	$erreur = "Votre pseudo ne doit pas dépasser 255 caractères";
		// }
	}
	else 
	{
		$erreur = "Tous les champs doivent être complétés !";
	}

	$nom = $prenom = $mail = $mail2 = $mdp = $mdp2 = NULL;
    unset($_POST);
}

?>
<html>
<head>
	<title>Inscription </title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/form.css">
	<meta name="viewport" content="width=device-width, initial-scale=1"> 
</head>
<body>

	<p class="erreur"><?php if(isset($erreur)){echo '<font color="red">'.$erreur.'</font>';}?></p>
	<p class="success">	<?php if(isset($success)){echo '<font color="green">'.$success.'</font>';}?></p>

	<form class="form" method="post" onsubmit="return validate(this);">
		<h1>Inscription</h1>
		<input class="input" type="text" placeholder="Nom" name="nom"/>
		<input class="input" type="text" placeholder="Prénom" name="prenom"/>
		<input class="input" type="email" placeholder="E-mail" name="mail"/>
		<input class="input" type="email" placeholder="Confirmation de l'E-mail " name="mail2"/>
		<input class="input" type="password" placeholder="Mot de passe" name="mdp"/>
		<input class="input" type="password" placeholder="Confirmation du mot de passe" name="mdp2"/>

		<input class="button" type="submit" value="Valider" name="forminscription" />
		<p class="phrase"> Vous avez déjà un compte ? <a href="connexion.php"> Se connecter</a></p>
	</form>

   <script type="text/javascript">
	   	function validate(form) {
	  		var re = /^[a-z,A-Z]+$/i;		// On déclare une variable, sa valeur signifie " on ne veut que des caractères, aucun chiffre."

		  if (!re.test(form.nom.value)) {		// Si l'utilisateur entre des chiffres dans le champ nom, alors
		    alert('Votre nom ne doit pas contenir de chiffres ni de caractères spéciaux'); 
		    return false;
		  }

		  if (!re.test(form.prenom.value)) {		// Si l'utilisateur entre des chiffres dans le champ prénom, alors
		    alert('Votre prénom ne doit pas contenir de chiffres ni de caractères spéciaux'); 
		    return false;
		  }
	}
   </script>
</body>
</html>