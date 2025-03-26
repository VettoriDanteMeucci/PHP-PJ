<?php 
        include_once("../classes/DB.php");
    if(true){
        $db = new DB();
        $ans = $db->addImg(name: $_FILES["image"]);
        var_dump( $ans );
    }
?>