<?php

# Module Functions

# Send API response as JSON
function fnAPIRespond($status, $output){
    fnSendJSON("{status: $status, message: $output}");
}

# Send API response as JSON
function fnSendJSON($data){
    header("Content-Type: application/json");
    echo $data;
    exit();
}

function fn404(){
    header("HTTP/1.0 404 not found");
    echo "Your request could not be completed.";
    exit();
}

?>