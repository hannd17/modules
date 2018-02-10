<?php

include "../Config.php";
include "../Functions.php";

# Submit a testimonial using post

if(!isset($_GET["testimonial"]) || !isset($_GET["name"])){
    fn404();
}

# Generate testimonial information
$testimonial = $_GET["testimonial"];
$name = $_GET["name"];
$time = microtime();
$uuid = hash("sha256", $testimonial . $name . $time);

# Set status and message
$status = "true";
$output = "Your testimonial has been sent.";

$data = array();
$data["name"] = $name;
$data["testimonial"] = $testimonial;

if(strlen($name) < 3 || strlen($testimonial) < 3){
    # The name or testimonial is too short. Preventing spam?
    
    $status = "false";
    $output = "Please fill in all of the boxes.";
    
} else if(file_put_contents(AUTO_APPROVE ? "submissions/approved/$uuid.txt" : "submissions/$uuid.txt", json_encode($data))){
    # Write testimonial to a txt file
    # The file was written successfully, let's notify the admin
    if(ENABLE_MAIL && !AUTO_APPROVE){
        
        # Build approval email
        $headers = "From: " . NOREPLY_EMAIL . "\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
        $subject = "New Testimonial from $name";
        $message = "<h1>New testimonial from $name.</h1>";
        $message .= "<p><strong>Hi " . ADMIN_NAME . ",</strong> a new testimonial has been pusblished on your website.</p>";
        $message .= "<p><strong>Name:</strong> $name<br>";
        $message .= "<strong>Testimonial:</strong> $testimonial<br></p>";
        $message .= "<p>To approve this testimonial, please click <a href='" . WEB_ADDRESS . "/Testimonials/approve?uid=$uuid'>here</a>.";
        $message .= "<p><strong>Kind regards,</strong> your website.</p>";
        
        mail(ADMIN_EMAIL, $subject, $message, $headers);
    }
} else {
    # There was a problem saving the testimonial, alert the customer.
    $status = "false";
    $output = "Your testimonial could not be sent.";
};

# Send API response
fnAPIRespond($status, $output);

?>