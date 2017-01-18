<?php
function downloadData($topic) {
    $file = $topic.'.txt';
    $newfile = $topic.'.csv';

//    if(isset($_GET['.download'])){
//        $link=$_GET['.download'];
//        if ($link == '1') {
//
//        }

    if (!copy($file, $newfile)) {
        echo "failed to copy";
    }
}

?>