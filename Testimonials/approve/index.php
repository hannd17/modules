<?php

include "../Config.php";
include "../Functions.php";

# Approve a testimonial from a given unique ID.

if(!isset($_GET["uid"])){
    fn404();
}

$uuid = $_GET["uid"];

# Set status and message
$status = "true";
$output = "Testimonial approved.";

# Get testimonial contents
if(file_exists("../submit/submissions/$uuid.txt")){
    $testimonial = file_get_contents("../submit/submissions/$uuid.txt");
    
    # Write testimonial to approved txt file
    if(file_put_contents("../submit/submissions/approved/$uuid.txt", $testimonial)){
        # Written. Let"s delete the old one.
        unlink("../submit/submissions/$uuid.txt");
    } else {
        # There was a problem saving the testimonial, alert the customer.
        $status = "false";
        $output = "This could not be approved.";
    };
    
} else {
    fn404();
}

# Send API response
fnAPIRespond($status, $output);

?>