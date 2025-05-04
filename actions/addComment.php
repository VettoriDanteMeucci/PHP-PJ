<?php 
    include_once "../classes/DB.php";
    include_once "../classes/Info.php";
    $db = new DB();
    session_start();
    if(isset($_POST["body"]) && isset($_SESSION["user"]) && isset($_POST["pageID"])){
        $db->addComment($_POST["body"], $_POST["pageID"]);
        Info::addInfoMsg("Commento Aggiunto", false);
        $id = $_POST['pageID'];
        header("Location: http://localhost/PHP-PJ/pages/viewTutorial.php?id=$id");
    }else{
        Info::addInfoMsg("Informazioni non valide");
        header("Location: http://localhost/PHP-PJ/");
    }
?>