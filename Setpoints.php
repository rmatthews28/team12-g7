<?php
/**
 * Created by PhpStorm.
 * User: CameronCampbell
 * Date: 20/01/2017
 * Time: 15:00
 */
require("setpoint.php");

class Setpoints
{

    var $value, $name;

    function __construct($name)
    {
        $value = 0;
        $this->name = $name;
    }

    /**
     * @param mixed $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

}


require("setPoints.phtml")
?>