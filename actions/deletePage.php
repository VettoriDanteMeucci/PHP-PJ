<?php 
    include "../classes/DB.php";
    $db = new DB();
    session_start();
    $user = isset($_SESSION["user"]) ? $_SESSION["user"] : null;
    var_dump($user);
    if(isset($_POST["pageID"]) && $user != null){
        $id = $_POST["pageID"];
        $creatorID = $db->fetchCreatorIDByPage($id);
        if($creatorID == $user["id"] || $db->isAdmin($user["id"])){
            $db->deletePage($id);
            header("Location: ../index.php");
        }
    }
?>