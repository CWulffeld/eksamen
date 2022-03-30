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

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">





    <title> Login </title>

  </head>
  <body>



      <div class="container mt-5"> <!-- MB bestemmer margin top -->
        <div class="row">
          <div class="col-sm-6"> <!-- Bestemmer hvor containeren skal slutte. Slutter 6 ud af 12 -->
                <form  action="" method="post">
                  <h2> Login </h2>
            <div class="mb-3"> <!-- MB bestemmer margin bund -->
              <label for="uid" class="form-label"> <b> Brugernavn </b></label>
              <input type="text" name="uid"class="form-control" placeholder="Indtast brugernavn"  >
            </div>
            <div class="mb-3 ">
                <label for="password" class="form-label"> <b> Adgangskode </b></label>
                <input type="password" class="form-control"name="password" placeholder="Indtast adgangskode">
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-primary">Login</button>
              </form>
            </div>


        </div>
        <div class="col-sm-6">
          <div class="mb-3 ">
            <h2>Ikke bruger endnu?</h2>
          <p>  Tilmeld dig her</p>
                <a href="signUp.php"><button type="submit" class="btn btn-secondary">Sign Up</button></a>

          </div>
        </div>
      </div>

</div>


  <!-- Optional JavaScript -->
  <!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </body>
</html>
