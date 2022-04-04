<?php session_start(); ?>
<!DOCTYPE html>
<!--- Link til browser: https://wits.ruc.dk/~lsjn/eksamen/forside.php
Lavet af: Laura Sofie Juel Nielsen (LSJN) & Christine Wulffeld (CVANW)

--->


<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title> Opret bruger</title>
  </head>
  <body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container-fluid">
        <a class="navbar-brand" >Blog</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link"  href="login.php">Tilbage til login</a>
            </li>
        </div>
      </div>
    </nav>




    <div class="container mt-5"> <!-- MB bestemmer margin top -->
      <div class="row">

        <div class="col-md-6"> <!-- Bestemmer hvor containeren skal slutte. Slutter 6 ud af 12 -->

              <form  action="" method="post">
                <h2> Opret bruger </h2>
          <div class="mb-3"> <!-- MB bestemmer margin bund -->
            <label for="uid" class="form-label"> <b> Brugernavn </b></label>
            <input type="text" name="uid"class="form-control" placeholder="Indtast brugernavn"  >
          </div>
          <div class="mb-3"> <!-- MB bestemmer margin bund -->
            <label for="fornavn" class="form-label"> <b> Fornavn </b></label>
            <input type="text" name="fornavn"class="form-control" placeholder="Indtast fornavn"  >
          </div>
          <div class="mb-3"> <!-- MB bestemmer margin bund -->
            <label for="efternavn" class="form-label"> <b> Efternavn </b></label>
            <input type="text" name="efternavn"class="form-control" placeholder="Indtast brugernavn"  >
          </div>
          <div class="mb-3 ">
              <label for="password" class="form-label"> <b> Adgangskode </b></label>
              <input type="password" class="form-control"name="password" placeholder="Indtast adgangskode">
          </div>
          <div class="mb-3">
              <button type="submit" name="submit" class="btn btn-primary">Opret dig</button>
            </form>
          </div>


</div>


<!--

    <div class="container mt-5"> <!-- MB bestemmer margin top -->
    <!--  <div class="row">

<form  action="" method="post">
  <label for="uid"><b> Brugernavn: </b></label>
  <br>
  <input type="text" name="uid">
  <br>
  <label for="fornavn"><b>Fornavn: </b></label>
  <br>
  <input type="text" name="fornavn" >
  <br>
  <label for="efternavn"><b>Efternavn: </b></label>
  <br>
  <input type="text" name="efternavn">
  <br>
  <label for="password"> <b> Adgangskode: </b></label>
  <br>
  <input type="password" name="password" >
  <br>
  <input type="submit" name="submit">

</form> -->



    <?php
    require_once '/home/mir/lib/db.php';
    $uid = $_POST['uid'];
    $firstname = $_POST['fornavn'];
    $password = $_POST['password'];
    $lastname = $_POST['efternavn'];

    add_user($uid, $firstname, $lastname, $password);

     ?>

     <!-- Optional JavaScript -->
     <!-- Option 1: Bootstrap Bundle with Popper -->
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </body>
</html>
