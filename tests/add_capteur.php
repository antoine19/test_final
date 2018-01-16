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
      <legend>Ajouter Capteur</legend>

      <div class="modal1">

        <form method="POST" class="modal_content" action="capteur_cible.php">

          <div class="content">

            <label>Numéro de Série</label>
            <input type="number" placeholder="Entrer le Numéro de Série" id="numero_de_serie" name="numero_de_serie" required>

            <label>Nom</label>
            <input type="text" placeholder="Entrer un Nom de Capteur" id="nom" name="nom" required>

            <label>Pièce</label>
            <?php
            echo'<select name="choix_piece">';

              try
              {
               $bdd = new PDO('mysql:host=localhost;dbname=bdd_hbo;charset=utf8', 'root', '');
              }
              catch (Exception $e)
              {
                      die('Erreur : ' . $e->getMessage());
              }

              $req_piece = $bdd->prepare('SELECT nom FROM piece WHERE ID_user=?');
              $req_piece->execute(array($_SESSION['ID']));
              while ($piece = $req_piece->fetch())
              {
                ?>
                <option value="<?php echo $piece['nom']; ?>"> <!--La valeur à envoyer à la bdd est le nom de la pièce-->
                  <?php echo $piece['nom']; ?>
                </option>
                <?php
              }
           echo '</select>';
           ?>

           <label>Type</label>
           <select name="choix_type">
              <option value="temperature">Température</option>
              <option value="pression">Pression</option>
              <option value="luminosite">Luminosité</option>
              <option value="camera">Caméra</option>
          </select>

          <br/>

            <div class="clearfix">
              <button type="submit" class="button" name="add_capteur">Ajouter</button>
            </div>

      </fieldset>

    </div>

<?php include('2footer.php');?>

  </body>

</html>
