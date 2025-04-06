<?php 
    include("../classes/DB.php");
    $db = new DB();
    header("Content-type: application/json");
if(isset($_GET["name"]) && strlen($_GET["name"]) != 0){
    $name = $_GET["name"];
    $res = $db->fetchUserByName($name);
    echo json_encode($res);
}else{
    $res = $db->fetchUserByName();
    echo json_encode($res);
}
?>