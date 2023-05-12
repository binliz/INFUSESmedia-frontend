<?php

use app\Handlers\BannerHandler;

require dirname(__DIR__) . '/init.php';
$config = require dirname(__DIR__) . '/config.php';
if(isset($_GET['handler'])) {
    $class= '\app\Handlers\\'.ucfirst(trim($_GET['handler']).'Handler');
    if(class_exists($class)) {
        $app = new \app\App($config);
        $app->setHandler(new $class())
            ->handle();
    }
}
