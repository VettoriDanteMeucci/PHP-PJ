<?php 
    class Nav{
        function getNav(){
          return file_get_contents("http://localhost/PHP-PJ/classes/navbar.html");
        }
    }


?>

