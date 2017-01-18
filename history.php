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

        $file = escapeshellarg($topic . ".txt");
        if (isset($_POST['topLines'])) {
            $last_line = `head -n $range $file`;
        }

        if (isset($_POST['lastLines'])) {
            $last_line = `tail -n $range $file`;
        }

        $array = (explode("|", $last_line));
        $i=0;
        foreach($array as $value) {
            if($i==0){

            }
            elseif ($i%2==0)
            {
                $array1 = (explode("/", $value));

                if($range == 1) {
                    echo $array1[0];
                }
                else {
                    echo $array1[0] . ",";
                    echo '<br>';
                }
            }
            else{
                echo $value;
            }
            $i++;
        }
        fclose($handle);
    }else
        echo 'No data found';
}

?>