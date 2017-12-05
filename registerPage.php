<!doctype html>
<html lang="en">
<head>
    <title>Hungry Campus</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <style>
        body{background-color: darkblue}
    </style>
</head>
<body>
<?php
//security
session_start();
$username = $_SESSION['username'];
$isAdmin = $_SESSION['isAdmin'];
?>
<!-- navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="index.php">Hungry Campus</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="aboutUs.php">About</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Locations
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="locations/cafeteria.php">Cafeteria</a>
                    <a class="dropdown-item" href="locations/ChickFilA.php">Chick Fil A</a>
                    <a class="dropdown-item" href="locations/starbucks.php">Starbucks</a>
                    <a class="dropdown-item" href="locations/papajohns.php">Papa Johns</a>
                    <a class="dropdown-item" href="locations/einsteinbagels.php">Einstein Bagels </a>
                    <a class="dropdown-item" href="locations/pitapit.php">Pita Pit</a>
                </div>
            </li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownLogin" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <?php
                    if ($username == ""){
                        echo "Login to Account";
                    }else{
                        echo "$username";
                    }
                    ?>
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownLogin">
                    <?php
                    if ($username == ""){
                        echo '<a class="dropdown-item" href="loginPage.php">Login</a>';
                    }else{
                        echo '<a class="dropdown-item" href="logout.php">Logout</a>';
                    }
                    ?>
                </div>
            </li>
        </ul>
    </div>
</nav>
<br>
<!-- register form -->
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="jumbotron">
            <form name="login" action="register.php" method="post">
                <div class="form-group">
                    <label>Username:</label>
                    <input name="username" id="username" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Password:</label>
                    <input type="password" name="password" id="password" class="form-control" required>
                </div>
                <div class="form-group">
                    <div class="col-md-8 col-md-offset-4">
                        <button id="submit" class="btn btn-primary" type="submit">Register</button>
                    </div>
                </div>
            </form>
        </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
</body>
</html>