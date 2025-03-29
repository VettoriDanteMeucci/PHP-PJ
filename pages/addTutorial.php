<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Create Wiki</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
    <?php 
      include_once "../classes/DB.php";
      $db = new DB();
    ?>


    <form class="p-2 col-md-8 col-lg-6 mx-auto" action="../actions/addTutorial.php" method="POST" enctype="multipart/form-data">
    <label class="fs-3">Nome della pagina/tutorial</label>  
    <input class="form-control" type="text" name="pageName" class="fs-3">  
    <div class="my-2" id="images">
        <input class="form-control" type="file" name="image0" accept="image/*">
      </div>
      <div id="text_container">
        <div class="d-flex flex-column mb-2 p-2 gap-2 border rounded">
          <input class="form-control fs-3 w-50" name="title[]" type="text">
          <textarea class="form-control" name="text[]"></textarea>
        </div>
      </div>
      <button id="new_text" class="btn btn-outline-success flex-shrink-1">+</button>
      <button class="btn btn-primary">
          Vai
      </button>
    </form>
    <script src="../script/form.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
  </body>
</html> 