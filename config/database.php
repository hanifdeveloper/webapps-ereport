<?php
/* Database Configuration */
return array(
    /**
     * 
     * Database Sample Project
     * =======================
     * Install database sample via terminal
     * cd assests/
     * sudo php install.php
     * 
     * Tunneling Database
     * ssh -N -L 13306:127.0.0.1:3306 root@domain.com
     * 
     */
    'complaint' => array(
        'driver' => 'mysql',
        'host' => getenv('MYSQL_HOST'),
        'port' => getenv('MYSQL_PORT'),
        'user' => getenv('MYSQL_USER'),
        'password' => getenv('MYSQL_PASS'),
        'dbname' => getenv('MYSQL_DBNAME'),

        // 'host' => 'e-reportpoldakalbar.id',
        // 'user' => 'ereport',
        // 'password' => 'Q5Cce#2Au51#rK',
        // 'dbname' => 'ereport_database',

        'charset' => 'utf8',
        'collate' => 'utf8_general_ci',
        'persistent' => false,
        'errorMsg' => 'Maaf, Gagal terhubung dengan database',
    ),
);
/*----------------------*/
?>
