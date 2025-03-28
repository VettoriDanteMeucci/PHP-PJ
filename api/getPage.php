<?php 
    include_once("../classes/DB.php");
    $db = new DB();
    header("Content-Type: application/json");
    if(isset($_GET["id"])){
        $ans = $db->getPage($_GET["id"]);
        echo json_encode($ans);
    }
?>