<?php 
    include_once("../classes/DB.php");
    $db = new DB();
    $count = 0;
    while(isset($_FILES["image$count"]) && !empty($_FILES["image$count"]["name"])){
        $tmp = $_FILES["image$count"]["tmp_name"];
        $exte = $_FILES["image$count"]["type"];
        var_dump($_FILES["image$count"]["name"]);
        $count++;
        $db->addImg($tmp,$exte );
        echo"<br>";
    }
?>