<?php

# Module Functions

# Send JSON to browser.
function fnSendJSON($data){
    header("Content-Type: application/json");
    echo $data;
    exit();
}

# Send API response (status, message) *required.
function fnAPIRespond($status, $output){
    fnSendJSON("{status: $status, message: $output}");
}

function fn404(){
    header("HTTP/1.0 404 not found");
    echo "Your request could not be completed.";
    exit();
}

?>