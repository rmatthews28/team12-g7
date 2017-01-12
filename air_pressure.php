<?php

/**
 * Created by PhpStorm.
 * User: stc322
 * Date: 11/01/17
 * Time: 11:12
 */
class air_pressure
{
    private $value;
    private $timestamp;


    public function __construct($dbRow)
    {
        $this->value = $dbRow['value'];
        $this->timestamp = $dbRow['time_stamp'];
    }

    public function getValue()
    {
        return $this->value;
    }

    public function getTimestamp()
    {
        return $this->timestamp;
    }

}