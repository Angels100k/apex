<?php 

include 'conn.php';
$sql = "SELECT p2.Datum, p2.Punten 
FROM team t 
INNER JOIN person p ON t.ID = p.Team 
INNER JOIN puntenarenas p2 on p2.Account = p.ID
WHERE t.ID = 1
AND p.Name = '".$_POST["Name"]."'
ORDER BY Datum 
";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // if the num rows is more then 0 do this
    while($row = $result->fetch_assoc()) {
        $data[] = array($row['Datum'],(int)$row['Punten']);
    }
  }else {
    $data[] = array(date("Y/m/d"),0);
  }

$json = json_encode($data);
echo $json;
