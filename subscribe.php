<?php
require("../team12-g7/models/phpMQTT.php");
require("../team12-g7/database.php");

$host = "146.87.2.99";
$port = "1883";
date_default_timezone_set('Europe/London');
$date_timezone = date_default_timezone_get();


$mqtt = new phpMQTT($host, $port, "ClientID" . rand());

if (!$mqtt->connect()) {
    exit(1);
}

$weather_factors = array("temp", "humidity", "air_pressure", "rain", "wind_s", "wind_d", "solar");
foreach ($weather_factors as $factor) {
    $topics['/' . $factor] = array("qos" => 0, "function" => "procmsg");
}

$mqtt->subscribe($topics, 0);
while ($mqtt->proc()) {
}
$mqtt->close();

/**
 * Output each factor with its value
 * Write the results into its text file
 * according to its respected factor
 */
function procmsg($factor, $value)
{
    echo "Time: " . date("h:i:sa") . "\n" . "Factor: {$factor}\n$value\n";
    $date = date("h:i:sa");

    $myfile = fopen(__DIR__ . $factor . ".txt", "a") or die("Unable to open file!");
    $weather_data = $factor . " | " . $value . " | " . $date /*. PHP_EOL*/;
    fwrite($myfile, $weather_data . "\n");
    fclose($myfile);
}

