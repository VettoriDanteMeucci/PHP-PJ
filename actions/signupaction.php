<?php 
    include_once("../classes/DB.php");
    $db = new DB();
    if(isset($_POST["username"]) && isset($_POST["password"])
    && $_POST["username"] != "" && $_POST["password"] != "" ) {
        $user = $db->signup($_POST["username"], $_POST["password"]);
        var_dump($user);
        session_start();
        $_SESSION["user"] = $user;
    }else{
        echo "something went wrong";
    }
?>