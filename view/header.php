<?php require_once './controller/AppController.php';
AppController::init(); 
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css"
        integrity="sha512-mSYUmp1HYZDFaVKK//63EcZq4iFWFjxSL+Z3T/aCt4IO9Cejm03q3NKKYN6pFQzY0SBOr8h+eCIAZHPXcpZaNw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Document</title>
    <style>
    body {
        margin: 20px;
    }

    form>div {
        margin-bottom: 10px;
    }
    </style>
</head>

<body class="container">

    <header
        class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
        <a href="./index.php" class="d-flex align-items-center col-md-3 mb-2 mb-md-0 text-dark text-decoration-none">
            <span class="fs-4">Actividad - UF2</span>
        </a>

        <div class="col-md-3 text-end">

            <?php if (isset($_COOKIE) && isset($_COOKIE['user'])) { ?>
            <span style="padding-right: 10px;">Usuario: <?php echo $_COOKIE['user'];?></span>
            <a href="./logout.php" type="button" class="btn btn-primary">Logout</a>
            <?php }
        else { ?>
            <a href='./login.php' type="button" class="btn btn-outline-primary me-2">Login</a>
            <?php } ?>

        </div>
    </header>
