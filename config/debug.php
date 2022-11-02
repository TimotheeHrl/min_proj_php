<?php

use Whoops\Run;
use Whoops\Handler\PrettyPageHandler;

$whoops = new Run();
$whoops->prependHandler(new PrettyPageHandler());
$whoops->register();
// enable var_dump
ini_set('xdebug.var_display_max_depth', '10');
