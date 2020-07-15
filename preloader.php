<?php declare(strict_types=1);

$autoloadFile = getenv('AUTOLOAD_DIR') ? : __DIR__ . '/vendor/autoload.php';

include $autoloadFile;

$undertaker = new Nenad\Undertaker\Preloader($autoloadFile);
$undertaker->load(getenv('SRC_DIR'));
