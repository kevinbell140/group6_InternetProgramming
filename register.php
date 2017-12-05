<?php
//security
$username = $_POST["username"];
$password = $_POST["password"];
$isAdmin = 0;

$conn2 = new mysqli("localhost", "group6", "fall2017188953", "group6");

if($conn2->connect_error){
    die("Connection failed : " . $conn->connect_error);
}
//stores new user info
$query2 = $conn2->prepare("INSERT INTO User (userName, userPass, isAdmin) VALUES (?,?,?);");

$query2->bind_param("ssi", $username, $password, $isAdmin);

if($query2->execute() === TRUE){
    echo "You are now registered";
}else{
    echo "Error: " . $query . "<br>" . $conn->error;
}

$query2->close();
$conn2->close();
header("Location: loginPage.php");