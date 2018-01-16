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
    $dateDcap = date("Y-m-d H:i:s"); //Il y' a un décalage d'une heure
    $req = $bdd->prepare('UPDATE capteurs SET etat = :etat, dateDcap = :dateDcap, dateFcap = :dateFcap WHERE id = :id');
    $req->execute(array('etat' => 'ok','dateDcap' => $dateDcap,'dateFcap' => $dateDcap, 'id' => $capteur['id']));

  $delai=1;
  $url='http://localhost/home_be_one/tests/accueil_connecte_okok.php';
  echo 'Activation d\'un capteur.';
  header("Refresh: $delai;url=$url");
}
}
}


?>
