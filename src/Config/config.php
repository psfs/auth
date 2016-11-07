<?php
$serviceContainer = \Propel\Runtime\Propel::getServiceContainer();
$serviceContainer->checkVersion('2.0.0-dev');
$serviceContainer->setAdapterClass('Auth', 'mysql');
$manager = new \Propel\Runtime\Connection\ConnectionManagerSingle();
$config = \PSFS\base\config\Config::getInstance();
$manager->setConfiguration(array(
    'dsn' => 'mysql:host=' . $config->get('db_host') . ';port=' . $config->get('db_port') . ';dbname=' . $config->get('db_name'),
    'user' => $config->get('db_user'),
    'password' => $config->get('db_password'),
    'classname' => 'Propel\\Runtime\\Connection\\PropelPDO',
    'model_paths' =>
        array(
            0 => 'src',
            1 => 'vendor',
        ),
));
$manager->setName('Auth');
$serviceContainer->setConnectionManager('Auth', $manager);
$serviceContainer->setAdapterClass('debugAuth', 'mysql');
$manager = new \Propel\Runtime\Connection\ConnectionManagerSingle();
$manager->setConfiguration(array(
    'dsn' => 'mysql:host=' . $config->get('db_host') . ';port=' . $config->get('db_port') . ';dbname=' . $config->get('db_name'),
    'user' => $config->get('db_user'),
    'password' => $config->get('db_password'),
    'classname' => 'Propel\\Runtime\\Connection\\DebugPDO',
    'model_paths' =>
        array(
            0 => 'src',
            1 => 'vendor',
        ),
));
$manager->setName('debugAuth');
$serviceContainer->setConnectionManager('debugAuth', $manager);
$serviceContainer->setDefaultDatasource('Auth');
$serviceContainer->setLoggerConfiguration('defaultLogger', array(
    'type' => 'stream',
    'path' => './../../../../logs/db.log',
    'level' => 300,
));