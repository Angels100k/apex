<?php
// connect to db
include 'conn.php';
session_start();
if($_SESSION["ID"]){

}else{
  header("Location: index");
}
// extrect the info from the post
$Punten = $_POST["Punten"];
$date = $_POST["date"];

// select info from db where date is $date
$sql = 'SELECT * FROM `punten` WHERE Datum = "'.$date.'" AND `Account` = '. $_SESSION["ID"] .'';
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // if the num rows is more then 0 do this
  while($row = $result->fetch_assoc()) {
    // update the db where the date is the date of today
    $sql = "UPDATE punten SET punten='".$Punten."' WHERE `Datum`='".$date."' AND `Account` = ". $_SESSION["ID"] ."";

    // checks if it has been done correctly
    if ($conn->query($sql) === TRUE) {
    } else {
      echo "Error updating record: " . $conn->error;
    }
    echo '{"Punten": '. $Punten .'}';

  }
} else {
  // if the num rows is 0 do this
  // insert it into a new value 
  $sql = "INSERT INTO punten (Punten, Datum, Account)
  VALUES (".$Punten.", '".$date."', ". $_SESSION["ID"] .")";
  // echo it back to admin page
  if ($conn->query($sql) === TRUE) {
      echo '{"Punten": '. $Punten .'}';
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
}

$conn->close();