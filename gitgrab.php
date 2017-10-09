<?php

$username = $_SERVER['QUERY_STRING'];

// Block the search result for a specific username

if ($username == "exampleUser") {
    $hidegrabinfo->searchQuery = $username;
    $hidegrabinfo->unixTimestamp = time();
    $hidegrabinfo->emailAddress = "This user has hidden their email address";

    $hidegrabinfojson = json_encode($hidegrabinfo);

    echo $hidegrabinfojson;

    die();
};

// Return an error if a username is not provided

if ($username == NULL) {
    $nograbinfo->searchQuery = "";
    $nograbinfo->unixTimestamp = time();
    $nograbinfo->emailAddress = "Please specify a username";

    $nograbinfojson = json_encode($nograbinfo);

    echo $nograbinfojson;

    die();
};

// Set cURL Useragent

$config['useragent'] = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.90 Safari/537.36 OPR/47.0.2631.80';

$ch = curl_init();
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_USERAGENT, $config['useragent']);
curl_setopt($ch, CURLOPT_URL, "https://api.github.com/users/{$username}/events");
$content = curl_exec($ch);

// Search from the start

$emailIndex = strpos($content, "email", 0);

// Filter out GitHub JSON

$nextColonIndex = strpos($content, ":", $emailIndex);
$nextCommanIndex = strpos($content, "," , $emailIndex);
$nextQuoteIndex = strpos($content, "\"", $nextColonIndex);
$nextNextQuoteIndex = strpos($content, "\"", $nextQuoteIndex+1);

$emailAddr =  substr($content, $nextQuoteIndex, $nextNextQuoteIndex-$nextQuoteIndex+1);

$cleaned = str_replace('"', "", $emailAddr);

// Generate GitGrab JSON

$gitgrabinfo->searchQuery = $username;
$gitgrabinfo->unixTimestamp = time();
$gitgrabinfo->emailAddress = $cleaned;

$gitgrabinfojson = json_encode($gitgrabinfo);

// Show GitGrab JSON Result

echo $gitgrabinfojson;

?>