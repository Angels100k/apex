<?php 
// connect met de db
include 'conn.php';
session_start();

if($_SESSION["ID"]){
}else{
  header("Location: index");
}
?>
<!DOCTYPE html>
<html lang="nl">
<link rel="stylesheet" href="style/adminpanel.css">
<!-- plaatst de head van de site -->
<?php include_once 'head.php'?>

<body>

  <div class="main mx-auto container">
    <h2 style="text-align: center; font-weight: bold;">Points Panel</h2>
    <div id="line_chart" style="height:200px;" class="col-12 mx-auto"></div>
    <br>
    <h2 style="text-align: center; font-weight: bold;">battle royale</h2>
    <form action="" method="POST"  class="col-12 mx-auto form-row" id="inputForm" name="Inputform">
    <div class="form-group col-sm-6">
      <label>Punten</label>
      <input type="text" class="form-control" id="Punten" name="Punten" required>
    </div>
    <div class="form-group col-sm-6 mx-auto">
      <label>Datum</label>
      <input type="date" id="date"  class="form-control" name="date" onchange="selectDate(this.value)">
    </div>

    <input type="submit" class="btn-submit mx-auto d-block px-5 btn-bg mt-5 btn-lg border-0 rounded" name="verstuur" value="Opsturen naar DB">
    <a href="/team" style="color:black; " class="btn-submit mx-auto d-block px-5 btn-bg mt-5 btn-lg border-0 rounded" >Team</a>

    </form>
    <h2 style="text-align: center; font-weight: bold;">Arenas</h2>
    <form action="" method="POST"  class="col-12 mx-auto form-row" id="inputFormArenas" name="inputFormArenas">
    <div class="form-group col-sm-6">
      <label>Punten</label>
      <input type="text" class="form-control" id="PuntenArenas" name="PuntenArenas" required>
    </div>
    <div class="form-group col-sm-6 mx-auto">
      <label>Datum</label>
      <input type="date" id="dateArenas"  class="form-control" name="dateArenas" onchange="selectDateArenas(this.value)">
    </div>

    <input type="submit" class="btn-submit mx-auto d-block px-5 btn-bg mt-5 btn-lg border-0 rounded" name="verstuur" value="Opsturen naar DB">

    </form>
    <div class="row mt-3">
      <div class="col-6"><h3>Current rank:</h3></div>
      <div class="col-6"><h3>Calculated rank:</h3></div>
    </div>
    <div class="row mt-3">
      <div class="col-6" id="rank">
        <img id="CurentRank" src="" />
      </div>
      <div class="col-6" id="think_rank">
      <img id="ThinkRank" src="" /></div>
    </div>
    <script src="js/account.js"></script>
    <script>
      function line_chart() {
        var jsonData = $.ajax({
          url: 'column_chart.php',
          dataType: "json",
          async: false,
          success: function (jsonData) {
            var options = {
              legend: {
                position: 'bottom'
              },
              pointSize: 7,
              dataOpacity: 0.3
            };
            data1 = new google.visualization.DataTable();
            data1.addColumn({
              label: 'datum'
            });
            data1.addColumn({
              label: 'battle royale',
              type: 'number'
            });
            data1.addRows(jsonData[0]);

            data2 = new google.visualization.DataTable();
            data2.addColumn({
              label: 'datum'
            });
            data2.addColumn({
              label: 'Arenas',
              type: 'number'
            });
            data2.addRows(jsonData[1]);

            var join2 = google.visualization.data.join(data1, data2, 'full', [[0, 0]], [1], [1]);
            var chart = new google.visualization.LineChart(document.getElementById('line_chart'));
            var options = {
              title: 'Team Performance',
              legend: {
                position: 'bottom'
              }
            };
            chart.draw(join2, options);
          }
        }).responseText;
      }
      $.get("https://api.mozambiquehe.re/bridge?version=5&platform=PC&player=<?= $_SESSION["name"] ?>&auth=C2fxwdoK2Mlt4CNXiUuP",
  function (data) {
    const obj = JSON.parse(data);
    post(obj)
  });

function post(obj) {
  var today = new Date();
  var dd = String(today.getDate()).padStart(2, '0');
  var mm = String(today.getMonth() + 1).padStart(2, '0');
  var yyyy = today.getFullYear();
  // place it together and put it in the date area of the form
  today = yyyy + '-' + mm + '-' + dd;
  $.ajax({
    type: "POST",
    url: "form.php",
    data: {
      Punten: obj["global"]["rank"]["rankScore"],
      date: today, // Second add quotes on the value.
    }, // serializes the form's elements.
    //  when it is a sucsess so this with the data it got back
    success: function (data) {
      //  it gets a JSON string back so we need to parse it
      var dataJSON = JSON.parse(data);
      $('#Punten').val(dataJSON.Punten);
      $('#PuntenArenas').val(obj["global"]["arena"]["rankScore"]);
      google.charts.load('current', {
        'packages': ['corechart']
      });
      google.charts.setOnLoadCallback(line_chart);
    }
  });
  $.ajax({
    type: "POST",
    url: "formArenas.php",
    data: {
      PuntenArenas: obj["global"]["arena"]["rankScore"],
      dateArenas: today, // Second add quotes on the value.
    }, // serializes the form's elements.
    //  when it is a sucsess so this with the data it got back
    success: function (data) {
      //  it gets a JSON string back so we need to parse it
      var dataJSON = JSON.parse(data);
      $('#PuntenArenas').val(dataJSON.Punten);
      google.charts.load('current', {
        'packages': ['corechart']
      });
      google.charts.setOnLoadCallback(line_chart);
    }
  });
}
    </script>
  </div>
</body>

</html>