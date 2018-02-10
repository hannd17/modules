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
$uuid = hash("sha256", $testimonail . $name . $time);

# Build approval email

$headers = "From: " . NOREPLY_EMAIL . "\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
$subejct = "New Testimonial from $name";
$message = "<style>body{font-family: Helvetica}</style>";
$message .= "<h1>New testimonial from $name.</h1>";
$message .= "<p><strong>Hi " . ADMIN_NAME . ",</strong> a new testimonial has been pusblished on your website.</p>";
$message .= "<p><strong>Name:</strong> $name<br>";
$message .= "<strong>Email:</strong> $testimonial<br></p>";
$message .= "<p>To approve this testimonial, please click <a href='" . WEB_ADDRESS . "/Testimonials/approve?uid=$uuid'>here</a>.";
$message .= "<p><strong>Regards, " . WEB_ADDRESS . ".</strong></p>";

# Set status and message
$status = "true";
$output = "Your testimonial has been sent.";

# Write testimonial to a txt file
if(file_put_contents("submissions/$uuid.txt", "{name: \"$name\", testimonial: \"$testimonial\"}")){
    # The file was written successfully, let's notify the admin
    if(ENABLE_MAIL)mail(ADMIN_EMAIL, $subject, $message, $headers);
} else {
    # There was a problem saving the testimonial, alert the customer.
    $status = "false";
    $output = "Your testimonial could not be sent.";
};

# Send API response
fnAPIRespond($status, $output);

?>