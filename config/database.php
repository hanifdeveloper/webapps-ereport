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
        'host' => getenv('MYSQL_HOST') ?? 'localhost',
        'port' => getenv('MYSQL_PORT') ?? '3306',
        'user' => getenv('MYSQL_USER') ?? 'ereportp',
        'password' => getenv('MYSQL_PASS') ?? 'a!ZMVpaXX:;j',
        'dbname' => getenv('MYSQL_DBNAME') ?? 'ereportp_database',
        'charset' => 'utf8',
        'collate' => 'utf8_general_ci',
        'persistent' => false,
        'errorMsg' => 'Maaf, Gagal terhubung dengan database',
    ),
);
/*----------------------*/
?>
