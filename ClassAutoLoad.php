<?php

require 'Plugins/PHPMailer/vendor/autoload.php';
require_once 'config.php';

$directories = ["Forms", "Layouts", "Services"];

spl_autoload_register(function ($className) use ($directories) {
    foreach ($directories as $directory) {
        $filePath = __DIR__ . "/$directory/" . $className . '.php';
        if (file_exists($filePath)) {
            require_once $filePath;
            return;
        }
    }
});

// Create Objects
$ObjForm   = new Form();
$ObjLayout = new layouts();
$ObjSendMail = new Mail();