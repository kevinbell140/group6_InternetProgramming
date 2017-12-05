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
        .img {float: right; height: 20% ; width: 20%}

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
    <a class="navbar-brand" href="../index.php">Hungry Campus</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="../index.php">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../aboutUs.php">About</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="index.php" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Locations
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="cafeteria.php">Cafeteria</a>
                    <a class="dropdown-item" href="ChickFilA.php">Chick Fil A</a>
                    <a class="dropdown-item" href="starbucks.php">Starbucks</a>
                    <a class="dropdown-item" href="papajohns.php">Papa Johns</a>
                    <a class="dropdown-item" href="einsteinbagels.php">Einstein Bagels </a>
                    <a class="dropdown-item" href="pitapit.php">Pita Pit</a>
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
                        echo '<a class="dropdown-item" href="../loginPage.php">Login</a>';
                    }else{
                        echo '<a class="dropdown-item" href="../logout.php">Logout</a>';
                    }
                    ?>
                </div>
            </li>
        </ul>
    </div>
</nav>
<br>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="jumbotron">
                <div id="map" style="width:320px;height:320px;background:yellow;float:right"></div>
                <script>
                    function myMap() {
                        //google maps
                        var mapOptions = {
                            center: new google.maps.LatLng(30.271562,-81.509242),
                            zoom: 19,
                            mapTypeId: google.maps.MapTypeId.HYBRID
                        }
                        var map = new google.maps.Map(document.getElementById("map"), mapOptions);
                    }
                </script>

                <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDdO-8xrXJAd2jCPw__HRGwuKn67m70zRI&callback=myMap"></script>

                <h1 class="display-3">Papa Johns </h1>
                <p class="lead">Peyton Manning's favorite</p>
                <hr class="my-4">
                <p class="lead">
                    <?php
                    //overall rating
                    $totalReviews =0;
                    $totalRating = 0;
                    $conn = new mysqli("localhost", "group6", "fall2017188953", "group6");

                    if($conn->connect_error){
                        die("Connection failed : " . $conn->connect_error);
                    }
                    $query = $conn->prepare("SELECT Post.rating FROM Post WHERE Post.eateryID = 4");
                    $query->execute();
                    $query->bind_result($rating);
                    while($query->fetch()){
                        $totalReviews++;
                        $totalRating += $rating;
                    }
                    echo "Overall Rating " . $totalRating / $totalReviews . " / " . "5";
                    echo "<br><br>";
                    if($username == ""){
                        echo "<a class='btn btn-primary btn-lg' href='../loginPage.php' role='button'>Log In to Contribute!</a>";
                    }else{
                        echo "<a class='btn btn-primary btn-lg' href='../posts/review.php?eateryID=4' role='button'>Leave a review!</a>";
                    }
                    ?>
                </p>
            </div>
        </div>
    </div>
    <div class="row">
    <div class="col-md-12">
            <div class="jumbotron">
            <h2>Recent Reviews</h2>
            <hr>
            <?php
            //get reviews
            $conn2 = new mysqli("localhost", "group6", "fall2017188953", "group6");

            if($conn2->connect_error){
                die("Connection failed : " . $conn->connect_error);
            }
            $query2 = $conn2->prepare("SELECT Post.postID, Post.title, Post.review, Post.rating, User.userName, Eatery.eateryName, Post.time, Post.userID, Post.helpful FROM Post INNER JOIN Eatery ON Post.eateryID = Eatery.eateryID INNER JOIN User ON Post.userID = User.userID WHERE Post.eateryID = 4 ORDER BY Post.time DESC");
            $query2->execute();
            $query2->bind_result($postID, $title, $review, $rating, $user, $eateryName, $date, $userID, $helpful);

            while($query2->fetch()){
                echo "            
                        <div>
                        <h3>$title</h3>
                        <p>$review</p>
                        <p>Overall rating: $rating / 5</p>
                        <p>Posted by: $user on $date</p>
                        <p><i>$helpful users found this post helpful</i></p>
                        <input type='hidden' name='postID' value='$postID'>
                        " ;
                if ($username != ""){
                    echo "<a class='btn btn-success' href='../posts/helpful.php?post=$postID' role='button'>I found this post helpful</a>";
                }
                echo "<br>";
                if ($isAdmin == 1 || $_SESSION['userID'] == $userID){
                    echo "<a class='btn btn-primary' href='../posts/edit.php?post=$postID' role='button'>Edit Post</a>";
                    echo "<br>";
                    echo "<a class='btn btn-danger' href='../posts/delete.php?post=$postID' role='button'>Delete Post</a>";
                }
                echo "</div><hr>
                         ";
            }
            ?>
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