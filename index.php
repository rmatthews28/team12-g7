<?php
require("index.phtml");

function getData($topic)
{
    $handle = fopen($topic . ".txt", "r");
    if ($handle) {
        /*while ((*/$line = fgets($handle);/*)) !== false) {*/
            // process the line read.
            $array = (explode("|", $line));
            $value = $array[1];
            echo $value;
        //}
        fclose($handle);
    } else {
        //Error handling
    }
}



?>