<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>

<?php
require_once '/home/mir/lib/db.php';

$cid = $_GET['id'];
$getComment = get_comment($cid);
delete_comment($cid);
header("Location:seOpslag.php?id=".$getComment['pid']);



?>


  </body>
</html>
