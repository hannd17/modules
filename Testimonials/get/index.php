<?php

include "../Config.php";
include "../Functions.php";

# Get approved testimonials and return a JSON object with text name and date.

$testimonials = array_diff(scandir("../submit/submissions/approved"), array("..", "."));


$data = array();

$i = 0;
$max = 5;
foreach($testimonials as $uuid){
    $testimonial = file_get_contents("../submit/submissions/approved/$uuid");
    $data[$i] = $testimonial;
    $i++;
    if($i == $max)break;
}

# Send API response
fnSendJSON($data);
    
?>