var n1;
var n2;
var na1;
var na2;

function datums(data, name, f) {
    if (f == 1) {
        n1 = data;
        na1 = name
    }
    if (f == 2) {
        n2 = data;
        na2 = name;
    }
    if (f == 3) {
        var number3 = data;
        var name3 = name;
        google.charts.load('current', {
            'packages': ['corechart']
        });
        google.charts.setOnLoadCallback(function () {
            drawChart(n1, n2, number3, na1, na2, name3)
        });
    }
}

function datums2(data, name, f) {
    if (f == 1) {
        n1 = data;
        na1 = name
    }
    if (f == 2) {
        n2 = data;
        na2 = name;
        google.charts.load('current', {
            'packages': ['corechart']
        });
        google.charts.setOnLoadCallback(function () {
            drawChart2(n1, n2, na1, na2)
        });
    }
}

function drawChart(n1, n2, number3, na1, na2, name3) {
    data1 = new google.visualization.DataTable();
    data1.addColumn({
        label: 'datum'
    });
    data1.addColumn({
        label: na1,
        type: 'number'
    });
    data1.addRows(JSON.parse(n1));

    data2 = new google.visualization.DataTable();
    data2.addColumn({
        label: 'datum'
    });
    data2.addColumn({
        label: na2,
        type: 'number'
    });
    data2.addRows(JSON.parse(n2));
    var join1 = google.visualization.data.join(data1, data2, 'full', [
        [0, 0]
    ], [1], [1]);

    data3 = new google.visualization.DataTable();
    data3.addColumn({
        label: 'datum'
    });
    data3.addColumn({
        label: name3,
        type: 'number'
    });
    data3.addRows(JSON.parse(number3));
    var join2 = google.visualization.data.join(join1, data3, 'full', [
        [0, 0]
    ], [1, 2], [1]);
    var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));
    var options = {
        title: 'Team Performance',
        legend: {
            position: 'bottom'
        }
    };
    chart.draw(join2, options);
}

function drawChart2(n1, n2, na1, na2) {
    data1 = new google.visualization.DataTable();
    data1.addColumn({
        label: 'datum'
    });
    data1.addColumn({
        label: na1,
        type: 'number'
    });
    data1.addRows(JSON.parse(n1));

    data2 = new google.visualization.DataTable();
    data2.addColumn({
        label: 'datum'
    });
    data2.addColumn({
        label: na2,
        type: 'number'
    });
    data2.addRows(JSON.parse(n2));

    var join2 = google.visualization.data.join(data1, data2, 'full', [
        [0, 0]
    ], [1], [1]);
    var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));
    var options = {
        title: 'Team Performance',
        legend: {
            position: 'bottom'
        }
    };
    chart.draw(join2, options);
}