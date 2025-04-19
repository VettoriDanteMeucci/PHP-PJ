<?php 
    include_once("../classes/DB.php");
    session_start();
    $db = new DB();
    if(isset($_POST["pass"]) && strlen($_POST["pass"]) > 0 && isset($_SESSION["user"])){
        if(isset($_POST["username"]) && strlen(trim($_POST["username"])) > 0 ){
            if($db->updateUsername($_POST["username"], 
            $_POST["pass"], $_SESSION["user"]["id"])){
                $_SESSION["user"]["username"] = $_POST["username"];
            }
        }

        if(isset($_POST["newPass"]) && strlen($_POST["newPass"]) > 0){
            $db->updatePass($_POST["newPass"],
            $_POST["pass"], $_SESSION["user"]["id"]);
        }
        
    }
?>