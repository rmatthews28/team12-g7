<?php

require("models/phpMQTT.php");

$host = "146.87.2.99";
$port = "1883";

//MQTT client id to use for the device. "" will generate a client id automatically
$mqtt = new phpMQTT($host, $port, "ClientID".rand());

if ($mqtt->connect(true,NULL,$username,$password)) {
    $mqtt->publish("/g7/setpoint1","1", 0);
    $mqtt->publish("/g7/setpoint2","2", 0);
    $mqtt->publish("/g7/setpoint3","3", 0);
    $mqtt->publish("/g7/setpoint4","4", 0);
    $mqtt->close();
}else{
    echo "Fail or time out<br />";
}
