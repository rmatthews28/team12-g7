<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script src="http://code.jquery.com/jquery-1.9.0.min.js"></script>
<script src="http://code.highcharts.com/highcharts.src.js"></script>
<script src="http://code.highcharts.com/highcharts-more.src.js"></script>
<!--<div id="temp_div"></div>-->
<!--<div id="humidity_div"></div>-->
<!--<div id="airpressure_div"></div>-->
<!--<div id="rain_div"></div>-->
<!--<div id="winds_div"></div>-->
<!--<div id="windd_div"></div>-->
<!--<div id="solar_div"></div>-->
<!--<div id="windspeedgauge_div" style="width: 400px; height: 120px;"></div>-->
<!--<div id="airpressuregauge_div" style="width: 400px; height: 120px;"></div>-->
<!--<div id="windDirection_div" style="height: 250px; min-width: 500px"></div>-->


<?php
//main fucntion used for line graphs
function getLineGraphData($filepath)
{
    $handle = fopen($filepath, "r");
    if ($handle) {
        $i = 0;
        while($i < 2500) {
            /*while ((*/
            $line = fgets($handle);/*)) !== false) {*/
            // process the line read.
            $array = (explode(",", $line));
            $value = $array[1];
            $time = $array[2];
            $timeexplode = (explode(":", $time));
            $time2 = "[".$timeexplode[0].", ".$timeexplode[1].", ".substr($timeexplode[2], 0, 2)."]";
            $superArray[] = [$value, $time2];
            $i++;
        }
        return $superArray;
        fclose($handle);
    } else {
        //Error handling
    }
}
//gets the last line of the file, explodes into array, pulls the correct data
function getLastLine($filename)
{
    $line = trim(implode("", array_slice(file($filename), -1)));
    $array = (explode(",", $line));
    $value = $array[1];
    return $value;
}
//echo getLastLine("wind_d.txt");
//testing function
function getData2()
{
    $handle = file_get_contents("datatest.txt");
    $array = (explode(",", $handle));
    $value = $array[1];
    $time = $array[2];
    $timeexplode = (explode(":", $time));
    echo "[".$timeexplode[0].", ".$timeexplode[1].", ".substr($timeexplode[2], 0, 2)."]";
    //print_r($timeexplode);
}
//echo getData2();
/*foreach(getData(datatest) as $data)
{
    echo "[".$data[1], $data[0]."]";
}*/
//echo "[[ 8, 30, 45 ], 4.7]";
//echo getData(datatest)[4][0];
//getData2();
//echo file_get_contents("datatest.txt");
$dataArray = array("temp", "humidity", "air_pressure", "rain", "wind_s", "wind_d", "solar");
/*foreach ($dataArray as $value)
{
    echo "google.charts.setOnLoadCallback(draw".$value."Chart);";
}*/
?>

<script>
    google.charts.load('current', {packages: ['corechart', 'line', 'gauge']});
    google.charts.setOnLoadCallback(drawTempChart);
    google.charts.setOnLoadCallback(drawHumidityChart);
    google.charts.setOnLoadCallback(drawAirPressureChart);
    google.charts.setOnLoadCallback(drawRainChart);
    google.charts.setOnLoadCallback(drawWindsChart);
    google.charts.setOnLoadCallback(drawWinddChart);
    google.charts.setOnLoadCallback(drawSolarChart);
    google.charts.setOnLoadCallback(drawWindspeedGauge);
    google.charts.setOnLoadCallback(drawAirpressureGauge);

