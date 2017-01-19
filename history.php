<?php require("history.phtml");

if (!isset($_POST["rangeSlider"]))
    echo "Please slide the Slider Bar and Press Submit.";


/**
 * Display data from files
 */
function getData($topic)
{
    $handle = fopen($topic . ".txt", "r");
    if ($handle) {
        $file = escapeshellarg($topic . ".txt");
        $last_line = `tail -n 1 $file`;
        echo $last_line;
        fclose($handle);
    } else
        echo 'No data found';
}

?>