<?php
// subscribe.php
require("models/phpMQTT.php");

$host = "146.87.2.99";
$port = "1883";
date_default_timezone_set('Europe/London');
$date_timezone = date_default_timezone_get();



$mqtt = new phpMQTT($host, $port, "ClientID".rand());

if(!$mqtt->connect()){
    exit(1);
}

$weather_factors = array("temp", "humidity", "air_pressure", "rain", "wind_s", "wind_d", "solar");

foreach ($weather_factors as $factor) {
    $topics['/'.$factor] = array("qos"=>0, "function"=>"procmsg");
}


//$topics['/temp'] = array("qos"=>0, "function"=>"procmsg");
//$topics['/humidity'] = array("qos"=>0, "function"=>"procmsg");
//$topics['/air_pressure'] = array("qos"=>0, "function"=>"procmsg");
//$topics['/rain'] = array("qos"=>0, "function"=>"procmsg");
//$topics['/wind_s'] = array("qos"=>0, "function"=>"procmsg");
//$topics['/wind_d'] = array("qos"=>0, "function"=>"procmsg");
//$topics['/solar'] = array("qos"=>0, "function"=>"procmsg");

$mqtt->subscribe($topics,0);
while($mqtt->proc()){

}
$mqtt->close();
function procmsg($topic,$msg){
    echo "Msg Recieved: ".date("h:i:sa")."\nTopic:{$topic}\n$msg\n";
}

