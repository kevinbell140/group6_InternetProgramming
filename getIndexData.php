<?php
//security
session_start();
$username = $_SESSION['username'];
$isAdmin = $_SESSION['isAdmin'];
$selection = $_GET['selection'];
$conn2 = new mysqli("localhost", "group6", "fall2017188953", "group6");

if($conn2->connect_error){
    die("Connection failed : " . $conn2->connect_error);
}
//gets correct posts
if($selection == 'all'){
    $query2 = $conn2->prepare("SELECT Post.postID, Post.title, Post.review, Post.rating, User.userName, Eatery.eateryName, Post.time, Post.userID, Post.helpful FROM Post INNER JOIN Eatery ON Post.eateryID = Eatery.eateryID INNER JOIN User ON Post.userID = User.userID ORDER BY Post.time DESC");
}else{
    $query2 = $conn2->prepare("SELECT Post.postID, Post.title, Post.review, Post.rating, User.userName, Eatery.eateryName, Post.time, Post.userID, Post.helpful FROM Post INNER JOIN Eatery ON Post.eateryID = Eatery.eateryID INNER JOIN User ON Post.userID = User.userID WHERE Post.eateryID = ? ORDER BY Post.time DESC");
    $query2->bind_param("i", $selection);
}

$query2->execute();
$query2->bind_result($postID, $title, $review, $rating, $user, $eateryName, $date, $userID, $helpful);
//displays posts
while($query2->fetch()){
    echo "            
                    <div>
                    <h3>$eateryName</h3>
                    <h3>$title<h3></h3>
                    <p>$review</p>
                    <p>Overall rating: $rating / 5</p>
                    <p>Posted by: $user on $date</p>
                    <p><i>$helpful users found this post helpful</i></p>
                    <input type='hidden' name='postID' value='$postID'>
                    " ;
    if ($username != ""){
        echo "<a class='btn btn-success' href='posts/helpful.php?post=$postID' role='button'>I found this post helpful</a>";
    }
    echo "<br>";
    if ($isAdmin == 1 || $_SESSION['userID'] == $userID){
        echo "<a class='btn btn-primary' href='posts/edit.php?post=$postID' role='button'>Edit Post</a>";
        echo "<br>";
        echo "<a class='btn btn-danger' href='posts/delete.php?post=$postID' role='button'>Delete Post</a>";
    }
    echo "</div><hr>
                     ";
}
?>