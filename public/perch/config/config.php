<?php
    define('PERCH_LICENSE_KEY', 'P21405-CXB207-BUM172-SXK417-TDE004');
 
 
    $http_host = getenv('HTTP_HOST');

    switch($http_host)
{
    case('blogwithperch.app:8000') : 
        define("PERCH_DB_USERNAME", 'homestead');
        define("PERCH_DB_PASSWORD", 'secret');
        define("PERCH_DB_SERVER", "localhost");
        define("PERCH_DB_DATABASE", "posts");
        break;

    case('www.assessandimprove.com') : 
        define("PERCH_DB_USERNAME", 'forge');
        define("PERCH_DB_PASSWORD", 'EAMLupFQ6az4yJAx02uo');
        define("PERCH_DB_SERVER", "178.62.54.19");
        define("PERCH_DB_DATABASE", "forge");
        define("PERCH_DB_PREFIX", "perch2_");
        break; 


    default :
        define("PERCH_DB_USERNAME", 'forge');
        define("PERCH_DB_PASSWORD", 'EAMLupFQ6az4yJAx02uo');
        define("PERCH_DB_SERVER", "178.62.54.19");
        define("PERCH_DB_DATABASE", "forge");
        break;
    }
/*
    define("PERCH_DB_USERNAME", 'homestead');
    define("PERCH_DB_PASSWORD", 'secret');
    define("PERCH_DB_SERVER", "localhost");
    define("PERCH_DB_DATABASE", "posts");
*/

    define("PERCH_DB_PREFIX", "perch2_");
    
    define('PERCH_TZ', 'UTC');

    define('PERCH_EMAIL_FROM', 'martin.rowe@assessandimprove.co.uk');
    define('PERCH_EMAIL_FROM_NAME', 'Martin Rowe');

    define('PERCH_LOGINPATH', '/perch');
    define('PERCH_PATH', str_replace(DIRECTORY_SEPARATOR.'config', '', __DIR__));
    define('PERCH_CORE', PERCH_PATH.DIRECTORY_SEPARATOR.'core');

    define('PERCH_RESFILEPATH', PERCH_PATH . DIRECTORY_SEPARATOR . 'resources');
    define('PERCH_RESPATH', PERCH_LOGINPATH . '/resources');
    
    define('PERCH_HTML5', true);
