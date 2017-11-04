<?php

use Rayac\nightmarePHP\nightmarePHP;

require_once '../vendor/autoload.php';



//$testing = new nightmarePHP();
//$testing->rawInput("
//const Nightmare = require(\"nightmare\");
//const nightmare = Nightmare({ show: false });
//
//nightmare
//    .goto('https://www.reddit.com/r/news/')
//    .wait('#siteTable > div:first-child .title > a')
//    .evaluate(() => document.querySelector(\"#siteTable > div:first-child .title > a\").textContent)
//.end()
//    .then(console.log)
//    .catch((error) => {
//    console.error('Search failed:', error);
//});
//")->run();

$nightmare = new nightmarePHP();

$nightmare->config("show: false");

$nightmare
->_goto('http://www.telegraph.co.uk/science/')
->wait('main article .list-of-entities__item-body-headline')
->evaluate("() => document.querySelector(\"main article .list-of-entities__item-body-headline\").textContent")
->end()
->then("console.log")
->_catch("(error) => {console.error('Search failed:', error);}")
->run();

dump($nightmare->getResult());




//fseek($temp, 0);
//dump(fread($temp, 1024));
