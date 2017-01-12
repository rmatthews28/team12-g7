<?php

/**
 * Created by PhpStorm.
 * User: stc322
 * Date: 11/01/17
 * Time: 11:12
 */
require('../models/phpMQTT.php');
class air_pressure
{
    private $data;
    private $timestamp;

    /**
     * @param mixed $data
     */
    public function setData($data)
    {
        $this->data = $data;
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        $topics['/air_pressure'] = array("qos"=>0, "function"=>"procmsg");
    }

    /**
     * @param mixed $timestamp
     */
    public function setTimestamp($timestamp)
    {
        $this->timestamp = $timestamp;
    }

    /**
     * @return mixed
     */
    public function getTimestamp()
    {
        return $this->timestamp;
    }

}