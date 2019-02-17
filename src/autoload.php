<?php
spl_autoload_register(function ($className) {
    $fileName = str_replace('\\', DIRECTORY_SEPARATOR, $className) . '.php';

    if (!file_exists($fileName)) {
        die($fileName . ' not found');
    }

    require_once $fileName;
});