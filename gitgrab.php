<?php

$username = $_SERVER['QUERY_STRING'];

if ($username == NULL) {
    $nograbinfo->searchQuery = "";
    $nograbinfo->unixTimestamp = time();
    $nograbinfo->emailAddress = "Please specify a username";

    $nograbinfojson = json_encode($nograbinfo);

    echo $nograbinfojson;

    die();
};

$config['useragent'] = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36 OPR/48.0.2685.35';

$ch = curl_init();
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_USERAGENT, $config['useragent']);
curl_setopt($ch, CURLOPT_URL, "https://api.github.com/users/{$username}/events");
$content = curl_exec($ch);

$emailIndex = strpos($content, "email", 0);

$nextColonIndex = strpos($content, ":", $emailIndex);
$nextCommanIndex = strpos($content, "," , $emailIndex);
$nextQuoteIndex = strpos($content, "\"", $nextColonIndex);
$nextNextQuoteIndex = strpos($content, "\"", $nextQuoteIndex+1);


$emailAddr =  substr($content, $nextQuoteIndex, $nextNextQuoteIndex-$nextQuoteIndex+1);

$cleaned = str_replace('"', "", $emailAddr);

$gitgrabinfo->searchQuery = $username;
$gitgrabinfo->unixTimestamp = time();
$gitgrabinfo->emailAddress = $cleaned;

$gitgrabinfojson = json_encode($gitgrabinfo);

echo $gitgrabinfojson;

?>