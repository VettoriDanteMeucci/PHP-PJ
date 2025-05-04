<?php 
include_once "../classes/DB.php";
include_once "../classes/Info.php";
session_start();
$db = new DB();
if(isset($_POST["textID"]) && isset($_POST["pageID"]) && isset($_POST["body"]) && isset($_POST["title"])){
    if($db->fetchCreatorIDByPage($_POST["pageID"]) == $_SESSION["user"]["id"]
    || $_SESSION["user"]["isAdmin"]){
        $db->updateTextPage($_POST["textID"] , $_POST["body"], $_POST["title"]);
        Info::addInfoMsg("Aggiornamento realizzato con successo", false);
    }else{
        Info::addInfoMsg("Non hai i permessi necessari");
    }
}else{
    Info::addInfoMsg("Dati inseriti errati");
}
if(isset($_POST["pageID"])){
    header("Location: http://localhost/PHP-PJ/pages/viewTutorial.php?id=".$_POST["pageID"]);
}else{
    header("Location: http://localhost/PHP-PJ/");
}
?>