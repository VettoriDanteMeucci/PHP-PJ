<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Create Wiki</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="./styles/global.css">
  </head>
  <body>
    <?php 
      include_once "./classes/DB.php";
      include_once "./classes/Nav.php";
      $db = new DB();
      $nav = new Nav();
      echo $nav->getNav();
      $pages = $db->fetchPageByTitle();
      $colLen = count($pages);
      $rem = 0;
      if($colLen % 3 != 0){
        $rem = $colLen % 3;
        $colLen -= $rem;
      }
      $colLen /= 3;

    ?>
    <div class="row">
      <!-- Presentazione -->
       <div class="col-11 mx-auto p-4 mt-3 info bg-spruce">
          Lorem ipsum dolor sit amet consectetur, adipisicing elit. Deserunt molestiae optio beatae deleniti excepturi recusandae. Vitae nesciunt ducimus, alias laudantium recusandae voluptatem itaque cupiditate fugiat, aspernatur fugit veritatis expedita ipsum!
          Aliquid, facere fugit aperiam in illum iste sapiente voluptas optio debitis et inventore dolorem sint ullam distinctio eveniet? Dicta sapiente rerum nisi odit maiores commodi voluptates ab autem, culpa voluptatibus.
          Dicta dolor alias quia facilis consequatur odit magni ipsum quasi, saepe minima adipisci quae, iure molestiae inventore? Quasi, dolor neque ullam ad, culpa cupiditate quaerat ut animi facere provident est?
       </div>
       <div class="col-11 mx-auto row">
         <?php
          $col = 0;
          do{
            echo "<ul class='col-4'>";
            //parser check when the coloumns
            if(($col == 2 || $colLen == 0) && $rem > 0){
              $rem = $colLen != 0 ? $rem+1 : $rem ;
              for($i = 0; $i < $rem ; $i++) {
              $page = $pages[$i+($col*$colLen)];
                echo "
                  <li>
                    <a class='text-white' href='http://localhost/PHP-PJ/pages/viewTutorial.php?id=$page[id]'>$page[name]</a>
                  </li>
                ";
              }
              $col = 3;
            }else{
              for($i = 0; $i < $colLen; $i++) {
                $page = $pages[$i+($col*$colLen)];
                echo "
                  <li>
                    <a class='text-white' href='http://localhost/PHP-PJ/pages/viewTutorial.php?id=$page[id]'>$page[name]</a>
                  </li>
                ";
            }
            }
              echo "</ul>";
              $col++;
          }while($col < 3);
        ?>
       </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
  </body>
</html> 