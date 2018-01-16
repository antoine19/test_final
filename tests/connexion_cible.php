<?php session_start();
$_SESSION['pseudo']=$_POST['pseudo'];
?>

<!DOCTYPE html>


    <?php

    // Vérification des identifiants
    try
    {
        $bdd = new PDO('mysql:host=localhost;dbname=bdd_hbo;charset=utf8', 'root', '');
    }
    catch(Exception $e)
    {
        die('Erreur : '.$e->getMessage());
    }

     $delai=2;
     $url='http://localhost//home_be_one/tests/connexion.php';
    /* $prenom=$_POST['prenom'] ; */
    /*$pass_hache = password_hash($_POST['mdp'], PASSWORD_DEFAULT);*/  //hacher le mot de passe
    $requser = $bdd->prepare('SELECT id FROM utilisateur WHERE pseudo = :pseudo AND mdp= :mdp ');
    $requser->execute(array('pseudo' => $_POST['pseudo'],
        'mdp' => $_POST['mdp']));

    $resultat = $requser->fetch();  ?>

    <?php
    if ($resultat==0)
    {

        echo 'erreur de saisie';
        header("Refresh: $delai;url=$url");


    }
    else

    {
        $_SESSION['pseudo']=$_POST['pseudo'];

        $req_id = $bdd->prepare('SELECT * FROM utilisateur WHERE pseudo=?');
        $req_id->execute(array($_SESSION['pseudo']));
        $_SESSION = $req_id->fetch();


        $delai=1;
        $url='http://localhost/home_be_one/tests/page_sui.php';
        echo 'Veuillez patienter';
        header("Refresh: $delai;url=$url");
        exit();
    }  ?>


</html>
