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
                <?php echo "Ciao " . $_SESSION["user"]["username"]; ?>
            </h1>
            <div class="mx-3 bg-white rounded p-2 mb-3">
                <a href="../actions/logoutaction.php" class="btn btn-danger m-0">Logout</a>
                remove player info
                <hr class="separator">
                <!-- modal -->
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                    Modifica
                </button>
                modifica le tue info

                <!-- Modal -->
                <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false"
                    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Modal title</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <!-- Form -->
                                <form>
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Email address</label>
                                        <input type="email" class="form-control" id="exampleInputEmail1"
                                            aria-describedby="emailHelp">
                                        <div id="emailHelp" class="form-text">We'll never share your email with anyone
                                            else.</div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputPassword1" class="form-label">Password</label>
                                        <input type="password" class="form-control" id="exampleInputPassword1">
                                    </div>
                                    <div class="mb-3 form-check">
                                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                        <label class="form-check-label" for="exampleCheck1">Check me out</label>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">Understood</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end modal -->
            </div>
        </div>
        <div class="col-md-9">
            Lorem ipsum dolor sit, amet consectetur adipisicing elit. Mollitia incidunt, molestias laborum itaque earum
            numquam ducimus quod repellat, laboriosam perspiciatis nobis, inventore quasi omnis a eum. Laboriosam eaque
            voluptatem sit.
            Magnam mollitia perspiciatis vitae animi soluta! Consequatur incidunt dolor magni repudiandae enim illum
            quam vitae tenetur esse quidem quae facilis, libero repellat error officia quaerat! Deleniti id ad dolorem
            obcaecati.
            Id et odio mollitia optio, neque soluta eos ipsum voluptatum nulla iure quam molestiae incidunt ut natus
            velit quaerat reiciendis, deleniti nam, fuga omnis asperiores qui alias magni placeat! Cumque?
            Obcaecati dolore similique voluptatibus, doloremque dolorum quae ullam unde assumenda earum at, architecto
            asperiores nisi maxime, consequuntur iure molestias facilis adipisci enim. Aliquam nihil earum iure soluta
            reprehenderit praesentium? Possimus!
            Nobis, quidem dolor. At eveniet hic eius vitae rerum quae? Expedita harum voluptatibus impedit. Aperiam
            quibusdam vel at, officia qui, suscipit doloremque neque, accusantium deserunt eveniet ipsam expedita
            maiores magnam.
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