<?php

function genlog($action) {
    $nombre_fichero = '../logs/log.csv';
    $time = time();
    $data = date("Y-m-d (H:i:s)", $time);

    if (file_exists($nombre_fichero)) {
        $fs = fopen("../logs/log.csv","a");
        fputcsv($fs, array($data,$action));
    }
    else{
        $fs = fopen("../logs/log.csv","a");
        fputcsv($fs, array("DATA","ACTION"));
        fputcsv($fs, array($data,$action));
    }
    fclose($fs);
}

function genlog2($action) {
    $nombre_fichero = './logs/log.csv';
    $time = time();
    $data = date("Y-m-d (H:i:s)", $time);

    if (file_exists($nombre_fichero)) {
        $fs = fopen("./logs/log.csv","a");
        fputcsv($fs, array($data,$action));
    }
    else{
        $fs = fopen("./logs/log.csv","a");
        fputcsv($fs, array("DATA","ACTION"));
        fputcsv($fs, array($data,$action));
    }
    fclose($fs);
}
?>