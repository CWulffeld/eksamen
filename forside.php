<?php session_start(); ?>
<!DOCTYPE html>
<!--- Link til browser: https://wits.ruc.dk/~lsjn/eksamen/forside.php
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

         <link rel="stylesheet" href="stylesheet.css" />



     <title> Forside </title>

  </head>
      <body>
        <!--- Navigationsbar --->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
          <div class="container-fluid">
            <a class="navbar-brand">WITS 2022</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                <li class="nav-item">
                  <a class="nav-link active" aria-current="page" href="forside.php">Forside</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="opretIndlæg.php">Opret indlæg</a>
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
        <!--- Navigationsbar slut --->

<?php
     $user = $_SESSION['user'];
     $hentInfo = get_user($user); //Henter information om brugeren som er ligget ind
?>


<div class='container mt-5 mb-5'>
  <div class='row'>
      <div class= 'col-md-6'  >

<?php
//Printer oplysninger om brugeren ud
echo "<h2> Din profil</h2>  <br>";
echo "<div class='card'>"; //Laver tekstfeltet som card
echo "<div class='card-body'>";
echo "<b>Uid: </b>", $hentInfo['uid'], '<br>';
echo "<b>Fornavn:  </b>", $hentInfo['firstname'], '<br>' ;
echo "<b>Efternavn: </b>", $hentInfo['lastname'], '<br>';
echo "</div>";
echo "</div>";
?>
      </div>
  <div class='col-md-6' >
    <h2>Dine opslagstitler</h2>
      <br>
        <?php
          foreach (get_pids_by_uid($user) as $pid){
            $getPost = get_post($pid);
              echo "<div class='list-group'>
                    <a
                    class='list-group-item list-group-item-action' href='seOpslag.php?id=".$getPost['pid']."'>".$getPost['title']."</a> </div>";
            }
        ?>
  </div>
</div>
</div>



<!-- Optional JavaScript -->
<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
      </body>
</html>
