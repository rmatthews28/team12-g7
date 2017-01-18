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

        $last_line = '';
        $range = $_POST['passengers'];

        $array = (explode("", array_slice(file($topic . ".txt"), 1)));

        $file = escapeshellarg($topic . ".txt");
        if (isset($_POST['topLines'])) {
            $last_line = `head -n $range $file`;
            $rangedHeads = true;
        }
        if (isset($_POST['lastLines'])) {
            $last_line = `tail -n $range $file`;
        }

        if (isset($_POST['topLines'])) {
            header("Content-Type: text/csv");
            header("Content-Disposition: attachment; filename=file.csv");

            $download_increment = 0;

            $i = 0;
            foreach ($array as $value) {
                if ($i == 0) {

                } elseif ($i % 2 == 0) {
                    $array1 = (explode("/", $value));
                    $weather_data = print $array1[0] . ",";
                    $myfile = fopen(__DIR__ . "download" . $download_increment . ".txt", "a") or die("Unable to open file!");
                    fwrite($myfile, $weather_data . "\n");
                    fclose($myfile);
                } else {
                    echo $value;
                }
                $i++;
            }
        }
        echo $last_line;
        fclose($handle);
    } else
        echo 'No data found';
}

function downloadData()
{
    header("Content-Type: text/csv");
    header("Content-Disposition: attachment; filename=file.csv");

    $download_increment = 0;
    $last_line = '';


    $array = (explode("|", $last_line));
    $i = 0;
    foreach ($array as $value) {
        if ($i == 0) {

        } elseif ($i % 2 == 0) {
            $array1 = (explode("/", $value));
            //echo $array1[0] . ",";
            $weather_data = print $array1[0] . ",";
            $myfile = fopen(__DIR__ . "download" . $download_increment . ".txt", "a") or die("Unable to open file!");
            //$weather_data = $topic . " | " . $value . " | " . $date /*. PHP_EOL*/;
            fwrite($myfile, $weather_data . "\n");
            fclose($myfile);
        } else {
            echo $value;
        }
        $i++;
    }
}

?>