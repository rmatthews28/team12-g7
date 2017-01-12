<?php

/**
 * Created by PhpStorm.
 * User: stc322
 * Date: 11/01/17
 * Time: 11:12
 */
class weatherData
{
    private $value;


    public function __construct($dbRow)
    {
        $this->value = $dbRow['value'];
    }

    public function getData($factor)
    {
        return $topics['/' . $factor] = array("qos" => 0, "function" => "procmsg");

    }
    function procmsg($topic,$msg){
        echo "Msg Recieved: ".date("h:i:sa")."\nTopic:{$topic}\n$msg\n";
    }


}