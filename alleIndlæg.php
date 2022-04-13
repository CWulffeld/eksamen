<?php session_start(); ?>
<!DOCTYPE html>
<!--- Link til browser: https://wits.ruc.dk/~lsjn/eksamen/alleIndlæg.php
Lavet af: Laura Sofie Juel Nielsen (LSJN) & Christine Wulffeld (CVANW)
--->

<?php
require_once '/home/mir/lib/db.php';
 ?>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

        <link rel="stylesheet" href="stylesheet.css" />

    <title> Alle indlæg </title>
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
              <a class="nav-link" href="forside.php">Forside</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="opretIndlæg.php">Opret indlæg</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="alleIndlæg.php">Alle indlæg</a>
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
    $uid = $_GET['id']; //kommer fra name="id" i input
    $getUser = get_user($uid); //Henter uid oplysninger fra database users
     ?>

<div class='container mt-5 mb-5'>
  <div class='row'>
    <div class= 'col-md-6'  >

  <!--- Mulighed for at søge på bruger --->
<div>
    <h2> Søg bruger </h2>
      <form action="alleIndlæg.php" method="get" class="form-control">
        <label   for="pid"> <b> Angiv et id for en bruger (uid): </b>
        </label>
        <input  type="text" id="pid" name="id">
        <input class="btn btn-primary" type="submit">
  </form>
</div>

<div>
  <div class="card" >
    <div class="card-header">
      <h5>  Brugerprofil</h5>
    </div>
      <div class="card-body" >
<?php
    //Printer oplysninger om brugeren fra databasen i bootstrap card
    echo "<b>Bruger: </b>", $getUser['uid'], '<br>';
    echo "<b>Fornavn: </b>", $getUser['firstname'], '<br>';
    echo "<b>Efternavn: </b>", $getUser['lastname'], '<br>';
?>
    </div>
  </div>
</div>

<div class="card">
  <div class="card-header">
    <h5>  Titler</h5>
  </div>

    <div class="card-body">
<?php
//Loop som returnerer array for alle indlæg skrevet af den søgte bruger og ligger den over i variablen $pid
      foreach (get_pids_by_uid($uid) as $pid){
        //Henter indlæg/post for $pid
        $getPost = get_post($pid);

        //Printer listen ud (bootstrap) hvori der er et link hvor man bliver sendt til seOpslag.php med
        echo "<div class='list-group'>
        <a class='list-group-item list-group-item-action' href='seOpslag.php?id=".$getPost['pid']."'>".$getPost['title']."</a> </div>"; //Vi kan ikke slette title, hvis title slettes, bliver listen af titler ikke printet ud. Vi lukker a før titel href, for at det ikke bliver vist i URL.
      }
?>

    </div>
  </div>
</div>


<div class="col-md-6">
  <h2> Alle brugere </h2>
    <div class="card">
      <div class="card-body">

<?php
      $getUids = get_uids(); //Returnerer array med alle bruger id'er
      foreach ($getUids as $uid){ //Printer arrayet ud
      echo "<li>"; //Tilføjer tegn
      echo $uid; //Printer uid'et (id'et for brugereb)
      echo "</li>";
      }
?>

      </div>
    </div>
  </div>

  </div>
</div>


     <!-- Optional JavaScript -->
     <!-- Option 1: Bootstrap Bundle with Popper -->
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

  </body>
</html>
