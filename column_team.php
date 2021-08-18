<?php

include 'conn.php';
session_start(); 
if($_SESSION["ID"]){

}else{
  header("Location: index");
}
$data[] = array('Employee','Markes', 'Name');
//$sql = "select * from punten WHERE Account = ".$_SESSION['ID']." order by Datum ASC";

$sql = "SELECT p2.Datum , p2.Punten, p.Name  
FROM team t 
INNER JOIN person p ON t.ID = p.Team 
INNER JOIN punten p2 on p2.Account = p.ID
WHERE t.ID = 1
ORDER BY  3, 1";

$result = $conn->query($sql);
if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    $data[] = array($row['Datum'],(int)$row['Punten'], $row['Name'] );
  }
}
echo json_encode($data);

?>