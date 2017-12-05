<?php

session_start();
$username = $_SESSION['username'];
$isAdmin = $_SESSION['isAdmin'];
if ($username == ''){
    header("Location: ../index.php");
}

$postID = $_GET['post'];

$conn2 = new mysqli("localhost", "group6", "fall2017188953", "group6");

if($conn2->connect_error){
    die("Connection failed: " . $conn->connect_error);
}

$query2 = $conn2->prepare("Select helpful, eateryID from Post WHERE postID=?");
$query2->bind_param("i", $postID);
$query2->execute();
$query2->bind_result($helpful, $eateryID);
while ($query2->fetch()){
    $helpful++;
};

$conn = new mysqli("localhost", "group6", "fall2017188953", "group6");

if($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
}

$query = $conn->prepare("UPDATE Post SET helpful = ? WHERE postID=?");
$query->bind_param("ii", $helpful, $postID);

if($query->execute() === TRUE){
    echo "Record updated successfully";
}else{
    echo "Error: " . $query . "<br>" . $conn->error;
}
$query->close();
$conn->close();
$conn2->close();

//redirect
switch($eateryID){
    case 1:
        header("Location: ../locations/cafeteria.php");
        break;
    case 2:
        header("Location: ../locations/ChickFilA.php");
        break;
    case 3:
        header("Location: ../locations/starbucks.php");
        break;
    case 4:
        header("Location: ../locations/papajohns.php");
        break;
    case 5:
        header("Location: ../locations/einsteinbagels.php");
        break;
    case 6:
        header("Location: ../locations/pitapit.php");
        break;
}