//    function drawChart($factor) {
//        var data = new google.visualization.DataTable();
//        data.addColumn('timeofday', 'Time');
//        data.addColumn('number', $factor);
//        var a = $.ajax({
//            url: $factor.".txt",
//            dataType:"html",
//            async: false
//        }).responseText;
//        //console.log(a);
//        /*setInterval( function () {
//         window.alert(a);
//         },2000);*/
//        data.addRows([
//            <?php //foreach(getLineGraphData($factor.".txt") as $data)
//        {
//            echo "[".$data[1].",", $data[0]."],";
//        } ?>
//        ]);
//        var options = {
//
//            hAxis: {
//                gridlines: {
//                    color: 'transparent'
//                },
//                title: 'Time'
//            },
//            vAxis: {
//                gridlines: {
//                    color: 'transparent'
//                },
//                title: $factor
//            },
//            curveType: 'function'
//        };
//        var tempChart = new google.visualization.LineChart(document.getElementById($factor.'_div'));
//        tempChart.draw(data, options);
//        //document.getElementById('temp_graph').innerHTML = '<div id="temp_div"></div>';
//    }

    function drawTempChart() {
        var data = new google.visualization.DataTable();
        data.addColumn('timeofday', 'Time');
        data.addColumn('number', 'Temp');
        var a = $.ajax({
            url: "temp.txt",
            dataType:"html",
            async: false
        }).responseText;
        //console.log(a);
        /*setInterval( function () {
         window.alert(a);
         },2000);*/
        data.addRows([
            <?php foreach(getLineGraphData("temp.txt") as $data)
        {
            echo "[".$data[1].",", $data[0]."],";
        } ?>
        ]);
        var options = {

            hAxis: {
                gridlines: {
                    color: 'transparent'
                },
                title: 'Time'
            },
            vAxis: {
                gridlines: {
                    color: 'transparent'
                },
                title: 'Temp'
            },
            curveType: 'function'
        };
        var tempChart = new google.visualization.LineChart(document.getElementById('temp_div'));
        tempChart.draw(data, options);
        //document.getElementById('temp_graph').innerHTML = '<div id="temp_div"></div>';
    }
    function drawHumidityChart() {
        var data = new google.visualization.DataTable();
        data.addColumn('timeofday', 'Time');
        data.addColumn('number', 'Humidity');
        data.addRows([
            <?php foreach(getLineGraphData("humidity.txt") as $data)
        {
            echo "[".$data[1].",", $data[0]."],";
        } ?>
        ]);
        var options = {
            hAxis: {
                gridlines: {
                    color: 'transparent'
                },
                title: 'Time'
            },
            vAxis: {
                gridlines: {
                    color: 'transparent'
                },
                title: 'Humidity'
            }
        };
        var tempChart = new google.visualization.LineChart(document.getElementById('humidity_div'));
        tempChart.draw(data, options);
    }
    function drawAirPressureChart() {
        var data = new google.visualization.DataTable();
        data.addColumn('timeofday', 'Time');
        data.addColumn('number', 'Air Pressure');
        data.addRows([
            <?php foreach(getLineGraphData("air_pressure.txt") as $data)
        {
            echo "[".$data[1].",", $data[0]."],";
        } ?>
        ]);
        var options = {
            hAxis: {
                gridlines: {
                    color: 'transparent'
                },
                title: 'Time'

            },
            vAxis: {
                gridlines: {
                    color: 'transparent'
                },
                title: 'Air Pressure'
            }
        };
        var tempChart = new google.visualization.LineChart(document.getElementById('airpressure_div'));
        tempChart.draw(data, options);
    }
    function drawRainChart() {
        var data = new google.visualization.DataTable();
        data.addColumn('timeofday', 'Time');
        data.addColumn('number', 'Rain');
        data.addRows([
            <?php foreach(getLineGraphData("rain.txt") as $data)
        {
            echo "[".$data[1].",", $data[0]."],";
        } ?>
        ]);
        var options = {
            hAxis: {
                gridlines: {
                    color: 'transparent'
                },
                title: 'Time'
            },
            vAxis: {
                gridlines: {
                    color: 'transparent'
                },
                title: 'Rain MM'
            }
        };
        var tempChart = new google.visualization.LineChart(document.getElementById('rain_div'));
        tempChart.draw(data, options);
    }
    function drawWindsChart() {
        var data = new google.visualization.DataTable();
        data.addColumn('timeofday', 'Time');
        data.addColumn('number', 'Wind Speed MPH');
        data.addRows([
            <?php foreach(getLineGraphData("wind_s.txt") as $data)
        {
            echo "[".$data[1].",", $data[0]."],";
        } ?>
        ]);
        var options = {
            hAxis: {
                gridlines: {
                    color: 'transparent'
                },
                title: 'Time'
            },
            vAxis: {
                gridlines: {
                    color: 'transparent'
                },
                title: 'Wind Speed MPH'
            }
        };
        var tempChart = new google.visualization.LineChart(document.getElementById('winds_div'));
        tempChart.draw(data, options);
    }
    function drawWinddChart() {
        var data = new google.visualization.DataTable();
        data.addColumn('timeofday', 'Time');
        data.addColumn('number', 'Wind Direction oC');
        data.addRows([
            <?php foreach(getLineGraphData("wind_d.txt") as $data)
        {
            echo "[".$data[1].",", $data[0]."],";
        } ?>
        ]);
        var options = {
            hAxis: {
                gridlines: {
                    color: 'transparent'
                },
                title: 'Time'
            },
            vAxis: {
                gridlines: {
                    color: 'transparent'
                },
                title: 'Wind Direction oC'
            }
        };
        var tempChart = new google.visualization.LineChart(document.getElementById('windd_div'));
        tempChart.draw(data, options);
    }
    function drawSolarChart() {
        var data = new google.visualization.DataTable();
        data.addColumn('timeofday', 'Time');
        data.addColumn('number', 'Solar');
        data.addRows([
            <?php foreach(getLineGraphData("solar.txt") as $data)
        {
            echo "[".$data[1].",", $data[0]."],";
        } ?>
        ]);
        var options = {
            hAxis: {
                gridlines: {
                    color: 'transparent'
                },
                title: 'Time'
            },
            vAxis: {
                gridlines: {
                    color: 'transparent'
                },
                title: 'Solar'
            }

        };
        var tempChart = new google.visualization.LineChart(document.getElementById('solar_div'));
        tempChart.draw(data, options);
    }
    function drawWindspeedGauge() {
        var data = google.visualization.arrayToDataTable([
            ['Label', 'Value'],
            ['Wind Speed', 20],
        ]);
        var options = {
            min: 0, max: 15,
            minorTicks: 2
        };
        var windspeedChart = new google.visualization.Gauge(document.getElementById('windspeedgauge_div'));
        data.setValue(0, 1, <?php echo getLastLine("wind_s.txt") ?> );
        windspeedChart.draw(data, options);
    }
    function drawAirpressureGauge() {
        var data = google.visualization.arrayToDataTable([
            ['Label', 'Value'],
            ['Air Pressure', 20],
        ]);
        var options = {
            min: 0, max: 500,
            minorTicks: 10
        };
        var windspeedChart = new google.visualization.Gauge(document.getElementById('airpressuregauge_div'));
        data.setValue(0, 1, <?php echo getLastLine("air_pressure.txt") ?> );
        windspeedChart.draw(data, options);
    }
