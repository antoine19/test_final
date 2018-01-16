<?php

session_start();

try
{
  $bdd = new PDO('mysql:host=localhost;dbname=bdd_hbo;charset=utf8', 'root', '');
}

catch(Exception $e)
{
  die('Erreur : '.$e->getMessage());
}

$req_piece = $bdd->prepare('SELECT nom FROM piece WHERE ID_user=?'); //Pour l'instant manuellement pour test mais apres : pseudo=?
$req_piece->execute(array($_SESSION['ID']));
while ($piece = $req_piece->fetch())
{

$req_capteur = $bdd->prepare('SELECT nom, etat, valeur, type, id FROM capteurs WHERE ID_user=? AND piece=?');
$req_capteur->execute(array($_SESSION['ID'], $piece['nom'])) or die(print_r($bdd->errorInfo()));
while($capteur = $req_capteur->fetch())
{
if(isset($_POST[$capteur['id']]))
{
  $dateFcap = date("Y-m-d H:i:s"); //Il y' a un décalage d'une heure
  $req = $bdd->prepare('UPDATE capteurs SET etat = :etat, dateFcap = :dateFcap WHERE id = :id') or die(print_r($bdd->errorInfo()));
  $req->execute(array('etat' => 'non','dateFcap' => $dateFcap, 'id' => $capteur['id'])) or die(print_r($bdd->errorInfo()));

  $delai=1;
  $url='http://localhost/home_be_one/tests/gerer_domicile.php';
  echo 'Désactivation d\'un capteur.';
  header("Refresh: $delai;url=$url");
}
}
}


require('definition_fonctions.php');



?>
