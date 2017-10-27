<?php
require_once '../vendor/autoload.php';


$tempname = tempnam("../", "jej");
dump($tempname);
$temp = fopen($tempname, "r+");
fwrite($temp, "

const Nightmare = require(\"nightmare\");
const nightmare = Nightmare({ show: false });

nightmare
    .goto('https://www.reddit.com/r/news/')
    .wait('#siteTable > div:first-child .title > a')
    .evaluate(() => document.querySelector(\"#siteTable > div:first-child .title > a\").textContent)
.end()
    .then(console.log)
    .catch((error) => {
    console.error('Search failed:', error);
});
");


exec("cat " . $tempname, $output);

dump($output);
//fseek($temp, 0);
//dump(fread($temp, 1024));

fclose($temp);
unlink($tempname);


//exec("xvfb-run node ../example.js", $output);
//
//dump($output);