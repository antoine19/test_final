<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="fusion.css">
		<title></title>
	</head>
	<body>

	</body>
</html>

<?php

try
{
	$bdd = new PDO('mysql:host=localhost;dbname=bdd_hbo;charset=utf8', 'root', '');
}
catch (Exception $e)
{
        die('Erreur : ' . $e->getMessage());
}

$req_piece = $bdd->prepare('SELECT nom FROM piece WHERE ID_user=?'); //Pour l'instant manuellement pour test mais apres : pseudo=?
$req_piece->execute(array($_SESSION['ID']));

//On boucle sur les pieces puis dans chaque boucle de piece on boucle sur les capteurs
while ($piece = $req_piece->fetch())
{
	echo '<div class="block_piece">';
	echo '<span id="piece">';
  echo  $piece['nom'].'</br>';
	echo '</span>';
  $req_capteur = $bdd->prepare('SELECT nom, etat, valeur, type, id FROM capteurs WHERE ID_user=? AND piece=?');
  $req_capteur->execute(array($_SESSION['ID'], $piece['nom']));
  while ($capteur = $req_capteur->fetch())
  {
		if ($capteur['type']=="temperature")
		{
			$capteur['type']="°C";
		}
		elseif ($capteur['type']=="pression")
		{
			$capteur['type']="Pascal";
		}
		elseif ($capteur['type']=="luminosite")
		{
			$capteur['type']="Lux";
		}
		elseif ($capteur['type']=="humidite")
		{
			$capteur['type']="%";
		}
		if ($capteur['valeur']==NULL) //Si le capteur présente un problème
	  {
			echo '<span class="probleme_capteur">';
	    echo 'Le capteur de '.$capteur['nom'].' présente un problème ! </br>';
			echo '</span>';

	  }
		if ($capteur['valeur']!==NULL) //Si pas de problème
		{
		echo '<ul id="capteur">';
		echo '<li>';
    echo $capteur['nom'] .' : '. $capteur['valeur'] . ' '. $capteur['type'];
		echo '</li>';
		echo '</ul>';
		if ($capteur['etat']=='non')
		{

			include('fonction_activer_form.php');

		}
		elseif ($capteur['etat']=='ok')
		{

			include('fonction_desactiver_form.php');

		}
		}
  }

  $req_capteur->closeCursor();
	echo '</div>';
}


$req_piece->closeCursor();

?>
