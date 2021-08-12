<?php 
session_start(); 
include 'conn.php';
function home() {
  header("Location: index");
}
if($_SESSION["ID"]){
}else{
home();
}
$sql = "SELECT `Name` FROM person WHERE Team = " . $_SESSION['team'] . "";
$result = $conn->query($sql);

// echo '<script> var team = "' . $result->num_rows . '";</script>';
// echo '<script> var team = "1";</script>';
?>
<!DOCTYPE html>
<html lang="en">
<script src="js/team-min.js"></script>
<script>
    var f = 0;
  var i = 0;
  var data1;
  var data2;
  var join1;
</script>
<?php
include_once 'head.php';
if ($result->num_rows > 0 && $result->num_rows != 1 && $result->num_rows <= 3) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    if($result->num_rows == 3){
      echo '<script>
      $.ajax({
          type: "POST",
          data:{
              Name: "'.$row['Name'].'", // Second add quotes on the value.
            },
          url: "testJson.php",
          //  when it is a sucsess so this with the data it got back
          success: function(data)
          {
            var name = "'.$row['Name'].'"
            f++;
              datums(data, name, f);
          }
        });
      </script>';
    }else if($result->num_rows == 2){
      echo '<script>
      $.ajax({
          type: "POST",
          data:{
              Name: "'.$row['Name'].'", // Second add quotes on the value.
            },
          url: "testJson.php",
          //  when it is a sucsess so this with the data it got back
          success: function(data)
          {
            var name = "'.$row['Name'].'"
            f++;
            datums2(data, name, f);
          }
        });
      </script>';
    }
  }
}else {
home();
}
$sql = "SELECT `Name` FROM person WHERE Team = " . $_SESSION['team'] . "";
$result = $conn->query($sql);
$account = ["JYvFYGTeSpGsaSNnd42s", "0R8oa7UibTh1cK8Jra4b", "F1zhVtCPn2uIE3M3OQ1U"];
if ($result->num_rows > 0) {
    $i = 0;
    // output data of each row
    while($row = $result->fetch_assoc()) {
        ?>
           <script async >
                $.get( "https://api.mozambiquehe.re/bridge?version=5&platform=PC&player=<?php echo $row["Name"]?>&auth=<?php echo $account[$i] ?>", function( data ) {
                    //   $( ".result" ).html( data );
                    const obj = JSON.parse(data);
                    $("#row").append('<div class="col-sm order-<?php echo $i ?>"><div class="card"><img src="'+ obj["global"]["avatar"]+'" alt="John" style="width:100%"><h1>'+ obj["global"]["name"]+'</h1><p class="title">'+ obj["global"]["level"]+'</p><div id="myProgress" style="width: 100%;background-color: #ddd;"><div id="myBar" style="width: '+ obj["global"]["toNextLevelPercent"]+'%;height: 30px;background: linear-gradient(to right,#6065d9,#17d7fa);text-align: center;line-height: 30px;color: white;">'+ obj["global"]["toNextLevelPercent"]+'%</div></div><h2>Battle royale</h2><p>'+ obj["global"]["rank"]["rankScore"]+'</p><img src="'+ obj["global"]["rank"]["rankImg"]+'" alt="John"style="width:50%; margin-left: auto; margin-right: auto;"><h2>Arena</h2><p>'+ obj["global"]["arena"]["rankScore"]+'</p> <img src="'+ obj["global"]["arena"]["rankImg"]+'"alt="John" style="width:50%; margin-left: auto; margin-right: auto;"></div></div>');
                });
            </script>
        <?php
        $i++;
    }
  } else {
    echo "0 results";
  }
?> 
<!-- <link rel="stylesheet" href="style/team-min.css"/> -->

<body>
<?php include_once 'background.php'?>
<?php include_once 'navbar.php'?>

<div class="container mb-3">
<div id="curve_chart">
</div>
</div>
<div class="container">
<div id="row" class="row">
    </div>
</div>
</body>
</html>