</script>

<script>
    $(function () {
        var langWindDir = new Array("N", "NNE", "NE", "ENE","E", "ESE", "SE", "SSE","S", "SSW", "SW", "WSW","W", "WNW", "NW", "NNW");
        function windDirLang ($winddir)
        {
            /* return langWindDir[Math.floor(((parseInt($winddir) + 11) / 22.5) % 16 )];*/
            return langWindDir[Math.floor(((parseInt($winddir,10) + 11.25) / 22.5))];
        }
        var chart = new google.charts.Line({
                chart: {
                    renderTo: 'windDirection_div',
                    type: 'gauge',
                    plotBackgroundColor: null,
                    plotBackgroundImage: null,
                    plotBorderWidth: 0,
                    plotShadow: false
                },
                title: {
                    text: 'Wind Direction'
                },
                credits: {
                    enabled: false
                },
                pane: {
                    /* startAngle: -180, */
                    /* endAngle: 180, */
                    background: [{
                        backgroundColor: {
                            linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 },
                            stops: [
                                [0, '#FFF'],
                                [1, '#333']
                            ]
                        },
                        borderWidth: 0,
                        outerRadius: '109%'
                    }, {
                        backgroundColor: {
                            linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 },
                            stops: [
                                [0, '#333'],
                                [1, '#FFF']
                            ]
                        },
                        borderWidth: 1,
                        outerRadius: '107%'
                    }, {
                        // default background
                    }, {
                        backgroundColor: '#DDD',
                        borderWidth: 0,
                        outerRadius: '105%',
                        innerRadius: '103%'
                    }]
                },
                // the value axis
                yAxis: {
                    min: 0,
                    max: 360,
                    tickInterval: 22.5,
                    tickWidth: 2,
                    tickPosition: 'inside',
                    tickLength: 3,
                    tickColor: '#666',
                    labels: {
                        step: 2,
                        rotation: 'auto',
                        formatter:
                            function() {
                                return windDirLang(this.value);
                            }
                    }
                },
                series: [{
                    name: 'Dir',
                    data: [<?php echo getLastLine("wind_d.txt") ?>],
                    tooltip: {
                        /* valueSuffix: ' km/h' */
                        enabled: false
                    }
                }]
            },
            function (chart) {
            });
    });
</script>