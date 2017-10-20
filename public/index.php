<?php
require_once '../vendor/autoload.php';

exec("xvfb-run node ../example.js", $output);

dump($output);