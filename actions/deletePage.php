<?php 
    include "../classes/DB.php";
    include_once "../classes/Info.php";
    $db = new DB();
    session_start();
    $user = isset($_SESSION["user"]) ? $_SESSION["user"] : null;
    var_dump($user);
    if(isset($_POST["pageID"]) && $user != null){
        $id = $_POST["pageID"];
        $creatorID = $db->fetchCreatorIDByPage($id);
        if($creatorID == $user["id"] || $db->isAdmin($user["id"])){
            $db->deletePage($id);
            Info::addInfoMsg("Pagina eliminata con successo", false);
            header("Location: ../index.php");
        }
    }else{
        Info::addInfoMsg("La pagina non esiste o non hai i permessi per fare queste modifiche");
            header("Location: ../index.php");
    }
?>