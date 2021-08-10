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
                    $("#row").append('<div class="col-sm order-<?php echo $i ?>"><div class="card"><img src="'+ obj["global"]["avatar"]+'" alt="John" style="width:100%"><h1>'+ obj["global"]["name"]+'</h1><p class="title">'+ obj["global"]["level"]+'</p><h2>Battle royale</h2><p>'+ obj["global"]["rank"]["rankScore"]+'</p><img src="'+ obj["global"]["rank"]["rankImg"]+'" alt="John" style="width:50%; margin-left: auto; margin-right: auto;">        <h2>Arena</h2>        <p>'+ obj["global"]["arena"]["rankScore"]+'</p>        <img src="'+ obj["global"]["arena"]["rankImg"]+'" alt="John" style="width:50%; margin-left: auto; margin-right: auto;">  <h2>Account info</h2>        <p>'+obj["total"]["kills"]["name"] + ": "+ obj["total"]["kills"]["value"]+'</p> <p>'+obj["total"]["damage"]["name"] + ": "+ obj["total"]["damage"]["value"]+'</p>  </div></div>');
                });
            </script>
        <?php
        $i++;
    }
  } else {
    echo "0 results";
  }
?> 
<style>
    .card {
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
        max-width: 300px;
        margin: auto;
        text-align: center;
    }

    .title {
        color: grey;
        font-size: 18px;
    }

    button {
        border: none;
        outline: 0;
        display: inline-block;
        padding: 8px;
        color: white;
        background-color: #000;
        text-align: center;
        cursor: pointer;
        width: 100%;
        font-size: 18px;
    }

    a {
        text-decoration: none;
        font-size: 22px;
        color: black;
    }

    button:hover,
    a:hover {
        opacity: 0.7;
    }
</style>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script>
  var f = 0;
  var i = 0;
  var data1;
  var data2;
  var join1;

</script>
<body>
<div id="curve_chart"></div>
<div class="container">
<div id="row" class="row">
    </div>
</div>
<div class="container">
  <div class="row">
    <div class="col text-center">
    </div>
    <div class="col text-center">
      <a href="/account" style="color:black; " class="btn-submit mx-auto d-block px-5 btn-bg mt-5 btn-lg border-0 rounded" >Account</a>
    </div>
    <div class="col text-center">
    </div>
  </div>
</div>
    <script>
        var number1;
        var number2;
        var name1;
        var name2;
    function datums(data, name, f){
      if(f == 1){
        number1 = data;
        name1 = name
      }
      if(f == 2){
        number2 = data;
        name2 = name;
      }
      if(f == 3){
        var number3 = data;
        var name3 = name;
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(function(){drawChart(number1, number2, number3, name1, name2, name3)});
      }
    }
    function datums2(data, name, f){
      if(f == 1){
        number1 = data;
        name1 = name
      }
      if(f == 2){
        number2 = data;
        name2 = name;
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(function(){drawChart2(number1, number2, name1, name2)});
      }
    }
    function drawChart(number1, number2, number3, name1, name2, name3) {
        data1 = new google.visualization.DataTable();
        data1.addColumn({label: 'datum'});
        data1.addColumn({label: name1, type: 'number'});
        data1.addRows(JSON.parse(number1));

        data2 = new google.visualization.DataTable();
        data2.addColumn({label: 'datum'});
        data2.addColumn({label: name2, type: 'number'});
        data2.addRows(JSON.parse(number2));
        var join1 = google.visualization.data.join(data1, data2, 'full', [[0,0]], [1], [1]);

        data3 = new google.visualization.DataTable();
        data3.addColumn({label: 'datum'});
        data3.addColumn({label: name3, type: 'number'});
        data3.addRows(JSON.parse(number3));
        var join2 = google.visualization.data.join(join1, data3, 'full', [[0,0]], [1,2], [1]);
        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));
        var options = {
          title: 'Team Performance',
          legend: { position: 'bottom' }
        };
        chart.draw(join2, options);
    }
    function drawChart2(number1, number2, name1, name2) {
        data1 = new google.visualization.DataTable();
        data1.addColumn({label: 'datum'});
        data1.addColumn({label: name1, type: 'number'});
        data1.addRows(JSON.parse(number1));

        data2 = new google.visualization.DataTable();
        data2.addColumn({label: 'datum'});
        data2.addColumn({label: name2, type: 'number'});
        data2.addRows(JSON.parse(number2));

        var join2 = google.visualization.data.join(data1, data2, 'full', [[0,0]], [1], [1]);
        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));
        var options = {
          title: 'Team Performance',
          legend: { position: 'bottom' }
        };
        chart.draw(join2, options);
    }
    </script>
</body>
</html>