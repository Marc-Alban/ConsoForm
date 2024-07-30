<?php
// config/database.php
return [
    'local' => [
        'host' => $_ENV['DB_LOCAL_HOST'] ?: '',
        'dbname' => $_ENV['DB_LOCAL_NAME'] ?: '',
        'username' => $_ENV['DB_LOCAL_USER'] ?: '',
        'password' => $_ENV['DB_LOCAL_PASS'] ?: '',
    ],
    'dev' => [
        'host' => $_ENV['DB_DEV_HOST'] ?: '',
        'dbname' => $_ENV['DB_DEV_NAME'] ?: '',
        'username' => $_ENV['DB_DEV_USER'] ?: '',
        'password' => $_ENV['DB_DEV_PASS'] ?: '',
    ],
    'prod' => [
        'host' => $_ENV['DB_PROD_HOST'] ?: '',
        'dbname' => $_ENV['DB_PROD_NAME'] ?: '',
        'username' => $_ENV['DB_PROD_USER'] ?: '',
        'password' => $_ENV['DB_PROD_PASS'] ?: '',
    ],
];


// config/session.php
return [
    'lifetime' => 0,
    'path' => '/',
    'domain' => $_SERVER['HTTP_HOST'],
    'secure' => true,
    'httponly' => true,
    'samesite' => 'None',
];
