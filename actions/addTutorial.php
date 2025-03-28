<?php 
    include_once("../classes/DB.php");
    $db = new DB();
    $pageID = $db->createNewPage("Page1");
    $count = 0;
    while(isset($_FILES["image$count"]) && !empty($_FILES["image$count"]["name"])){
        $tmp = $_FILES["image$count"]["tmp_name"];
        $exte = $_FILES["image$count"]["type"];
        var_dump($_FILES["image$count"]["name"]);
        $count++;
        $db->addImg($tmp,$exte, $pageID);
        echo"<br>";
    }

    if(count($_POST["title"]) > 0){
        for($i = 0; $i < count($_POST["title"]); $i++){
            $title = $_POST["title"][$i];
            $body = $_POST["text"][$i];
            $db->addText($title, $body, $pageID);
        }
    }

?>