<?php
session_start();
 ?>
<!DOCTYPE html>
<!--- Link til browser: https://wits.ruc.dk/~lsjn/eksamen/blogOpslag.php --->
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Blog Opslag</title>
  </head>
  <body>

    <?php
    if (empty($_SESSION['user']))
    {
      header('Location:login.php');
      exit;
    }
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

    $pids = $_GET['pid'];

    //$getPost = get_post($user);
    $getPost = get_post($pids);
    //$getUser = get_user($getPost['uid']);
    //$getComment = get_comment($pid);



    //echo "<br> <b>Titel: </b>", $getPost['title'], '<br>';
    //echo "<br><b>Indhold: </b>", $getPost['content'], '<br>';
    //echo "<div class='container'> </div>"

     ?>





<div class="container mt-5">
  <div class="row">
    <div class="col-md-6">
      <h2>Du kan nu se og redigere dit opslag</h2>

      <h5>Titel</h5>
<form action='blogOpslag.php' method="post">

<div class="mb-3">
  <input type="text" name="title" class="form-control"
  <?php
  echo " value='" . $getPost['title'] . "'>";
  ?>
</div>
<div class="mb-3">
  <h5>Indhold </h5>
 <textarea name="indhold" rows="10" cols="20" class="form-control">
<?php
  echo $getPost['content'];
?>

</textarea>

</div>
<div>
<input type='hidden' name = 'pid'

<?php
       echo " value='" . $getPost['pid'] . "'>";
?>

</div>

<div class="mb-3">
  <button type="submit" class="btn btn-primary">Rediger opslag</button>

</div>

     </form>
    </div>
  </div>
</div>

<?php
$postTitle = $_POST['title'];
$postIndhold = $_POST['indhold'];
$postPid = $_POST['pid'];


 modify_post($postPid,$postTitle,$postIndhold);

 ?>



     <!-- Optional JavaScript -->
     <!-- Option 1: Bootstrap Bundle with Popper -->
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </body>
</html>
