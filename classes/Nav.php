<?php 
    class Nav{
        function getNav(){
          session_start();
          $nav = file_get_contents("http://localhost/PHP-PJ/classes/navbar.html");
          if(isset($_SESSION["user"])){
            $name = $_SESSION["user"]["username"];
            $logged = "<li class='nav-item'><a class='nav-link' href='#'>$name</a></li>";
            $nav = str_replace("<!--flag1-->", $logged ,$nav);
          }
          return $nav;
        }
    }


?>

