<?php
// $conn = new mysqli('localhost', 'root', '', 'apexstats');
$conn = new mysqli('sql201.hostingdiscounter.nl', 'apexAdmin', '4jPNkCr6ap', 'apexstats');
function GetCodes (){
    global $conn;
    $codes = array();
    $sql = "SELECT * FROM person ORDER BY Points DESC";
    $resultaat = $conn->query($sql);
    $resultaat->data_seek(0);
    while($code = $resultaat->fetch_assoc()) {
        $codes[] = $code;
    }
    return $codes;
}
function GetCodesarenas (){
    global $conn;
    $codes = array();
    $sql = "SELECT * FROM person ORDER BY Pointsarenas DESC";
    $resultaat = $conn->query($sql);
    $resultaat->data_seek(0);
    while($code = $resultaat->fetch_assoc()) {
        $codes[] = $code;
    }
    return $codes;
}
