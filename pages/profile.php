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

        <div class="row mt-5">
            <div class="col-md-6 mx-auto">
                <h1>
                    <?php echo "Ciao " . $_SESSION["user"]["username"]; ?>
                </h1>
                <div class="mx-3 bg-dark-1 rounded p-2 mb-3">
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
                            <div class="modal-content bg-stone">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Modal title</h1>
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <!-- Form -->
                                    <form class="form-stone" action="../actions/updateuser.php" method="POST">
                                        <div class="mb-3">
                                            <label for="username" class="form-label">Username</label>
                                            <input required type="text" name="username" class="form-control" id="username">
                                        </div>
                                        <div class="mb-3">
                                            <label for="newpass" class="form-label">New Password</label>
                                            <input type="password" name="newPass" class="form-control" id="newpass">
                                        </div>
                                        <div class="mb-3">
                                            <label for="pass" class="form-label">Old Password</label>
                                            <input required type="password" name="pass" class="form-control" id="pass">
                                        </div>

                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end modal -->
                </div>
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