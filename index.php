<?php

//function getData($topic)
//{
//    $handle = fopen($topic . ".txt", "r");
//    if ($handle) {
//        $line = fgets($handle);
//            // process the line read.
//            $array = (explode("|", $line));
//            $value = $array[1];
//            echo $value;
//        //}
//        fclose($handle);
//    } else {
//        //Error handling
//    }
//}


function getData($topic)
{
    $handle = fopen($topic . ".txt", "r");
    if ($handle) {
        $line = fgets($handle);
        $file = escapeshellarg($topic . ".txt");
        $last_line = `tail -n 1 $file`;
        //$array = (implode("", array_slice(file($topic . ".txt"), 1)));
        $array = (explode(",", $last_line));

        $value = $array[1];
        echo $value;
        fclose($handle);
    } else
        echo 'No data found';

}

if (isset($_POST['download_temp']))
    downloadData('temp');
if (isset($_POST['download_humidity']))
    downloadData(humidity);
if (isset($_POST['download_rain']))
    downloadData(rain);
if (isset($_POST['download_air_pressure']))
    downloadData(air_pressure);
if (isset($_POST['download_wind_s']))
    downloadData(wind_s);
if (isset($_POST['download_wind_d']))
    downloadData(wind_d);
if (isset($_POST['download_solar']))
    downloadData(solar);

function downloadData($topic) {


    //download_btn
    $file = $topic.'.txt';
    $newfile = '../team12-g7/downloads/'.$topic.'.csv';
    if (!copy($file, $newfile)) {
        echo "failed to copy $file...\n";
    }
    else
        copy($file,$newfile);




    //file_put_contents('../', $file);

}




function downloadAllData() {
    $weather_factors = array("temp", "humidity", "air_pressure", "rain", "wind_s", "wind_d", "solar");
    foreach($weather_factors as $factor) {
        downloadData($factor);
    }

}





require("index.phtml");

?>