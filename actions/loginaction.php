<?php 
    include_once("../classes/DB.php");
    $db = new DB();
    if(isset($_POST["username"]) && isset($_POST["password"])
    && $_POST["username"] != "" && $_POST["password"] != "" ) {
        $user = $db->login($_POST["username"], $_POST["password"]);
        session_start();
        $_SESSION["user"] = $user;
        header("Location: ../index.php");
    }else{
        echo "something went wrong";
    }
?>