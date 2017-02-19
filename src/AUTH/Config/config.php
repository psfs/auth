<?php
$serviceContainer = \Propel\Runtime\Propel::getServiceContainer();
$serviceContainer->checkVersion('2.0.0-dev');
$serviceContainer->setAdapterClass('AUTH', 'mysql');
$manager = new \Propel\Runtime\Connection\ConnectionManagerSingle();
$manager->setConfiguration(array (
  'dsn' => 'mysql:host=127.0.0.1;port=3306;dbname=PSFS',
  'user' => 'psfs',
  'password' => 'psfs',
  'classname' => 'Propel\\Runtime\\Connection\\PropelPDO',
  'model_paths' =>
  array (
    0 => 'src',
    1 => 'vendor',
  ),
));
$manager->setName('AUTH');
$serviceContainer->setConnectionManager('AUTH', $manager);
$serviceContainer->setAdapterClass('debugAUTH', 'mysql');
$manager = new \Propel\Runtime\Connection\ConnectionManagerSingle();
$manager->setConfiguration(array (
  'dsn' => 'mysql:host=127.0.0.1;port=3306;dbname=PSFS',
  'user' => 'psfs',
  'password' => 'psfs',
  'classname' => 'Propel\\Runtime\\Connection\\DebugPDO',
  'model_paths' =>
  array (
    0 => 'src',
    1 => 'vendor',
  ),
));
$manager->setName('debugAUTH');
$serviceContainer->setConnectionManager('debugAUTH', $manager);
$serviceContainer->setDefaultDatasource('AUTH');
$serviceContainer->setLoggerConfiguration('defaultLogger', array (
  'type' => 'stream',
  'path' => './../../../../logs/db.log',
  'level' => 300,
));