<?php session_start(); ?>

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

    <div>

      <fieldset class="block0">
      <legend>Ajouter Pièce</legend>

      <div class="modal1">

        <form method="POST" class="modal_content" action="piece_cible.php">

          <div class="content">

            <label>Nom</label>
            <input type="text" placeholder="Entrer le Nom de la Pièce" id="nom" name="nom" required>

            <div class="clearfix">
              <button type="submit" class="button" name="add_piece">Ajouter</button>
            </div>

      </fieldset>

    </div>

<?php include('2footer.php');?>

  </body>

</html>
