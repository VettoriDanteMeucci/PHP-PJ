<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Create Wiki</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../styles/global.css">
</head>
<?php
include "../classes/DB.php";
include "../classes/Nav.php";
$nav = new Nav();
echo $nav->getNav();
if(!strlen($_GET["id"]) > 0 && isset( $_GET["id"])) {
    header("location: ../index.php");
}
$db = new DB();
$pages = $db->fetchCreatorPages($_GET["id"]);
?>

<body>

    <div class="row">
        <div class="fs-2 col-12 text-center">
            <h1><?php echo $pages[0]["username"];?></h1>
        </div>
        <div class="row">
            <?php 
                foreach($pages as $page) {
                    echo "<a href='http://localhost/PHP-PJ/pages/viewTutorial.php?id=$page[id]'>$page[name].</a>";
                }
            ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
        crossorigin="anonymous"></script>
</body>

</html>