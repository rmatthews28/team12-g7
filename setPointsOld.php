<?php
require("models/phpMQTT.php");

function getData($topic)
{
    $handle = fopen($topic . ".txt", "r");
    if ($handle) {
        $file = escapeshellarg($topic . ".txt");
        $last_line = `tail -n 1 $file`;
        //$array = (implode("", array_slice(file($topic . ".txt"), 1)));
        $array = (explode("|", $last_line));

        $value = $array[1];
        echo $value;
        fclose($handle);
    } else
        echo 'No data found';

}

$desiredTemperature = 0;

// cuurrent value of temp
$actualTemp = getData(temp);

$host = "146.87.2.99";
$port = "1883";


$setPoint1 = getData(temp);
$setPoint2 = 20;
$setPoint3 = 30;
$setPoint4 = 40;

//MQTT client id to use for the device. "" will generate a client id automatically
$mqtt = new phpMQTT($host, $port, "ClientID".rand());

if ($mqtt->connect(true,NULL,$username,$password)) {
    $mqtt->publish("/g7/setpoint1", $setPoint1, 0);
    $mqtt->publish("/g7/setpoint2", $setPoint2, 0);
    $mqtt->publish("/g7/setpoint3", $setPoint3, 0);
    $mqtt->publish("/g7/setpoint4", $setPoint4, 0);
    $mqtt->close();
}else{
    echo "Fail or time out<br />";
}




require("setPoints.phtml");
?>
