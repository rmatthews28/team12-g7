<?php

/**
 * Created by PhpStorm.
 * User: stc322
 * Date: 11/01/17
 * Time: 11:13
 */
class wind_d
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
        return $this->data;
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