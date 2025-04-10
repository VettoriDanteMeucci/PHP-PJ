<?php 
    include_once("../classes/DB.php");
    $db = new DB();
    header("Content-Type: application/json");
    if(isset($_GET["id"])){
        $ans = $db->getPage($_GET["id"]);
        if($ans != false){
            echo json_encode($ans);
        }else{
            echo json_encode(null);
        }
    }else{
        echo json_encode(null);
    }
?>