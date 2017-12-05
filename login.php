<?php
//security
session_start();

$username = $_POST["username"];
$password = $_POST["password"];

$conn = new mysqli("localhost", "group6", "fall2017188953", "group6");

if($conn->connect_error){
    die("Connection failed : " . $conn->connect_error);
}


$query = $conn->prepare("SELECT userID, userPass, isAdmin FROM User WHERE userName=?;");
$query->bind_param('s', $username);
$query->execute();
$query->bind_result($userID, $userpass, $isAdmin);

//sets login session
if ($query->fetch() != null){
    if ($userpass === $password){
        $_SESSION['userID'] = $userID;
        $_SESSION['username'] = $username;
        $_SESSION['isAdmin'] = $isAdmin;

        header("Location: index.php");
    }else{
        header("Location: loginPage.php?error=1");
    }
}else{
    header("Location: loginPage.php?error=1");
}

$query->close();
$conn->close();
?>