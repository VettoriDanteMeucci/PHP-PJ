<?php 
    include_once "../classes/DB.php";
    include_once "../classes/Info.php";
    $db = new DB();
    session_start();
    if(isset($_POST["userID"]) && isset($_SESSION["user"]) && $_SESSION["user"]["isAdmin"]){
        $db->addAdmin($_POST["userID"]);
        Info::addInfoMsg("Amministratore aggiunto con successo", false);
    }else{
        Info::addInfoMsg("Qualche parametro risulta essere errato");
    }
    header("Location: ../index.php");
?>