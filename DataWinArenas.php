<?php
// connects to the db
include 'conn.php';
session_start();
if($_SESSION["ID"]){

}else{
  header("Location: index");
}
// gets to info from the post
$date = $_POST["text"];

// is it couldn't connect to db die
if (!$conn) {
  die('Could not connect: ' . mysqli_error($conn));
}

// selects the info of the date selected
mysqli_select_db($conn,"ajax_demo");
$sql="SELECT Punten FROM `puntenarenas` WHERE `Datum` = '".$date."' AND `Account` = ". $_SESSION["ID"] ."";
$result = mysqli_query($conn,$sql);
if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    $Punten = $row['Punten'];
    echo '{"Punten": '. $Punten .'}';
  }
} else {
  // if no records could be found send back 0
    echo '{"Punten": 0}';
}
// close connection
mysqli_close($conn);