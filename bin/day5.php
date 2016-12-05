<?php
chdir(__DIR__ . '/../');
require_once('vendor/autoload.php');

$key = 'cxdnnyjw';
$password = new \Advent2016\DayFive\Password();

echo $password->getPassword($key) . PHP_EOL;