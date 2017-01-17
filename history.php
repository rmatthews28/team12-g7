<?php
/**
 * Created by PhpStorm.
 * User: CameronCampbell
 * Date: 13/01/2017
 * Time: 16:21
 */
require("history.phtml");

function getData($topic)
{
    $handle = fopen($topic . ".txt", "r");
    if ($handle) {
        $i = 0;
        while($i < 20) {
            /*while ((*/$line = fgets($handle);/*)) !== false) {*/
                // process the line read.
                $array = (explode("|", $line));
                $value = $array[1];
                echo $value;
            $i++;
            //}
        }
        fclose($handle);
    } else {
        //Error handling
    }
}