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
    'ereport' => array(
        'driver' => 'mysql',
        'host' => getenv('MYSQL_HOST') ?? 'e-reportpoldakalbar.id',
        'port' => getenv('MYSQL_PORT') ?? '3306',
        'user' => getenv('MYSQL_USER') ?? 'ereport',
        'password' => getenv('MYSQL_PASS') ?? 'Q5Cce#2Au51#rK',
        'dbname' => getenv('MYSQL_DBNAME') ?? 'ereport_database',
        'charset' => 'utf8',
        'collate' => 'utf8_general_ci',
        'persistent' => false,
        'errorMsg' => 'Maaf, Gagal terhubung dengan database',
    ),
);
/*----------------------*/
?>
