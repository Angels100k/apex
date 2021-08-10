function checkRank(points, json) {
  var rankedPoints = [];
  for (i = 1; i < (json[0].length - 1); i++) {
    if (i > 1) {
      rankedPoints.push(json[0][i][1])
    }
  }

  var myBirthday, today, bday, diff, days;
  myBirthday = [9, 21];
  today = new Date();
  bday = new Date(today.getFullYear(), myBirthday[1] - 1, myBirthday[0]);
  if (today.getTime() > bday.getTime()) {
    bday.setFullYear(bday.getFullYear() + 1);
  }
  diff = bday.getTime() - today.getTime();
  days = Math.floor(diff / (1000 * 60 * 60 * 24));
  var cal = ((rankedPoints[rankedPoints.length - 1] - rankedPoints[0]) / rankedPoints.length) * 0.939
  test2 = rankedPoints[rankedPoints.length - 1] + (cal * days + rankedPoints.length);
  checkPoints(Math.floor(test2), 'ThinkRank')

}

function checkPoints(points, place) {
  if (points >= 0 && points < 300) {
    $("#" + place).attr('src', 'Apex_Ranks/Bronze/Bronze_4.png')
  } else if (points >= 300 && points < 600) {
    $("#" + place).attr('src', 'Apex_Ranks/Bronze/Bronze_3.png')
  } else if (points >= 600 && points < 900) {
    $("#" + place).attr('src', 'Apex_Ranks/Bronze/Bronze_2.png')
  } else if (points >= 900 && points < 1200) {
    $("#" + place).attr('src', 'Apex_Ranks/Bronze/Bronze_1.png')
  } else if (points >= 1200 && points < 1600) {
    $("#" + place).attr('src', 'Apex_Ranks/Silver/Silver_4.png')
  } else if (points >= 1600 && points < 2000) {
    $("#" + place).attr('src', 'Apex_Ranks/Silver/Silver_3.png')
  } else if (points >= 2000 && points < 2400) {
    $("#" + place).attr('src', 'Apex_Ranks/Silver/Silver_2.png')
  } else if (points >= 2400 && points < 2800) {
    $("#" + place).attr('src', 'Apex_Ranks/Silver/Silver_1.png')
  } else if (points >= 2800 && points < 3300) {
    $("#" + place).attr('src', 'Apex_Ranks/Gold/Gold_4.png')
  } else if (points >= 3300 && points < 3800) {
    $("#" + place).attr('src', 'Apex_Ranks/Gold/Gold_3.png')
  } else if (points >= 3800 && points < 4300) {
    $("#" + place).attr('src', 'Apex_Ranks/Gold/Gold_2.png')
  } else if (points >= 4300 && points < 4800) {
    $("#" + place).attr('src', 'Apex_Ranks/Gold/Gold_1.png')
  } else if (points >= 4800 && points < 5400) {
    $("#" + place).attr('src', 'Apex_Ranks/Platinum/Platinum_4.png')
  } else if (points >= 5400 && points < 6000) {
    $("#" + place).attr('src', 'Apex_Ranks/Platinum/Platinum_3.png')
  } else if (points >= 6000 && points < 6600) {
    $("#" + place).attr('src', 'Apex_Ranks/Platinum/Platinum_2.png')
  } else if (points >= 6600 && points < 7200) {
    $("#" + place).attr('src', 'Apex_Ranks/Platinum/Platinum_1.png')
  } else if (points >= 7200 && points < 7900) {
    $("#" + place).attr('src', 'Apex_Ranks/Diamond/Diamond_4.png')
  } else if (points >= 7900 && points < 8600) {
    $("#" + place).attr('src', 'Apex_Ranks/Diamond/Diamond_3.png')
  } else if (points >= 8600 && points < 9300) {
    $("#" + place).attr('src', 'Apex_Ranks/Diamond/Diamond_2.png')
  } else if (points >= 9300 && points < 10000) {
    $("#" + place).attr('src', 'Apex_Ranks/Diamond/Diamond_1.png')
  } else if (points >= 10000) {
    $("#" + place).attr('src', 'Apex_Ranks/Master/Master.png')
  } else {
    $("#" + place).attr('src', 'img/error2.png')
  }
}
// when form is being submitted
$("#inputForm").submit(function (e) {
  // stops from acutlly posting the post so we can use ajax insted
  e.preventDefault();

  var form = $(this);
  // posts a ajax call to form.php
  $.ajax({
    type: "POST",
    url: "form.php",
    data: form.serialize(), // serializes the form's elements.
    //  when it is a sucsess so this with the data it got back
    success: function (data) {
      //  it gets a JSON string back so we need to parse it
      var dataJSON = JSON.parse(data);
      $('#Punten').val(dataJSON.Punten);
      google.charts.load('current', {
        'packages': ['corechart']
      });
      google.charts.setOnLoadCallback(line_chart);
    }
  });
});
$("#inputFormArenas").submit(function (e) {
  // stops from acutlly posting the post so we can use ajax insted
  e.preventDefault();

  var form = $(this);
  // posts a ajax call to form.php
  $.ajax({
    type: "POST",
    url: "formArenas.php",
    data: form.serialize(), // serializes the form's elements.
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
});
// when a new date is selected execute this function
function selectDate(str) {
  // send a ajax post request to DataWin.php
  $.ajax({
      method: "POST",
      url: "DataWin.php",
      // send the string in a var $_POST["text"]
      data: {
        text: str
      }
    })
    // when its done do this with the response back from datawin.php
    .done(function (response) {
      var points = JSON.parse(response).Punten;
      checkPoints(points, 'CurentRank');
      var dataJSON = JSON.parse(response);
      $('#Punten').val(dataJSON.Punten);
    });
}

function selectDateArenas(str) {
  // send a ajax post request to DataWin.php
  $.ajax({
      method: "POST",
      url: "DataWinArenas.php",
      // send the string in a var $_POST["text"]
      data: {
        text: str
      }
    })
    // when its done do this with the response back from datawin.php
    .done(function (response) {
      var dataJSON = JSON.parse(response);
      $('#PuntenArenas').val(dataJSON.Punten);
    });
}
// when you get on the page execute this
$(document).ready(function () {
  // get the date of today
  var today = new Date();
  var dd = String(today.getDate()).padStart(2, '0');
  var mm = String(today.getMonth() + 1).padStart(2, '0');
  var yyyy = today.getFullYear();
  // place it together and put it in the date area of the form
  today = yyyy + '-' + mm + '-' + dd;
  $("#date").val(today);
  $("#dateArenas").val(today);
});


google.charts.load('current', {
  'packages': ['corechart']
});
google.charts.setOnLoadCallback(line_chart);

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
      points = jsonData[0][(jsonData[0].length - 1)][1]
      var join2 = google.visualization.data.join(data1, data2, 'full', [
        [0, 0]
      ], [1], [1]);
      checkPoints(points, 'CurentRank');
      checkRank(points, jsonData);
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