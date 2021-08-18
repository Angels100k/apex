var b1;
var b2;
var ba1;
var ba2;
var a1;
var a2;
var aa1;
var aa2;

function datums(data, name, f) {
    if (f == 1) {
        b1 = data;
        ba1 = name
    }
    if (f == 2) {
        b2 = data;
        ba2 = name;
    }
    if (f == 3) {
        var number3 = data;
        var name3 = name;
        google.charts.load('current', {
            'packages': ['corechart']
        });
        google.charts.setOnLoadCallback(function () {
            drawChart(b1, b2, number3, ba1, ba2, name3)
        });
    }
}

function datumsarenas(data, name, f) {
    if (f == 1) {
        a1 = data;
        aa1 = name
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
            drawChartArenas(a1, n2, number3, aa1, na2, name3)
        });
    }
}

function datums2(data, name, f) {
    if (f == 1) {
        a1 = data;
        aa1 = name
    }
    if (f == 2) {
        n2 = data;
        na2 = name;
        google.charts.load('current', {
            'packages': ['corechart']
        });
        google.charts.setOnLoadCallback(function () {
            drawChart2(a1, n2, aa1, na2)
        });
    }
}

function drawChartArenas(a1, n2, number3, aa1, na2, name3) {
    data1 = new google.visualization.DataTable();
    data1.addColumn({
        label: 'datum'
    });
    data1.addColumn({
        label: aa1,
        type: 'number'
    });
    data1.addRows(JSON.parse(a1));

    data2 = new google.visualization.DataTable();
    data2.addColumn({
        label: 'datum'
    });
    data2.addColumn({
        label: na2,
        type: 'number'
    });
    data2.addRows(JSON.parse(n2));
    var joia1 = google.visualization.data.join(data1, data2, 'full', [
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
    var join2 = google.visualization.data.join(joia1, data3, 'full', [
        [0, 0]
    ], [1, 2], [1]);
    var chart = new google.visualization.LineChart(document.getElementById('arenas_chart'));
    var options = {
        title: 'Arenas',
        legend: {
            position: 'bottom'
        }
    };
    chart.draw(join2, options);
}

function drawChart(a1, n2, number3, aa1, na2, name3) {
    data1 = new google.visualization.DataTable();
    data1.addColumn({
        label: 'datum'
    });
    data1.addColumn({
        label: aa1,
        type: 'number'
    });
    data1.addRows(JSON.parse(a1));

    data2 = new google.visualization.DataTable();
    data2.addColumn({
        label: 'datum'
    });
    data2.addColumn({
        label: na2,
        type: 'number'
    });
    data2.addRows(JSON.parse(n2));
    var joia1 = google.visualization.data.join(data1, data2, 'full', [
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
    var join2 = google.visualization.data.join(joia1, data3, 'full', [
        [0, 0]
    ], [1, 2], [1]);
    var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));
    var options = {
        title: 'Battle royale',
        legend: {
            position: 'bottom'
        }
    };
    chart.draw(join2, options);
}

function drawChart2(a1, n2, aa1, na2) {
    data1 = new google.visualization.DataTable();
    data1.addColumn({
        label: 'datum'
    });
    data1.addColumn({
        label: aa1,
        type: 'number'
    });
    data1.addRows(JSON.parse(a1));

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
        title: 'Battle royale',
        legend: {
            position: 'bottom'
        }
    };
    chart.draw(join2, options);
}