<?php

if(!defined('AUTH_MODULE_LOADER')) {
    define('AUTH_MODULE_LOADER', true);
    spl_autoload_register(function (string $class) {
        if (str_starts_with($class, 'AUTH\\')) {
            $relativeClass = substr($class, strlen('AUTH\\'));
            $file = __DIR__ . DIRECTORY_SEPARATOR . str_replace('\\', DIRECTORY_SEPARATOR, $relativeClass) . '.php';
            if (file_exists($file)) {
                require_once $file;
            }
        }
    });
}
require_once __DIR__ . DIRECTORY_SEPARATOR . 'Config' . DIRECTORY_SEPARATOR . 'config.php';
