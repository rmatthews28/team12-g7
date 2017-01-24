<?php session_start();

require("models/phpMQTT.php");
$host = "146.87.2.99";
$port = "1883";
function getData($topic)
{
    $handle = fopen($topic . ".txt", "r");
    if ($handle) {
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
$desiredValue = $_POST['desiredValue'];
if (isset($_POST['submit'])) {
//MQTT client id to use for the device. "" will generate a client id automatically
    $mqtt = new phpMQTT($host, $port, "ClientID" . rand());
    if ($mqtt->connect(true, NULL, $username, $password)) {
        switch ($_POST['setPoints']) {
            case 'set_Point_1':
                $mqtt->publish("/g7/setpoint1", $desiredValue, 0);
                $_SESSION['setpoint1Value'] = $desiredValue;
                break;
            case 'set_Point_2':
                $mqtt->publish("/g7/setpoint2", $desiredValue, 0);
                $_SESSION['setpoint2Value'] = $desiredValue;
                break;
            case 'set_Point_3':
                $mqtt->publish("/g7/setpoint3", $desiredValue, 0);
                $_SESSION['setpoint3Value'] = $desiredValue;
                break;
            case 'set_Point_4':
                $mqtt->publish("/g7/setpoint4", $desiredValue, 0);
                $_SESSION['setpoint4Value'] = $desiredValue;
                break;
            default:
                $mqtt->publish("/g7/setpoint1", $desiredValue, 0);
        }
        $mqtt->close();
    } else {
        echo "Fail or time out<br />";
    }
}


require("setPoints.phtml");
?>