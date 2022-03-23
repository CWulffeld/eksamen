<!DOCTYPE html>
<!--- Link til browser: https://wits.ruc.dk/~lsjn/eksamen/login.php --->
<?php

session_start();
require_once '/home/mir/lib/db.php';

$inputUid = $_POST['uid']; //uid
$inputPassword= $_POST['password'];
$getUser = get_user($getPost['uid']);
$getPassword = get_user($getUser['password']);

if (!empty($_SESSION['user'])) { //tjekker om brugeren allerede er logget ind
  //echo $gerUser['uid'];
  header('Location:login.php');
  exit;
}

if (isset($_POST['uid']) && isset($_POST['password'])) {
  if (login($inputUid, $inputPassword)) {
    echo "Logget ind";
    $_SESSION['user'] = $inputUid;
      header('Location:forside.php');
    exit;
  } else  {
    echo "Prøv igen";

  }

}

 ?>




<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title> Login </title>
  </head>
  <body>
    <form  action="" method="post">
     <h2> Login </h2>
      <label for="uid"> <b> Brugernavn </b></label>
      <br>
      <input type="text" name="uid" >
      <br>
      <label for="password"> <b> Adgangskode </b></label>
      <br>
      <input type="password" name="password">
      <br>
      <input type="submit" name="submit" value="Login"  >
    </form>

      <a href="signUp.php"><button> Sign up </button></a>





  </body>
</html>
