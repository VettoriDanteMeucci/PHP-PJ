<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Create Wiki</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="../styles/global.css">
  <link rel="stylesheet" href="../styles/create-page.css">
</head>

<body>
  <?php
  include_once "../classes/DB.php";
  include_once "../classes/Nav.php";
  $show = new Nav();
  echo $show->getNav();
  if (!isset($_SESSION["user"])) {
    header("Location: ./login.php");
  }
  $db = new DB();
  ?>


  <form class="p-2 col-md-8 col-lg-6 mx-auto mt-4 rounded bg-deepslate" action="../actions/addTutorial.php" method="POST"
    enctype="multipart/form-data">
    <div class="px-2">
      <label class="fs-3">Nome della pagina/tutorial</label>
      <input class="form-control fs-2 bg-spruce font-minecraft-ten" type="text" name="pageName" class="fs-3">
      <div class="my-2" id="images">
        <input class="form-control bg-spruce" type="file" name="image0" accept="image/*">
      </div>
    </div>
    <div id="text_container">
      <div class="d-flex flex-column mb-2 p-2 gap-2">
        <input class="form-control fs-3 w-50 bg-spruce font-minecraft-ten" name="title[]" type="text">
        <textarea class="form-control bg-spruce" name="text[]"></textarea>
      </div>
    </div>
    <button id="new_text" class="btn btn-success flex-shrink-1">+</button>
    <button class="btn btn-primary">
      Crea
    </button>
  </form>
  <script src="../script/form.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
    integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
    crossorigin="anonymous"></script>
</body>

</html>