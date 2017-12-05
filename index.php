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
        .reviews{background-color: lightgray; padding: 10px; border: 2px solid white}
        .img {float: right; height: 20% ; width: 20%}

        .carousel-inner {max-height: 500px}
    </style>
    <script>
        //Ajax modal for index page
        function ajaxFunc(){
            var ajaxRequest;

            try{
                ajaxRequest = new XMLHttpRequest();
            }catch (e){
                try{
                    ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
                }catch (e){
                    try{
                        ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP")
                    }catch (e){
                        alert("Your browser broke!");
                        return false;
                    }
                }
            }

            ajaxRequest.onreadystatechange = function(){
                if(this.readyState == 4 && this.status == 200){
                    document.getElementById("output").innerHTML = this.responseText;
                }
            }

            var selection = document.indexForm.eatery.value;

            ajaxRequest.open("GET", "getIndexData.php?selection=" + selection, true);
            ajaxRequest.send();
        }
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body>
<?php
//get login info
session_start();
$username = $_SESSION['username'];
$isAdmin = $_SESSION['isAdmin'];
?>
<!-- navabar -->
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
<!-- Jumbotron with carousel -->
 <div class="container">
     <div class="row">
        <div class="col-md-12">
            <div class="jumbotron">
                <h1 class="display-3">UNF Hungry Campus <span><img class="img" src="Images/UNF_Ospreys_logo.png" alt="UNF Logo"></span></h1>
                <p class="lead">A community for North Florida Foodies to discuss and review the on-campus eateries</p>
                <div id="carousel" class="carousel slide" data-ride="carousel" data-interval="3000">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img class="d-block w-100 h-100" src="Images/cafe2.jpg" alt="Osprey Cafe">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100" src="Images/CFA.jpg" alt="Chick Fil A">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100" src="Images/es.jpg" alt="Bagels">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100" src="Images/pj.jpg" alt="Papa Johns">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100" src="Images/pp.jpg" alt="Pita Pit">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100" src="Images/sb.jpg" alt="Starbucks">
                        </div>
                    </div>
            </div>
        </div>
     </div>
     </div>
         <div class="row">
         <div class="col-md-8">
             <!-- Displays recent reviews via AJAX -->
             <div class="jumbotron">
                     <form name="indexForm" onchange="ajaxFunc()">
                         <div class="form-group">
                             <h2>Recent Reviews</h2>
                             <div class="col-md-4">
                                 <select id="eatery" name="eatery" class="form-control">
                                 <option selected disabled value=""> --Select an Option -- </option>
                                 <option value="all"> All Reviews</option>
                                 <?php
                                 //displays locations to filter by
                                 $conn = new mysqli("localhost", "group6", "fall2017188953", "group6");

                                 if($conn->connect_error){
                                     die("Connection failed : " . $conn->connect_error);
                                 }
                                 $query = $conn->prepare("SELECT eateryID, eateryName FROM Eatery");
                                 $query->execute();
                                 $query->bind_result($eateryID, $eateryName);

                                 while ($query->fetch()){
                                     echo "<option value='$eateryID'>$eateryName</option>";
                                 }
                                 $query->close();
                                 $conn->close();
                                 ?>
                             </select>
                             </div>
                         </div>
                     </form>
                <hr>
                    <!-- outputs data -->
                    <p id="output"></p>
             </div>
         </div>
             <!-- Displays sidebar -->
         <div class="col-md-4">
             <div class="jumbotron">
                 <h3>Who are we?</h3>
                 <p>
                 We are a group of UNF Computing students who wanted to give all students on campus that are passionate about food a voice to be heard.
                 <br>
                     <a class="btn btn-primary" href="aboutUs.php" role="button">About us!</a>
                 </p>
                 <h3>Want to Join?</h3>
                 <p>
                 We want you to contribute, your voice matters. But you must log in first!<br>
                     <?php
                     if($username == ""){
                         echo "<a class='btn btn-primary' href='loginPage.php' role='button'>Log In to Contribute!</a>";
                     }else{
                         echo "<a class='btn btn-primary' href='posts/review.php' role='button'>Leave a review!</a>";
                     }
                     ?>
                 </p>
             </div>
        </div>
    </div>
 </div>


<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
</body>
</html>

