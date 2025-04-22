<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Create Wiki</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="../styles/global.css">
</head>

<body>
  <?php
  include "../classes/DB.php";
  include "../classes/Nav.php";
  $nav = new Nav();
  echo $nav->getNav();
  if (!strlen($_GET["id"]) > 0 && isset($_GET["id"])) {
    header("location: ../index.php");
  }
  $db = new DB();
  $pages = $db->fetchCreatorPages($_GET["id"]);
  $creator = $db->fetchUsernameByID($_GET["id"]);
  $colLen = count($pages);
  $rem = 0;
  if ($colLen % 3 != 0) {
    $rem = $colLen % 3;
    $colLen -= $rem;
  }
  $colLen /= 3;
  ?>

  <div class="row">
    <div class="fs-2 col-12 text-center">
      <h1><?php echo $creator; ?></h1>
    </div>
    <div class="col-11 mx-auto row">
      <?php
      if (isset($_SESSION["user"]) && $_SESSION["user"]["isAdmin"] && $_GET["id"] != $_SESSION["user"]["id"]) {
        if ($db->isAdmin($_GET["id"])) {
          ?>
          <form method="POST" action="../actions/removeadminaction.php">
            <input type="hidden" name="userID" <?php echo "value='$_GET[id]'" ?>>
            <button class="btn btn-danger">Rimuovi Amministratore</button>
          </form>
          <?php
        } else {
          ?>
          <form method="POST" action="../actions/addadminaction.php">
            <input type="hidden" name="userID" <?php echo "value='$_GET[id]'" ?>>
            <button class="btn btn-success">Aggiungi Amministratore</button>
          </form>
          <?php
        }
      }
      ?>
      <?php
      $col = 0;
      do {
        echo "<ul class='col-4'>";
        if (($col == 2 || $colLen == 0) && $rem > 0) {
          $rem = $colLen != 0 ? $rem + 1 : $rem;
          for ($i = 0; $i < $rem; $i++) {
            $page = $pages[$i + ($col * $colLen)];
            echo "
                  <li>
                    <a class='text-white' href='http://localhost/PHP-PJ/pages/viewTutorial.php?id=$page[id]'>$page[name]</a>
                  </li>
                ";
          }
          $col = 3;
        } else {
          for ($i = 0; $i < $colLen; $i++) {
            $page = $pages[$i + ($col * $colLen)];
            echo "
                  <li>
                    <a class='text-white' href='http://localhost/PHP-PJ/pages/viewTutorial.php?id=$page[id]'>$page[name]</a>
                  </li>
                ";
          }
        }
        echo "</ul>";
        $col++;
      } while ($col < 3);
      ?>
    </div>
  </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
    integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
    crossorigin="anonymous"></script>
</body>

</html>