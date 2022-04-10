<?php
session_start();
  ?>
<!DOCTYPE html>
<!--- Link til browser: https://wits.ruc.dk/~lsjn/eksamen/login.php
Lavet af: Laura Sofie Juel Nielsen (LSJN) & Christine Wulffeld (CVANW)

--->
<?php


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
    $tjek = true;

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

        <link rel="stylesheet" href="stylesheet.css" />

    <title> Login </title>


  </head>
  <body>


    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container-fluid">
        <a class="navbar-brand">WITS 2022</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link" href="alleIndlæg.php">Alle indlæg</a>
            </li>
            </ul>
      </div>
      </div>
    </nav>


      <div class="container mt-5"> <!-- MB bestemmer margin top -->
        <div class="row">

          <div class="col-md-6"> <!-- Bestemmer hvor containeren skal slutte. Slutter 6 ud af 12 -->
            <?php
        if ($tjek == true){
            echo <<<END
             <div class="alert alert-danger" role="alert">
             Brugernavn og adgangskode er ikke korrekt
           </div>
END;

         }
             ?>
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


        <div class="col-md-6">
          <div class="mb-3 ">
            <h2>Ikke bruger endnu?</h2>
          <p>  Tilmeld dig her</p>
                <a href="signUp.php"><button type="submit" class="btn btn-primary">Sign Up</button></a>

          </div>
        </div>
      </div>

</div>


  <!-- Optional JavaScript -->
  <!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </body>
</html>
