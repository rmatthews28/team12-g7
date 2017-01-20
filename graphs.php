<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script src="http://code.jquery.com/jquery-1.9.0.min.js"></script>
<script src="http://code.highcharts.com/highcharts.src.js"></script>
<script src="http://code.highcharts.com/highcharts-more.src.js"></script>
<!--<div id="temp_div"></div>
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
//OLD FUNCTION used for line graphs
//function getLineGraphData($filepath)
//{
//    $handle = fopen($filepath, "r");
//    if ($handle) {
//        $i = 0;
//        while($i < 250) {
//            /*while ((*/
//            $line = fgets($handle);/*)) !== false) {*/
//
//            // splits the 3 values in 3 arrays
//            $array = (explode(",", $line));
//            $value = $array[1]; // the value
//            $time = $array[2]; // the time value
//            $timeexplode = (explode(" ", $time)); // splits time/date with space as delimiter.
//            $time2 = $timeexplode[3].", ".$timeexplode[2].", ".$timeexplode[1].""; // adds the date together in the correct format
//            $timeexplode2 = (explode(":", $timeexplode[4])); // splits the time with : as a delimiter
//            $time3 = ", ".$timeexplode2[0].", ".$timeexplode2[1].", ".substr($timeexplode2[2], 0, 2); // adds the time together in the correct format
//
//            $supertime = $time2.$time3; // adds the times and date together
//
//            $superArray[] = [$value, $supertime]; // adds it to the final array
//
//
//            $i++;
//        }
//        return $superArray;
//        fclose($handle);
//    } else {
//        //Error handling
//    }
//}


// new function for line graph data, pulls from end and most recent instead of from begining of file
function getLineGraphData($filepath)
{
    $fp = fopen($filepath, 'r');

    $linesToShow = 250;
    $counter = 0;

    $pos = -2; // Skip final new line character (Set to -1 if not present)

    $currentLine = '';

    while ($counter <= $linesToShow && -1 !== fseek($fp, $pos, SEEK_END)) {
        $char = fgetc($fp);
        if (PHP_EOL == $char) {
            $array = (explode(",", $currentLine));
            $value = $array[1]; // the value
            $time = $array[2]; // the time value
            $timeexplode = (explode(" ", $time)); // splits time/date with space as delimiter.
            $time2 = $timeexplode[3].", ".$timeexplode[2].", ".$timeexplode[1].""; // adds the date together in the correct format
            $timeexplode2 = (explode(":", $timeexplode[4])); // splits the time with : as a delimiter
            $time3 = ", ".$timeexplode2[0].", ".$timeexplode2[1].", ".substr($timeexplode2[2], 0, 2); // adds the time together in the correct format

            $supertime = $time2.$time3; // adds the times and date together

            $superArray[] = [$value, $supertime]; // adds it to the final array
            $currentLine = '';
            $counter++;
        } else {
            $currentLine = $char . $currentLine;
        }
        $pos--;
    }

    return $superArray;

}


//gets the last line of the file, explodes into array, pulls the correct data
function getLastLine($filename)
{
    $line = trim(implode("", array_slice(file($filename), -1)));
    $array = (explode(",", $line));
    $value = $array[1];
    return $value;
}

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

    function drawTempChart() {
        var data = new google.visualization.DataTable();
        data.addColumn('datetime', 'Time');
        data.addColumn('number', 'Temp');

        data.addRows([
            <?php foreach(getLineGraphData("temp.txt") as $data)
                {
                ?> [new Date(<?php echo $data[1]; ?>), <?php echo $data[0]; ?>],
    <?php }  ?>
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
    }
    function drawHumidityChart() {
        var data = new google.visualization.DataTable();
        data.addColumn('datetime', 'Time');
        data.addColumn('number', 'Humidity');
        data.addRows([
            <?php foreach(getLineGraphData("humidity.txt") as $data)
            {
            ?> [new Date(<?php echo $data[1]; ?>), <?php echo $data[0]; ?>],
            <?php }  ?>
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
        data.addColumn('datetime', 'Time');
        data.addColumn('number', 'Air Pressure');
        data.addRows([
            <?php foreach(getLineGraphData("air_pressure.txt") as $data)
            {
            ?> [new Date(<?php echo $data[1]; ?>), <?php echo $data[0]; ?>],
            <?php }  ?>
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
        data.addColumn('datetime', 'Time');
        data.addColumn('number', 'Rain');
        data.addRows([
            <?php foreach(getLineGraphData("rain.txt") as $data)
            {
            ?> [new Date(<?php echo $data[1]; ?>), <?php echo $data[0]; ?>],
            <?php }  ?>
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
        data.addColumn('datetime', 'Time');
        data.addColumn('number', 'Wind Speed MPH');
        data.addRows([
            <?php foreach(getLineGraphData("wind_s.txt") as $data)
            {
            ?> [new Date(<?php echo $data[1]; ?>), <?php echo $data[0]; ?>],
            <?php }  ?>
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
        data.addColumn('datetime', 'Time');
        data.addColumn('number', 'Wind Direction oC');
        data.addRows([
            <?php foreach(getLineGraphData("wind_d.txt") as $data)
            {
            ?> [new Date(<?php echo $data[1]; ?>), <?php echo $data[0]; ?>],
            <?php }  ?>
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
        data.addColumn('datetime', 'Time');
        data.addColumn('number', 'Solar');
        data.addRows([
            <?php foreach(getLineGraphData("solar.txt") as $data)
            {
            ?> [new Date(<?php echo $data[1]; ?>), <?php echo $data[0]; ?>],
            <?php }  ?>
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
