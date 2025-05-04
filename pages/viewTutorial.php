<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Create Wiki</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../styles/global.css">
    <link rel="stylesheet" href="../styles/show-page.css">
    </head>
  <?php 
    $id = -1;
    if(isset($_GET["id"]) && $_GET["id"] != "") 
       $id = $_GET["id"];
  ?>
  <body>
    <?php 
      include_once "../classes/Nav.php";
      include_once "../classes/DB.php";
      $nav = new Nav();
      $db = new DB();
      if($id == -1){
        header("Location: ../index.php");
      }
      echo $nav->getNav();
    ?>
  <div
            class="col-11 col-md-10 col-lg-8 row row-cols-1 mx-auto" 
        id="root"
        <?php echo "data-id='$id'";
            $isLog = isset($_SESSION["user"]);
            echo "data-logged='$isLog'";

        ?>>
    </div>
    <?php 
              $creator = $db->fetchCreatorIDByPage($id);
              $db->addViewsToPage($id, $creator);
              if(isset($_SESSION["user"]) && ( ($_SESSION["user"]["isAdmin"]) || ($creator == $_SESSION["user"]["id"]))){
                ?>
                  <form class="w-100 text-center mb-4" action="../actions/deletePage.php" method="POST">
                    <input type="hidden" name="pageID" value=<?php echo "'$id'"?>>
                    <button class="btn btn-danger">Elimina questo articolo</button>
                  </form>
                <?php
              }
        ?>


    <script type="module" src="../script/showPage.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
  </body>
</html> 