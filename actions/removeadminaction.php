<?php 
    include_once "../classes/DB.php";
    include_once "../classes/Info.php";
    $db = new DB();
    session_start();
    if(isset($_POST["userID"]) && isset($_SESSION["user"]) && $_SESSION["user"]["isAdmin"]){
        $db->removeAdmin($_POST["userID"]);
        Info::addInfoMsg("Amministratore rimosso con successo", false);
    }else{
        Info::addInfoMsg("Non sono stati inseriti dati a sufficenza, o non hai i permessi necessari");
    }
    header("Location: ../index.php");
?>