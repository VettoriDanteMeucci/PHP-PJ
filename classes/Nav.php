<?php 
    class Nav{
        function getNav(){
          session_start();
          $nav = file_get_contents("http://localhost/PHP-PJ/classes/navbar.html");
          if(isset($_SESSION["user"])){
            $nav = str_replace("<!--flag1-->", "hi" ,$nav);
          }
          return $nav;
        }
    }


?>

