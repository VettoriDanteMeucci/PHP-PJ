<?php 
    include_once("../classes/DB.php");
    include_once "../classes/Info.php";
    session_start();
    $db = new DB();
    if(isset($_POST["pass"]) && strlen($_POST["pass"]) > 0 && isset($_SESSION["user"])){
        $msg = "Operazioni: ";
        if(isset($_POST["username"]) && strlen(trim($_POST["username"])) > 0 ){
            if($db->updateUsername($_POST["username"], 
            $_POST["pass"], $_SESSION["user"]["id"])){
                $_SESSION["user"]["username"] = $_POST["username"];
            }
            $msg .= "modificato nome ";
        }
        if(isset($_POST["newPass"]) && strlen($_POST["newPass"]) > 0){
            $db->updatePass($_POST["newPass"],
            $_POST["pass"], $_SESSION["user"]["id"]);
            $msg .= " modificata password";
        }
        Info::addInfoMsg($msg, false);
    }else{
        Info::addInfoMsg("Qualcosa è andato storto controlla di aver inserito i dati correttamente");
    }
    header("location: ../index.php");
?>