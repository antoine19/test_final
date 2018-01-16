<?php session_start();

	try
    	{
   	$bdd = new PDO('mysql:host=localhost;dbname=bdd_hbo;charset=utf8', 'root', ''); //se connecter à la BDD
    	}
	catch(Exception $e)
    	{
    	die('Erreur : '.$e->getMessage());
    	}
	/*$pass_hache = password_hash($_POST['mdp'], PASSWORD_DEFAULT);*/ //hacher le mot de passe
	$req = $bdd->prepare('INSERT INTO capteurs (nom, ID_user, numero_de_serie, piece, type) VALUES(?,?,?,?,?)');
	$req->execute(array($_POST['nom'], $_SESSION['ID'], $_POST['numero_de_serie'], $_POST['choix_piece'], $_POST['choix_type']));

?>

  <script type="text/javascript">alert("Capteur Ajouté");</script>

<?php

  $delai=1;
  $url='http://localhost/home_be_one/tests/gerer_domicile.php';
  header("Refresh: $delai;url=$url");

?>
