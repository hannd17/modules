<?php

# Copyright hannd17 2018

include "../Config.php";
include "../Functions.php";

$chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";

$captcha = "";
for($i = 0; $i < CAPTCHA_LENGTH; $i++){
    $captcha .= $chars[rand(0, strlen($chars))];
}

$captcha_hash = hash("sha256", $captcha . CAPTCHA_SALT);

$captcha_img = imagecreate(200, 80);
$background = imagecolorallocate($captcha_img, 255, 255, 255 );
$text_colour = imagecolorallocate($captcha_img, 0, 0, 0);
imagestring($captcha_img, 20, 30, 25, $captcha, $text_colour);

imagecolordeallocate($text_color);
imagecolordeallocate($background);

ob_start();
imagepng($captcha_img);
$buffer = ob_get_clean();
ob_end_clean();
$encoded = base64_encode($buffer);
imagedestroy($captcha_img);

$data = array();
$data["image"] = $encoded;
$data["hash"] = $captcha_hash;
fnAPIRespond("true", "Please enter the captcha.", $data);

?>