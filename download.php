<?php
function downloadData($topic) {
    $file = $topic.'.txt';
    $newfile = $topic.'.csv';

//    if(isset($_GET['.download_btn'])){
//        $link=$_GET['.download_btn'];
//        if ($link == '1') {
//
//        }

    if (!copy($file, $newfile)) {
        echo "failed to copy";
    }
}

function downloadAllData() {
    $weather_factors = array("temp", "humidity", "air_pressure", "rain", "wind_s", "wind_d", "solar");

    foreach($weather_factors as $factor) {
        downloadData($factor);
    }
}

?>