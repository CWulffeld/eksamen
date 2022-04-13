<?php session_start(); ?>
<!DOCTYPE html>
<!--- Link til browser: https://wits.ruc.dk/~lsjn/eksamen/sletKommentar.php
Lavet af: Laura Sofie Juel Nielsen (LSJN) & Christine Wulffeld (CVANW)
--->
<?php
require_once '/home/mir/lib/db.php';
if (empty($_SESSION['user'])) { //tjekker om brugeren allerede er logget ind
  //echo $gerUser['uid'];
  header('Location:login.php');
  exit;
}

 ?>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>

<?php
require_once '/home/mir/lib/db.php';

$cid = $_GET['id']; //Henter cid for den specifikke kommentar valgt. Denne info kommer fra seOpslag.php
$getComment = get_comment($cid); //Henter kommentaren fra kommentar tabellen
delete_comment($cid); //Sletter kommentaren
header("Location:seOpslag.php?id=".$getComment['pid']); //Efter ovenstående er sendt, sendes man tilbage til opslaget
?>


  </body>
</html>
