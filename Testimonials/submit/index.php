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

echo $message;

# Send API response
# header('Content-Type: application/json');
# $data = "{status: true, message: 'Success!'}";
# echo $data;

?>