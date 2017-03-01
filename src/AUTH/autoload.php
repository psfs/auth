<?php
/**
 * AUTH Module
 * @author Fran López <fran.lopez84@hotmail.es>
 * @version 1.0
 * Autogenerated autoloader [2017-02-20 00:27:02]
 */
if(!defined("BASE_DIR"))
define("BASE_DIR", dirname( dirname(__DIR__) ) );

require_once __DIR__ . DIRECTORY_SEPARATOR . 'Config' . DIRECTORY_SEPARATOR . 'config.php';
@include_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

if(!function_exists("AUTH_Autoloader")) {
    // autoloader
    function AUTH_Autoloader( $class ) {
        // it only autoload class into the Rain scope
        if (false !== preg_match('/^\\\?AUTH/', $class)) {
            // Change order src
            $class = preg_replace('/^\\\?AUTH/', 'AUTH', $class);
            // transform the namespace in path
            $path = str_replace("\\", DIRECTORY_SEPARATOR, $class );
            // filepath
            $abs_path = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . $path . ".php";

            // require the file
            if(file_exists($abs_path)) {
                require_once $abs_path;
            }
        }
        return false;
    }

    // register the autoloader
    spl_autoload_register( "AUTH_Autoloader" );
}