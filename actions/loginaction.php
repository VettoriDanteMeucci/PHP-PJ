<?php 
    include_once("../classes/DB.php");
    include_once "../classes/Info.php";
    $db = new DB();
    session_start();
    if(isset($_POST["username"]) && isset($_POST["password"])
    && $_POST["username"] != "" && $_POST["password"] != "" ) {
        $pass = hash("sha256", $_POST["password"]);
        var_dump($_POST["username"], $pass);
        $user = $db->login($_POST["username"], $pass);
        if($user){
            $user["isAdmin"] = $db->isAdmin($user["id"]);
            session_start();
            $_SESSION["user"] = $user;
            Info::addInfoMsg("Accesso effettuato", false);
        }else{
            Info::addInfoMsg("Credenziali inserite non valide");
        }
    }else{
        Info::addInfoMsg("I dati non sono stati inseriti correttamente");
    }
    header("Location: ../index.php");
?>