<?php

require_once('../models/database.php');
require('../models/phpMQTT.php');
require_once('../models/air_pressure.php');


class WeatherDataSet
{
    protected $_dbHandle, $_dbInstance;

    public function __construct()
    {
        $this->_dbInstance = Database::getInstance();
        $this->_dbHandle = $this->_dbInstance->getdbConnection();
    }

    public function displayAirPressure()
    {
        $sqlQuery = "SELECT *
                    FROM mue955_workshops.air_pressure";

        $statement = $this->_dbHandle->prepare($sqlQuery); // prepare a PDO statement
        $statement->execute(); // execute the PDO statement

        $dataSet = [];
        while ($row = $statement->fetch()) {
            $dataSet[] = new air_pressure($row);
        }
        return $dataSet;
    }

    public function setAirPressure($value, $time_stamp)
    {
        $addToBasketQuery = " INSERT INTO mue955_workshops.air_pressure(value, time_stamp) 
                    VALUES ($value, '$time_stamp')";

        $statement = $this->_dbHandle->prepare($addToBasketQuery); // prepare a PDO statement
        $statement->execute(); // execute the PDO statement
    }
}


