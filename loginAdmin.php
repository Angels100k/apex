<?php
// connect to db
include 'conn.php';
session_start(); 


// extrect the info from the post
$username = $_POST["username"];
$password = $_POST["password"];
 
// select info from db where date is $date
$sql = 'SELECT * FROM `person` WHERE `Name` = "'. strtolower($username) .'"';
    $result = $conn->query($sql);

if ($result->num_rows > 0) {
  // if the num rows is more then 0 do this
  while($row = $result->fetch_assoc()) {
    // update the db where the date is the date of today
    if(password_verify($password, $row['Password'])) {
     $_SESSION["ID"] = $row['ID']; 
     $_SESSION["team"] = $row['Team']; 
     $_SESSION["name"] = $_POST['username']; 
     $info = $row;
     $sql = "UPDATE person SET ip='".$_SERVER['REMOTE_ADDR']."' WHERE id=".$_SESSION["ID"];
     if ($conn->query($sql) === TRUE) {
      echo json_encode($info);
    } 
    }
  }
}
$conn->close();
