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
                    FROM stb927_energy_house.WeatherFactors";

        $statement = $this->_dbHandle->prepare($sqlQuery); // prepare a PDO statement
        $statement->execute(); // execute the PDO statement

        $dataSet = [];
        while ($row = $statement->fetch()) {
            $dataSet[] = new air_pressure($row);
        }
        return $dataSet;
    }

    public function insert_into_db($name)
    {
        $addToBasketQuery = " INSERT INTO stb927_energy_house.WeatherFactors(name, value, timestamp) 
                    VALUES ($value, '$time_stamp')";

        $statement = $this->_dbHandle->prepare($addToBasketQuery); // prepare a PDO statement
        $statement->execute(); // execute the PDO statement
    }
}


