<?php require("history.phtml");

if (isset($_POST["passengers"])) {
//    echo "Number of selected passengers are:" . $_POST["passengers"];
    // Your Slider value is here, do what you want with it. Mail/Print anything..
} else {
    Echo "Please slide the Slider Bar and Press Submit.";
}


function getData($topic)
{
    $handle = fopen($topic . ".txt", "r");
    if ($handle) {
        $line = fgets($handle);

        $last_line = '';
        $range = $_POST['passengers'];


        $array = (explode("", array_slice(file($topic . ".txt"), 1)));
//            $array = (explode("|", $line));

        $file = escapeshellarg($topic . ".txt");
        if (isset($_POST['topLines'])) {
            $last_line = `head -n $range $file`;
        }

        if (isset($_POST['lastLines'])) {
            $last_line = `tail -n $range $file`;
        }

        echo $last_line;
        $value = $array[1];
        echo $value;
        fclose($handle);
    } else
        echo 'No data found';
}

?>