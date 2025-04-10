<?php 
    class Nav{
        function getNav(){
          session_start();
          $nav = file_get_contents("http://localhost/PHP-PJ/classes/navbar.html");
          if(isset($_SESSION["user"]) && $_SESSION["user"]){
            $name = $_SESSION["user"]["username"];
            $nav = str_replace("login.php", "profile.php", $nav);
            $nav = str_replace("Login" ,$name ,$nav);
          }
          return $nav;
        }
    }


?>

