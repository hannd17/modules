<?php

# Copyright hannd17 2018

include "../Config.php";
include "../Functions.php";

// 404 is there is no uid or captcha guess.
if(!isset($_GET["uid"]) || !isset($_GET["captcha"])){
    fn404();
}

$captcha_hash = hash("sha256", strtoupper($_GET["captcha"]) . CAPTCHA_SALT);

$status = "";
$message = "";

if($captcha_hash == $_GET["uid"]){
    // Code == hash
    $status = "true";
    $message = "You shall now pass.";
} else {
    $status = "false";
    $message = "You shall not pass.";
}

fnAPIRespond($status, $message);

?>