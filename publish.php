<?php

require("models/phpMQTT.php");

$host = "146.87.2.99";
$port = "1883";
$message = "10";

//MQTT client id to use for the device. "" will generate a client id automatically
$mqtt = new phpMQTT($host, $port, "ClientID".rand());

if ($mqtt->connect(true,NULL,$username,$password)) {
    $mqtt->publish("/g7/setpoint1",$message, 0);
    $mqtt->close();
}else{
    echo "Fail or time out<br />";
}
