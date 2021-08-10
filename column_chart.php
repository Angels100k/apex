<?php

include 'conn.php';
session_start(); 
if($_SESSION["ID"]){

}else{
  header("Location: index");
}
// $completedata[] = array('BR','Arenas');

$sql = "select * from punten WHERE Account = ".$_SESSION['ID']." order by Datum ASC";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    $data[] = array($row['Datum'],(int)$row['Punten']);
  }
}

$sql = "select * from puntenarenas WHERE Account = ".$_SESSION['ID']." order by Datum ASC";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    $data2[] = array($row['Datum'],(int)$row['Punten']);
  }
}
$completedata = array($data, $data2);
echo json_encode($completedata);
// var_dump($data);

?>