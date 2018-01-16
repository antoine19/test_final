<?php session_start(); ?>

<!DOCTYPE html>
<html>
<head>

</head>
<body>
    <?php

	  try
      {
   	    $bdd = new PDO('mysql:host=localhost;dbname=bdd_hbo;charset=utf8', 'root', ''); //se connecter à la BDD
    	}
	    catch(Exception $e)
    	{
    	  die('Erreur : '.$e->getMessage());
    	}
	    /*$pass_hache = password_hash($_POST['mdp'], PASSWORD_DEFAULT);*/ //hacher le mot de passe
	    $req = $bdd->prepare('INSERT INTO piece(nom, ID_user) VALUES(?,?)');
      $req->execute(array($_POST['nom'], $_SESSION['ID']));

    ?>

    <script type="text/javascript">alert("Pièce Ajoutée");</script>

    <?php

    $delai=1;
    $url='http://localhost/home_be_one/tests/gerer_domicile.php';
    header("Refresh: $delai;url=$url");

    ?>


</body>
</html>
