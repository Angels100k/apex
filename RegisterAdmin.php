<?php
// connect to db
include 'conn.php';
session_start(); 


// extrect the info from the post
$username = $_POST["username"];
$password = $_POST["adminpassword"];
 
// select info from db where date is $date
$sql = 'SELECT * FROM `person` WHERE `Name` = "'. strtolower($username) .'"';
    $result = $conn->query($sql);

if ($result->num_rows > 0) {
}else {
    $password = password_hash($password, PASSWORD_DEFAULT);
    $sql = "INSERT INTO person (`name`, `Password`)
    VALUES ('".$username."', '". $password ."')";
    
    if ($conn->query($sql) === TRUE) {
        echo "sucsess";
    } else {
    }
}
$conn->close();
