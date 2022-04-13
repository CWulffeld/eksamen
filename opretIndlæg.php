<?php session_start(); ?>
<!DOCTYPE html>
<!--- Link til browser: https://wits.ruc.dk/~lsjn/eksamen/opretIndlæg.php
Lavet af: Laura Sofie Juel Nielsen (LSJN) & Christine Wulffeld (CVANW)
--->

<?php
require_once '/home/mir/lib/db.php';
if (empty($_SESSION['user'])) { //tjekker om brugeren allerede er logget ind
  header('Location:login.php');
  exit;
}

    $brugerUid = $_SESSION['user']; //Ligger session user i en lokal variabel
    //Variabler som indholder indholdet fra formen. Indholdet af titel og indhold og uid
    $postTitle = $_POST['title'];
    $postIndhold = $_POST['indhold'];
    $postUid = $_POST['uid'];


?>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

        <link rel="stylesheet" href="stylesheet.css" />

    <title>Opret indlæg</title>

  </head>
  <body>

<!-- Navigationsbar -->
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
              <a class="nav-link" href="alleIndlæg.php">Alle indlæg</a>
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
<!-- Navigationsbar slut -->

<!-- Alert bokse om hvorvidt indlægget er tilføjet til databasen -->
<?php
     if(!empty($postTitle)){
       add_post($postUid, $postTitle, $postIndhold);
       echo <<<END
        <div class="alert alert-success" role="alert">
        Indlægget er sendt
      </div>
END;

} else if ($_POST['isSubmitted']){
       echo <<<END
        <div class="alert alert-danger" role="alert">
        Indlægget er ikke sendt. Du mangler titel
      </div>
END;
     }

?>


<div class="container mt-5">
  <div class="row">
    <div class="col-md-6">
      <form action='opretIndlæg.php' method="post"> <!-- Post fordi det kan indeholde mange tegn -->
        <h2>Opret indlæg</h2>

        <div class="mb-3">
          <div class="card">
            <div class="card-header">
                <h5>Titel</h5>
            </div>
          <div class="card-body">
            <input type="text" name="title" class="form-control" placeholder="Indtast titel">
          </div>
          </div>
        </div>

          <div class="mb-3">
            <div class="card">
              <div class="card-header">
                  <h5>Indhold</h5>
              </div>
              <div class="card-body">
              <textarea name="indhold" class="form-control" id="indhold" placeholder="Indtast indhold" rows="10" cols="20"></textarea>
          </div>
        </div>
      </div>
          <div>
        <input type='hidden' name = 'uid'

        <?php
             echo " value='" . $brugerUid . "'>";
        ?>

        </div>
      <input type="hidden" name="isSubmitted" value="True">
      <div class="mb-3">
        <button type="submit" name="submit"class="btn btn-primary">Tilføj indlæg</button>

      </div>

      </form>
    </div>
  </div>
</div>


     <!-- Optional JavaScript -->
     <!-- Option 1: Bootstrap Bundle with Popper -->
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </body>
</html>
