<?php

function debugToConsole($msg) {
    echo "<script>console.log(".json_encode($msg).")</script>";
  }

 //debugToConsole($_COOKIE['rememberme']);

    if(isset($_POST['submit'])) {

        if(isset($_COOKIE['rememberme'])) {
            unset($_COOKIE['rememberme']);
            setcookie('rememberme', '',-1, '/');
            
        }
        $_SESSION[] = array();
        session_destroy();
        header("location: login.php");
        exit;
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body>
    <form action="" method="post">
    <div class="px-4 py-5 my-5 text-center">
        <h1 class="display-5 fw-bold text-body-emphasis">User page</h1>
        <div class="col-lg-6 mx-auto">
            <p class="lead mb-4"></p>
            <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
                <button class="btn btn-primary btn-lg px-4 gap-3" type="submit" name="submit">Log out</button>
            </div>
        </div>
    </div>
</body>
</html>