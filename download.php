<?php require("downloads.phtml");

if (!isset($_POST["rangeSlider"]))
    echo "Please slide the Slider Bar and Press Submit.";


function downloadData($topic)
{
    $handle = fopen($topic . ".txt", "r");
    if ($handle) {

        $last_line = '';
        $range = $_POST['rangeSlider'];

        $array = (implode("", array_slice(file($topic . ".txt"),1)));

        $file = escapeshellarg($topic . ".txt");

        // Navigate through the slider to select number of lines
        if (isset($_POST['topLines']))
            $last_line = `head -n $range $file`;
        if (isset($_POST['lastLines']))
            $last_line = `tail -n $range $file`;

        // When clicked on download buttton, display the values of
        // selected number of lines
        if (isset($_POST['topLines']) || isset($_POST['lastLines'])) {

            // Create a download window as CSV format
            header("Content-Type: text/csv");
            header("Content-Disposition: attachment; filename=file.csv");

            // Input the data into the download file
            $download_increment = 0;
            $i = 0;
            foreach ($array as $value) {
                if ($i == 0) {

                } elseif ($i % 2 == 0) {
                    $array1 = (explode("/", $value));
                    $weather_data = print $array1[0] . ",";
                    $myfile = fopen(__DIR__ . "download" . $download_increment . ".csv", "a") or die("Unable to open file!");
                    fputcsv($myfile, $weather_data . "\n");
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
?>