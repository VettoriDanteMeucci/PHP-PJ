<?php 
if(isset($_GET["name"]) && strlen($_GET["name"]) != 0){
    $name = $_GET["name"];
    include("../classes/DB.php");
    $db = new DB();
    $res = $db->fetchUserByName($name);
    header("Content-type: application/json");
    echo json_encode($res);
}
?>