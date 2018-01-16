<?php session_start();?>

<!DOCTYPE html>

<html>

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <link rel="stylesheet" href="css.css" />
    <title>Home Be One</title>
  </head>

  <body class="body">

    <div class="topnav" id="myTopnav">

      <!-- MENU HORIZONTAL -->
      <a href="page_sui.php">Home Be One</a>
      <a class="active" href="gerer_domicile.php">Gérer Mon Domicile</a>
      <a href="gerer_consommation.php">Gérer Ma Consommation</a>

    </div>

    <div class="account">

      <!-- ACCES AU COMPTE -->
      <a class="sign" href="deconnexion.php">Se Déconnecter</a>
      <a class="sign" href="my_account.php">Mon Compte</a>

    </div>

    <div class="big_block">

      <fieldset class="block0">
      <legend>Modes</legend>

        <form method="post">

          <fieldset class="block">
         	  <legend>Choisir un Mode</legend>
              <div class="clearfix">
                <button type="submit" class="button">Mode Jour</button>
                <button type="submit" class="button">Mode Nuit</button>
              </div>
         	</fieldset>

          <fieldset class="block">
            <legend>ou Créer un Nouveau Mode</legend>
            <div class="clearfix">
              <button type="submit" class="button">Nouveau Mode</button>
            </div>
          </fieldset>

        </form>

      </fieldset>

    </div>

    <div class="big_block">

      <fieldset class="block0">
      <legend>Capteurs</legend>

      <div class="clearfix">
        <a href="add_capteur.php"><button type="submit" class="button">Ajouter Capteur</button></a>
      </div>

        <form method="post" action=''>

          <fieldset class="block">
         	  <legend>Mes Capteurs</legend>

            <?php
            try
            {
              $bdd = new PDO('mysql:host=localhost;dbname=bdd_hbo;charset=utf8', 'root', '');
            }
            catch (Exception $e)
            {
                    die('Erreur : ' . $e->getMessage());
            }

            $req_capteur = $bdd->prepare('SELECT nom, etat, id FROM capteurs WHERE ID_user=?'); //Pour l'instant manuellement pour test mais apres : pseudo=?
            $req_capteur->execute(array($_SESSION['ID']));

            //On boucle sur les pieces puis dans chaque boucle de piece on boucle sur les capteurs
            while ($capteur = $req_capteur->fetch())
            {
              echo  '<p class="big_block">' . $capteur['nom'] . '</p></br>';

              if ($capteur['etat']=='non')
              {
                ?>

                <form method="post" action="fonction_activer.php">
                  <input type="submit" name="<?php echo $capteur['id']; ?>" value="Activer" />
                </form>

                <?php

              }

              elseif ($capteur['etat']=='ok')
              {

                ?>

                <form method="post" action="fonction_desactiver.php">
                  <input type="submit" name="<?php echo $capteur['id']; ?>" value="Désactiver" />
                </form>

                <?php

              }
            }
            ?>

         	</fieldset>

        </form>

      </fieldset>

    </div>

    <div class="big_block">

      <fieldset class="block0">
      <legend>Pièces</legend>

      <div class="clearfix">
        <a href="add_piece.php"><button type="button" class="button">Ajouter Pièce</button></a>
      </div>

      <div class="clearfix">
        <a href="sup_piece.php"><button type="button" class="button">Supprimer Pièce</button></a>
      </div>

        <form method="post" action=''>

          <fieldset class="block">
         	  <legend>Mes Pièces</legend>

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
              echo  '<p class="big_block">' . $piece['nom'] . '</p></br>';
            }
            ?>

         	</fieldset>

        </form>

      </fieldset>

    </div>

    <!-- FOOTER -->
    <?php include("2footer.php"); ?>

  </body>

</html>
