<?php
$serviceContainer = \Propel\Runtime\Propel::getServiceContainer();
$serviceContainer->initDatabaseMaps(array (
  'AUTH' =>
  array (
    0 => '\\AUTH\\Models\\Map\\LoginAccountPasswordTableMap',
    1 => '\\AUTH\\Models\\Map\\LoginAccountTableMap',
    2 => '\\AUTH\\Models\\Map\\LoginPathTableMap',
    3 => '\\AUTH\\Models\\Map\\LoginProviderTableMap',
    4 => '\\AUTH\\Models\\Map\\LoginSessionTableMap',
  ),
));
