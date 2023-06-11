<?php
\PSFS\bootstrap::load();
/**
 * Autogenerated config file
 */
$serviceContainer = \Propel\Runtime\Propel::getServiceContainer();
$serviceContainer->checkVersion('2.0.0-dev');
$serviceContainer->setAdapterClass('AUTH', 'mysql');
$manager = new \Propel\Runtime\Connection\ConnectionManagerSingle();
$manager->setConfiguration(array(
    'dsn' => 'mysql:host=' . \PSFS\base\config\Config::getParam('db.host', null, 'auth') . ';port=' . \PSFS\base\config\Config::getParam('db.port', null, 'auth') . ';dbname=' . \PSFS\base\config\Config::getParam('db.name', null, 'auth') . '',
    'user' => \PSFS\base\config\Config::getParam('db.user', null, 'auth'),
    'password' => \PSFS\base\config\Config::getParam('db.password', null, 'auth'),
    'classname' => '\\Propel\\Runtime\\Connection\\ConnectionWrapper',
    'model_paths' => array(
        0 => 'src',
        1 => 'vendor',
    ),
));
$manager->setName('AUTH');
$serviceContainer->setConnectionManager('AUTH', $manager);

$serviceContainer->setAdapterClass('debugAUTH', 'mysql');
$manager = new \Propel\Runtime\Connection\ConnectionManagerSingle();
$manager->setConfiguration(array(
    'dsn' => 'mysql:host=' . \PSFS\base\config\Config::getParam('db.host', null, 'auth') . ';port=' . \PSFS\base\config\Config::getParam('db.port', null, 'auth') . ';dbname=' . \PSFS\base\config\Config::getParam('db.name', null, 'auth') . '',
    'user' => \PSFS\base\config\Config::getParam('db.user', null, 'auth'),
    'password' => \PSFS\base\config\Config::getParam('db.password', null, 'auth'),
    'classname' => 'Propel\\Runtime\\Connection\\DebugPDO',
    'model_paths' => array(
        0 => 'src',
        1 => 'vendor',
    ),
));
$manager->setName('debugAUTH');
$serviceContainer->setConnectionManager('debugAUTH', $manager);

$serviceContainer->setDefaultDatasource('AUTH');
$serviceContainer->setLoggerConfiguration('defaultLogger', array(
    'type' => 'stream',
    'path' => LOG_DIR . '/db.log',
    'level' => 300,
    'bubble' => true,
));

#require_once 'loadDatabase.php';
