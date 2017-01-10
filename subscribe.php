<?php
// subscribe.php
require("models/phpMQTT.php");

$host = "146.87.2.99";
$port = "1883";


$mqtt = new phpMQTT($host, $port, "ClientID".rand());

if(!$mqtt->connect(true,NULL)){
    exit(1);
}

//currently subscribed topics
$topics = array("qos"=>0, "function"=>"/temp");
var_dump($mqtt->subscribe($topics,0));

//$mqtt->proc();

/*while($mqtt->proc()){
}

$mqtt->close();
function procmsg($topic,$msg){
    echo "Msg Recieved: $msg";
}*/