<?php session_start(); ?>
<!DOCTYPE html>
<!--- Link til browser: https://wits.ruc.dk/~lsjn/eksamen/opretIndlæg.php
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
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Opret indlæg</title>

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
              <a class="nav-link" href="forside.php">Forside</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="opretIndlæg.php">Opret indlæg</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="andreIndlæg.php">Andres indlæg</a>
            </li>
          </ul>
         <li class="d-flex">
           <a  href="logUd.php">
             <button type="submit" class="btn btn-secondary">Log ud</button>
           </a>
           </li>
        </div>
      </div>
    </nav>

    <?php
    require_once '/home/mir/lib/db.php';

    $brugerUid = $_SESSION['user'];

    //$getPost = get_post($userPid);
    //$getUser = get_user($getPost['pid']);

     ?>


<div class="container mt-5">
  <div class="row">
    <div class="col-md-6">
      <form action='opretIndlæg.php' method="post">


      <div class="mb-3">
        <h5>Titel</h5>
        <input type="text" name="title" class="form-control" placeholder="Indtast titel">
      </div>

      <div class="mb-3">
        <h5>Indhold </h5>
          <textarea name="indhold" placeholder="Indtast indhold" rows="10" cols="20" class="form-control" >
          </textarea>
      </div>

      <div>
      <input type='hidden' name = 'uid'

      <?php
             echo " value='" . $brugerUid . "'>";
      ?>

      </div>

      <div class="mb-3">
        <button type="submit" name="submit"class="btn btn-primary">Tilføj indlæg</button>

      </div>

      </form>
    </div>
  </div>
</div>



    <?php
    $postTitle = $_POST['title'];
    $postIndhold = $_POST['indhold'];
    $postUid = $_POST['uid'];

add_post($postUid, $postTitle, $postIndhold);
     ?>


     <!-- Optional JavaScript -->
     <!-- Option 1: Bootstrap Bundle with Popper -->
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </body>
</html>
