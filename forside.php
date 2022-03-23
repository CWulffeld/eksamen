<!DOCTYPE html>

<?php session_start();
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
     <title> Forside </title>
  </head>
      <body>
     <?php

     $user = $_SESSION['user'];
     $hentInfo = get_user($user);

     echo "<h2> Dine informationer </h2>  <br>";

    echo "<b> Uid: </b> ", $hentInfo['uid'], '<br>';
    echo "<b> Fornavn:  </b>", $hentInfo['firstname'], '<br>' ;
    echo "<b> Efternavn: </b>", $hentInfo['lastname'], '<br>';

    foreach (get_pids_by_uid($user) as $pid){
      $getPost = get_post($pid);
      /*echo "Titel ", $getPost['title'];
      echo "<br>";*/

      echo "<li> <b>Titlen er: </b> <a href='blogOpslag.php?pid=".$getPost['pid']."'>".$getPost['title']."</a> </li> <br>";

    }




    ?>

      </body>
</html>
