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
        $array = (explode("", array_slice(file($topic . ".txt"), 1)));

        $file = escapeshellarg($topic . ".txt");
        $last_line = `tail -n 1 $file`;

        echo $last_line;
        $value = $array[1];
        echo $value;
        fclose($handle);
    } else
        echo 'No data found';

}







require("index.phtml");

?>