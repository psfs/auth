<?php
// Autogenerated propel configuration [2023-06-03 19:51:04]
return [
    'propel' => [
        'database' => [
            'connections' => [
                'AUTH' => [
                    'adapter'    => 'mysql',
                    'dsn' => 'mysql:host=' . \PSFS\base\config\Config::getParam('db.host', null, 'auth') . ';port=' . \PSFS\base\config\Config::getParam('db.port', null, 'test') . ';dbname=' . \PSFS\base\config\Config::getParam('db.name', null, 'test') . '',
                    'user' => \PSFS\base\config\Config::getParam('db.user', null, 'auth'),
                    'password' => \PSFS\base\config\Config::getParam('db.password', null, 'auth'),
                    'classname' => '\Propel\Runtime\Connection\ConnectionWrapper',
                    'attributes' => []
                ],
                'debug_AUTH' => [
                    'adapter'    => 'mysql',
                    'dsn' => 'mysql:host=' . \PSFS\base\config\Config::getParam('db.host', null, 'auth') . ';port=' . \PSFS\base\config\Config::getParam('db.port', null, 'test') . ';dbname=' . \PSFS\base\config\Config::getParam('db.name', null, 'test') . '',
                    'user' => \PSFS\base\config\Config::getParam('db.user', null, 'auth'),
                    'password' => \PSFS\base\config\Config::getParam('db.password', null, 'auth'),
                    'classname' => '\Propel\Runtime\Connection\ConnectionWrapper',
                    'attributes' => []
                ]
            ],
            'adapters' => [
                'mysql' => [
                    'tableType' =>  'InnoDB',
                    'tableEngineKeyword' => 'ENGINE'
                ]
            ]
        ],
        'runtime' => [
            'defaultConnection' => 'AUTH',
            'connections' => ['AUTH', 'debug_AUTH'],
            'log' => [
                'defaultLogger' => [
                    'type' => 'stream',
                    'path' => LOG_DIR . 'db.log',
                    'level' => 300,
                ]
            ]
        ],
        'generator' => [
            'defaultConnection' => 'AUTH',
            'connections' => ['AUTH', 'debug_AUTH']
        ]
    ]
];
