<?php
/* 05/07/2021 - Arthur Faria
 * Simple example to show how to create an autoload using PSR4
 * 
 * 06/07/2021 - Arthur Faria
 * Leving this code comented just to have the history. 
 * In classes 22-23 I recreated the code to learn how to use composer
 */
//require 'autoload.php';
//$clsBasicMath = new \basic_math\BasicMath();
//$clsUpload = new \photo\Upload();

//classes 23-24
require 'vendor/autoload.php';

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use \classes\basic_math\BasicMath;
use \classes\photo\Upload;

$clsBasicMath = new BasicMath();
$clsUpload = new Upload();

// create a log channel
$log = new Logger('name');
$log->pushHandler(new StreamHandler('logs/test.log', Logger::WARNING));

// add records to the log
$log->warning('Foo');
$log->error('Bar');