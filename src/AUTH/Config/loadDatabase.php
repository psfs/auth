<?php
$serviceContainer = \Propel\Runtime\Propel::getServiceContainer();
$serviceContainer->initDatabaseMapFromDumps(array (
  'AUTH' => 
  array (
    'tablesByName' => 
    array (
      'AUTH_ACCOUNTS' => '\\AUTH\\Models\\Map\\LoginAccountTableMap',
      'AUTH_ACCOUNT_PASSWORDS' => '\\AUTH\\Models\\Map\\LoginAccountPasswordTableMap',
      'AUTH_PATHS' => '\\AUTH\\Models\\Map\\LoginPathTableMap',
      'AUTH_PROVIDERS' => '\\AUTH\\Models\\Map\\LoginProviderTableMap',
      'AUTH_SESSIONS' => '\\AUTH\\Models\\Map\\LoginSessionTableMap',
    ),
    'tablesByPhpName' => 
    array (
      '\\LoginAccount' => '\\AUTH\\Models\\Map\\LoginAccountTableMap',
      '\\LoginAccountPassword' => '\\AUTH\\Models\\Map\\LoginAccountPasswordTableMap',
      '\\LoginPath' => '\\AUTH\\Models\\Map\\LoginPathTableMap',
      '\\LoginProvider' => '\\AUTH\\Models\\Map\\LoginProviderTableMap',
      '\\LoginSession' => '\\AUTH\\Models\\Map\\LoginSessionTableMap',
    ),
  ),
));
