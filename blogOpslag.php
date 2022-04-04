<?php
session_start();
 ?>
<!DOCTYPE html>
<!--- Link til browser: https://wits.ruc.dk/~lsjn/eksamen/blogOpslag.php --->
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title></title>
  </head>
  <body>


    <?php
    require_once '/home/mir/lib/db.php';

    if (empty($_SESSION['user']))
    {
      header('Location:login.php');
      exit;
    }

    $pids = $_GET['pid'];

    //$getPost = get_post($user);
    $getPost = get_post($pids);
    //$getUser = get_user($getPost['uid']);
    //$getComment = get_comment($pid);


    echo "Du kan nu se dit opslag";
    echo "<br> <b>Titel: </b>", $getPost['title'], '<br>';
    echo "<br><b>Indhold: </b>", $getPost['content'], '<br>';
    echo "<div class='container'> </div>"

     ?>





     <!-- Optional JavaScript -->
     <!-- Option 1: Bootstrap Bundle with Popper -->
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </body>
</html>
