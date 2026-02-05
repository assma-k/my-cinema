<?php

spl_autoload_register(function ($class) {

    $directories = [
        __DIR__ . '/Controller/',
        __DIR__ . '/Model/',
        __DIR__ . '/Helper/',
        __DIR__ . '/Config/',
        __DIR__ . '/repositories/',
        __DIR__ . '/router/',
    ];

    foreach ($directories as $directory) {
        $file = $directory . $class . '.php';
   
        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }

    throw new Exception('Cannot load the class: ' . $class);
});
