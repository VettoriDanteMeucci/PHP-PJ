<?php 
    include_once "../classes/DB.php";
    if(isset($_GET["id"])){
        $db = new DB();
        $img = $db->fetchImg($_GET["id"]);
        if($img == false){
            echo "error 404";
        }else{
            header("Content-Type: $img[exte]");
            echo $img["body"];
        }
    }
?>