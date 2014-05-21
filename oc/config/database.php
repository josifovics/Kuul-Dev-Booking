<?php defined('SYSPATH') or die('No direct script access.');
return array
(
    'default' => array(
        'type'       => 'mysqli',
        'connection' => array(
            'hostname'   => 'localhost',
            'username'   => 'root',
            'password'   => '',
            'persistent' => FALSE,
            'database'   => 'book',
            ),
        'table_prefix' => 'ob_',
        'charset'      => 'utf8',
        'profiling'    => (Kohana::$environment===Kohana::DEVELOPMENT)? TRUE:FALSE,
     ),
);