<!DOCTYPE html>
<?php
session_start();
require_once '/home/mir/lib/db.php';

 ?>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <?php

    $pids = $_GET['pid'];

    //$getPost = get_post($user);
    $getPost = get_post($pids);
    //$getUser = get_user($getPost['uid']);
    //$getComment = get_comment($pid);


    echo "Du kan nu se dit opslag";
    echo "<br> <b>Titel: </b>", $getPost['title'], '<br>';
    echo "<br><b>Indhold: </b>", $getPost['content'], '<br>';

     ?>

  </body>
</html>
