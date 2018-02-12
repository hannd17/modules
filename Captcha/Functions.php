<?php

# Module Functions

# Send JSON to browser.
function fnSendJSON($data){
    header("Content-Type: application/json");
    echo json_encode($data);
    exit();
}

# Send API response (status, message) *required.
function fnAPIRespond($status, $output, $extra){
    $data = array();
    $data["status"] = $status;
    $data["message"] = $output;
    if($extra)$data["extra"] = $extra;
    fnSendJSON($data);
}

function fn404(){
    header("HTTP/1.0 404 not found");
    echo "Your request could not be completed.";
    exit();
}

?>