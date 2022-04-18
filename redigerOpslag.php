<?php
session_start();
  require_once '/home/mir/lib/db.php';
 ?>
<!DOCTYPE html>
<!--- Link til browser: https://wits.ruc.dk/~lsjn/eksamen/redigerOpslag.php
Lavet af: Laura Sofie Juel Nielsen (LSJN) & Christine Wulffeld (CVANW)
 --->

<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

        <link rel="stylesheet" href="stylesheet.css" />
    <title>Rediger Opslag</title>

  </head>

  <body>
  <!-- Hvis $_Session bruger er tom, skal man sendes tilbage til login siden -->

<?php

    if (empty($_SESSION['user']))
    {
      header('Location:login.php');
      exit;
    }
?>

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


<!-- Variabler og metoder i PHP -->
<?php

    $brugerPid = $_GET['id']; //Henter pid for opslaget fra GET metoden
    $getPost = get_post($brugerPid); //Henter opslaget fra den hentede pid fra GET metoden

    $postTitle = $_POST['title']; //Redigerede titel (nye titel) i en variabel
    $postIndhold = $_POST['indhold']; //Redigerede indhold (nyt indhold) i en variabel
    $postPid = $_POST['pid']; //pid for det redigerede indlæg


    if(!empty($postTitle)){
     modify_post($postPid,$postTitle,$postIndhold);
      echo <<<END
       <div class="alert alert-success" role="alert">
       Opslaget er redigeret
     </div>
END;

} else if ($_POST['isSubmitted']){ // rent kosmetisk, true value som sørger for at det kun bliver vist når man trykker på submit. Så det ikke hele tiden står fremme.
      echo <<<END
       <div class="alert alert-danger" role="alert">
       Opslaget er ikke redigeret. Du mangler titel
     </div>
END;
    }


//Tilføj billeder
    $temp_path = $_FILES['picture']['tmp_name']; //Midlertidig placering
    $mime_type =  $_FILES['picture']['type']; //Mime type filer
    if($mime_type == 'image/png'){ //If statement som tildeler variablen $type en ny variabel bestemt efter hvilkem mime type den uploadede fil har
      $type = '.png';
    } else if($mime_type == 'image/jpg'){
      $type = '.jpg';
    }else if($mime_type == 'image/jpeg'){
      $type = '.jpeg';
    } else if($mime_type == 'image/gif'){
      $type = '.gif';
    } else if ($mime_type == 'image/svg'){
      $type = '.svg';
    }

    $iid = add_image($temp_path, $type); //Resultatet af add_image er id for billeder. Denne værdi ligges i variablen iid (image ID)
    add_attachment($brugerPid, $iid); //Tilføjer billedet til det specifkke opslag som brugeren er igang med at redigere

if (!empty($iid) && $_POST['picIsSubmitted']) { //hvis vi trykker på knappen og iid har en værdi, så går vi ud fra billedet bliver tilføjet. kosmetisk: picIsSubmitted og logik: iid
  echo <<<END
     <div class="alert alert-success" role="alert">
     Billedet er tilføjet
   </div>
END;

} else if(empty($iid) && $_POST['picIsSubmitted'] ) { //picIsSubmitted er rent kosmetisk og er kun true når man trykker submit, så snart man trykker på submit bliver den true.
  echo <<<END
   <div class="alert alert-danger" role="alert">
   Ikke tilføjet billede
 </div>
END;
}

?>


<div class="container mt-5">
  <div class="row">
    <div class="col-md-6">
<form action='' method="post">
  <div class="mb-3">
    <h2>Rediger opslag</h2>

<div class="card">
  <div class="card-header">
    <h5>Titel</h5>
  </div>


<div class="card-body">
<!-- Indholdet af form titel sættes til at være indlæggets titel. Henter titlen på det specifikke indlæg som brugeren har valgt -->
  <input type="text" name="title" class="form-control"
  <?php
  echo "value='" . $getPost['title'] . "'>";
  ?>
</div>
</div>
</div>


  <div class="mb-3">
    <div class="card">
      <div class="card-header">
        <h5>Indhold </h5>
      </div>

      <div class="card-body">
        <textarea name="indhold" rows="10" cols="20" class="form-control"><?php echo $getPost['content'];?></textarea>

      </div>
  </div>
</div>

<!-- Sender pid med som hidden -->
  <div>
    <input type='hidden' name = 'pid'
    <?php
        echo " value='" . $getPost['pid'] . "'>";
        ?>
  </div>

<!-- Tjekker hvorvidt formen er sendt. Bruges til alert boks -->
      <input type="hidden" name="isSubmitted" value="True">

  <div class="mb-3">
      <button type="submit" name="submit"class="btn btn-primary">Ændre Opslaget</button>
  </div>

     </form>
    </div>

<!-- HTML billede funktioner -->
    <div class="col-md-6">
      <div class="mb-3">
        <h2>Tilføj billeder</h2>
        <div class="card">
          <div class="card-header">
            <h5>Upload </h5>
          </div>
          <div class="card-body">
            <p>Du må uploade følgende filtyper: png, jpg, jpeg, gif og svg</p>

            <form action='' method='post' enctype='multipart/form-data'>
            <input type='file' name='picture'>
              <input type="hidden" name="picIsSubmitted" value="True">
            <input type='submit' name='submit' class='btn btn-primary' value='Tilføj billede'>

            </form>
          </div>
        </div>
      </div>

<!-- Tilbage knap -->
  <div class="mb-3">
    <div class="card">
      <div class="card-header">
        <h5>Tilbage</h5>
      </div>
      <div class="card-body">
        <p>Hvis du vil tilbage til opslaget. Klik på knappen </p>
  <?php //Knap til at komme tilbage til indlægget
  echo "<a class='link' href='seOpslag.php?id=".$getPost['pid']."'>"; //
  echo "<button type='submit' class='btn btn-secondary' >Opslaget";
  echo "</button>";
  echo "</a>";
    ?>

      </div>
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
