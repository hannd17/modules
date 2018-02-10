<?php

include "../Config.php";

# Submit a testimonial using post

if(!isset($_GET["testimonial"]) || !isset($_GET["name"])){
    header("HTTP/1.0 404 not found");
    echo "Your request could not be completed.";
    exit();
}

# Generate testimonial information
$testimonial = $_GET["testimonial"];
$name = $_GET["name"];
$time = microtime();
$uuid = hash("sha256", $testimonail . $name . $time);

# Send approval email




# Send API response
header('Content-Type: application/json');
$data = "{status: true, message: 'Success!'}";
echo $data;

?>