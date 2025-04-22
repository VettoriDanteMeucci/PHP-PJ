<?php 
    include_once("../classes/DB.php");
    include_once "../classes/Info.php";
    $db = new DB();
    if(isset($_POST["username"]) && isset($_POST["password"])
    && $_POST["username"] != "" && $_POST["password"] != "" ) {
        $user = $db->signup($_POST["username"], $_POST["password"]);
        session_start();
        $user["isAdmin"] = $db->isAdmin($user["id"]);
        $_SESSION["user"] = $user;
        Info::addInfoMsg("Registrazione avvenuta con successo", false);
    }else{
        Info::addInfoMsg("Qualcosa è andato storto", false);
    }
?>