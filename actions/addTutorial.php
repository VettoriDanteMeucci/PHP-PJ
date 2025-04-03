<?php 
    include_once("../classes/DB.php");
    $db = new DB();
    session_start();
    $title = isset($_POST["pageName"]) ? $_POST["pageName"] : null;
    if($title != null && isset($_SESSION["user"]) ) {
        $user = $_SESSION["user"];
        $pageID = $db->createNewPage($title, $user["id"]);
        $count = 0;
        while(isset($_FILES["image$count"]) && !empty($_FILES["image$count"]["name"])){
        $tmp = $_FILES["image$count"]["tmp_name"];
        $exte = $_FILES["image$count"]["type"];
        $count++;
        $db->addImg($tmp,$exte, $pageID);
        }
        if(count($_POST["title"]) > 0){
            for($i = 0; $i < count($_POST["title"]); $i++){
                $title = $_POST["title"][$i];
                $body = $_POST["text"][$i];
                $db->addText($title, $body, $pageID);
            }
        }
        header("Location: http://localhost/PHP-PJ/pages/viewTutorial.php?id=".$pageID);
    }else{
        header("Location: http://localhost/PHP-PJ/");
    }

?>