<?php

//function getData($topic)
//{
//    $handle = fopen($topic . ".txt", "r");
//    if ($handle) {
//        $line = fgets($handle);
//            // process the line read.
//            $array = (explode("|", $line));
//            $value = $array[1];
//            echo $value;
//        //}
//        fclose($handle);
//    } else {
//        //Error handling
//    }
//}


function getData($topic)
{
    $handle = fopen($topic . ".txt", "r");
    if ($handle) {
        $line = fgets($handle);
        $file = escapeshellarg($topic . ".txt");
        $last_line = `tail -n 1 $file`;
        //$array = (implode("", array_slice(file($topic . ".txt"), 1)));
        $array = (explode("|", $last_line));

        $value = $array[1];
        echo $value;
        fclose($handle);
    } else
        echo 'No data found';

}





require("index.phtml");

?>