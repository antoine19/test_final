<?php session_start();

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/accueil_connecte_okok.css">
    <link rel="stylesheet" href="css/fusion.css">
    <title>Bienvenue</title>
  </head>
  <body>
      <?php include('new_header.php');?>

      <?php echo $_SESSION['ID']; var_dump($_SESSION['ID']);//Il y a un probleme, pk ???? ?>

      <?php include('fusion.php');?>

      <?php include('footer.php');?>
  </body>
</html>
