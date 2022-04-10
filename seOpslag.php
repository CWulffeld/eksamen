<?php
session_start();
 ?>
<!DOCTYPE html>
<!--- Link til browser: https://wits.ruc.dk/~lsjn/eksamen/seOpslag.php --->
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

        <link rel="stylesheet" href="stylesheet.css" />

    <title>Blog Opslag</title>

  </head>
  <body>

    <?php
    /*if (empty($_SESSION['user']))
    {
      header('Location:login.php');
      exit;
    }*/
     ?>

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
              <a  class="nav-link" href="alleIndlæg.php">Alle indlæg</a>
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

    $brugerPid = $_GET['id'];
    $user = $_SESSION['user'];
    $userInfo = get_user($user);

    //$getPost = get_post($user);
    $getPost = get_post($brugerPid);
    //$getUserPost = get_post(['uid']);
    $getUser = get_user($getPost['uid']);


    //$getComment = get_comment($brugerPid);


    //$getUser = get_user($getPost['uid']);
    //$getUser = get_user($getPost['uid']);
    //$getComment = get_comment($pid);



    //echo "<br> <b>Titel: </b>", $getPost['title'], '<br>';
    //echo "<br><b>Indhold: </b>", $getPost['content'], '<br>';
    //echo "<div class='container'> </div>"

     ?>





     <div class='container mt-5 mb-5'>
       <div class='row'>
           <div class= 'col-md-6'  >
<h2>Blog indlægget</h2>

<div class="mb-3">
  <div class="card">
    <div class="card-header">
    <h5>  Forfatter profil<h5>
    </div>
    <div class="card-body">
<?php       echo "<b> Pid: </b>", $getPost['uid']; ?>
      <br>
      <?php echo "<b> Fornavn: </b>", $getUser['firstname']; ?>
      <br>
      <?php echo "<b> Efternavn: </b>",$getUser['lastname']; ?>
    </div>
  </div>
</div>

<div class="mb-3">
  <div class="card">
    <div class="card-header">
      <h5>Dato</h5>
    </div>
    <div class="card-body">
      <?php
      echo $getPost['date'];
      ?>
    </div>
  </div>
</div>

<div class="mb-3">
  <div class="card">
    <div class="card-header">
        <h5>Titel </h5>
    </div>
    <div class="card-body">

      <?php
      echo $getPost['title'];
      ?>
    </div>
  </div>
</div>

<div class="mb-3">
  <div class="card">
    <div class="card-header">
        <h5>Indhold</h5>
    </div>
    <div class="card-body">

    <?php
    echo $getPost['content'];
    ?>
  </div>
    </div>
    </div>

    <div class="mb-3">
      <div class="card">
        <div class="card-header">
          <h5>Kommentar</h5>
        </div>
        <div class="card-body">

        <?php

  foreach (get_cids_by_pid($brugerPid) as $comments) {
    $getComments = get_comment($comments);
    $cid = $getComments['cid'];
    echo  "<b>", $getComments['uid'],"</b>",": ", $getComments['content'],"<br>" ,$getComments['date'], "<br>";

if($user==$getPost['uid'] || $user==$getComments['uid']){
echo "<a class='link' href='sletKommentar.php?id=".$cid."'>";
echo "<button type='submit' class='btn btn-secondary' style='margin-top: 5px;'>Slet";
echo "</button>";
echo "</a>";
echo "<br>";

}
echo "<br>";


}

        ?>
      </div>
        </div>
        </div>

    <div class="mb-3">

      <?php

      // stil spørgsmål til session $user og connection
      // hvorfor virker det med lokal variabel frem for connection?
      if (!empty($_SESSION['user'])){
        $komIndhold = $_POST['komIndhold'];
        $komUid = $_POST['komUid'];
        $komPid = $_POST['komPid'];

      echo "<form action='' method='post'>";
      echo "<textarea name='komIndhold' class='form-control' id='komIndhold' placeholder='Skriv kommentar' rows='5' cols='20'></textarea>";

      echo "<input type='hidden' name='komUid'";
      echo " value='" . $user . "'>";
      echo "<input  type='hidden' name='komPid'";
      echo " value='" . $getPost['pid'] . "'>";
      echo "<button type='submit' name='submit'class='btn btn-primary'  style='margin-top: 5px;'>Tilføj kommentar</button>";
      echo "</form>";
     add_comment($komUid, $komPid, $komIndhold);


if($user==$getPost['uid']){
  echo "<a class='link' href='redigerOpslag.php?id=".$getPost['pid'].$getPost['title']."'>";
  echo "<button type='submit' class='btn btn-primary' style='margin-top: 5px;'>Rediger dit opslag";
  echo "</button>";
  echo "</a>";
}

    }  else {
        echo "Du skal være logget ind for at kommentere";
      }

      ?>
    </div>

    </div>

    <div class= 'col-md-6'  >

<h2>Billeder til indlægget</h2>
<?php //Henter billeder

foreach (get_iids_by_pid($brugerPid) as $iid){

     $getImage = get_image($iid);
     $image_url = $getImage['path'];

     echo "<img src='$image_url' height='300'/>";

   }

   if($user==$getPost['uid']){
     echo "<button type='submit' class='btn btn-primary' style='margin-top: 5px;'>Tilføj et billede til opslaget";
       echo "</button>";
   }
?>

         </div>

    </div>
    </div>
</div>




     <!-- Optional JavaScript -->
     <!-- Option 1: Bootstrap Bundle with Popper -->
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </body>
</html>