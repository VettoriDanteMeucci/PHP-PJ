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
$db = new DB();
$nav = new Nav();
echo $nav->getNav();
?>

<body>
    
    <div class="row">
        <div class="bg-info-subtle col-md-3">
            <h1>
                <?php echo "Ciao " . $_SESSION["user"]["username"];?>
            </h1>
                <div class="mx-3 bg-white rounded p-2">
                    <a href="../actions/logoutaction.php" class="btn btn-danger m-0">Logout</a>
                    remove player info
                    <hr class="separator">
                </div>
        </div>
        <div class="col-md-9">
            Lorem ipsum dolor sit, amet consectetur adipisicing elit. Mollitia incidunt, molestias laborum itaque earum numquam ducimus quod repellat, laboriosam perspiciatis nobis, inventore quasi omnis a eum. Laboriosam eaque voluptatem sit.
            Magnam mollitia perspiciatis vitae animi soluta! Consequatur incidunt dolor magni repudiandae enim illum quam vitae tenetur esse quidem quae facilis, libero repellat error officia quaerat! Deleniti id ad dolorem obcaecati.
            Id et odio mollitia optio, neque soluta eos ipsum voluptatum nulla iure quam molestiae incidunt ut natus velit quaerat reiciendis, deleniti nam, fuga omnis asperiores qui alias magni placeat! Cumque?
            Obcaecati dolore similique voluptatibus, doloremque dolorum quae ullam unde assumenda earum at, architecto asperiores nisi maxime, consequuntur iure molestias facilis adipisci enim. Aliquam nihil earum iure soluta reprehenderit praesentium? Possimus!
            Nobis, quidem dolor. At eveniet hic eius vitae rerum quae? Expedita harum voluptatibus impedit. Aperiam quibusdam vel at, officia qui, suscipit doloremque neque, accusantium deserunt eveniet ipsam expedita maiores magnam.
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