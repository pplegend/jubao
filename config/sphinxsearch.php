<?php
return array(
    'host'    => '127.0.0.1',
    'port'    => 9312,
    'timeout' => 30,
    'indexes' => array(
        'jubao_phone_index' => array('table' => 'jubao_phones', 'column' => 'id'),
    ),
    'mysql_server' => array(
        'host' => '127.0.0.1',
        'port' => 3306,
        'user' => 'root',
        'database' => 'woyaojubao',
        'pass' => 'root'
    )
);
