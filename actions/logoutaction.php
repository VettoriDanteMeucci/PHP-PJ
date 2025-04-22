<?php 
    include_once "../classes/Info.php";
    session_start();
    if(isset($_SESSION["user"])){
        unset($_SESSION["user"]);
        Info::addInfoMsg("Logout effettuato con successo", false);
    }else{
        Info::addInfoMsg("Assicurati di aver effettuato l'accesso per poter effettuare il logout");
    }
    header("location: ../index.php")
?>