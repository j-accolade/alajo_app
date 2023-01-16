<?php

require_once 'db.php';
$users = new Users($conn);
$user = 'test_user';
$pass = 'test_user_pass';
$users -> insertUser($user, $pass);

require_once 'session.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <title><?php echo 'Prupadi - '. ucfirst($pagename) ?></title>
    <style>
        .h-100{
            margin-top:auto;
            margin-bottom:auto;
        }
    </style>

</head>
<body>
    <!-- As a heading -->
    <?php if ($pagename == 'dashboard') {?>
        <nav class="navbar navbar-dark bg-primary">
            <div class="container py-1">
                <a href="dashboard.php"class="navbar-brand mb-0 h1 d-none d-sm-block"><strong>payvault</strong></a>
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-light" type="submit">Find<span style="color:white;">_</span>Vault</button>
                </form>
            </div>
        </nav>      
<?php }else {?>
    <nav class="navbar navbar-dark bg-primary">
        <div class="container py-1">
            <a href="dashboard.php"class="navbar-brand mb-0 h1"><strong>payvault</strong></a>
        </div>
    </nav>
<?php } ?>

   
