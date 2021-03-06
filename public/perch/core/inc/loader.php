<?php
    function perch_autoload($class_name) {
        if (strpos($class_name, 'PerchAPI')!==false) {
            $file = PERCH_CORE . '/lib/api/' . $class_name . '.class.php';
        }else{
            $file = PERCH_CORE . '/lib/' . $class_name . '.class.php';
        }   
        
        if (is_readable($file)) {
            require $file;
            return true;
        }
        return false;
    }
    
    spl_autoload_register('perch_autoload');
     
    if (extension_loaded('mbstring')) mb_internal_encoding('UTF-8');

    if (defined('PERCH_TZ')) {
        date_default_timezone_set(PERCH_TZ);
    }else{
        date_default_timezone_set('UTC');
    }

    if (defined('PERCH_LICENSE_KEY')) {

        $perch_key = PERCH_LICENSE_KEY;
        if ($perch_key[0]=='R') {
            define('PERCH_RUNWAY', true);

            if (version_compare(PHP_VERSION, '5.4.0', '<')) {
                die('Perch Runway requires PHP 5.4. This server is running version ' . PHP_VERSION);
            }

            include(PERCH_PATH.'/core/runway/inc/loader.php');
        }else{
            define('PERCH_RUNWAY', false);

            if (version_compare(PHP_VERSION, '5.3.0', '<')) {
                die('Perch requires PHP 5.3. This server is running version ' . PHP_VERSION);
            }
        }

    }
    

    if (!defined('PERCH_ERROR_MODE'))  define('PERCH_ERROR_MODE', 'DIE');

    if (!defined('PERCH_DATE_LONG'))   define('PERCH_DATE_LONG', '%d %B %Y');
    if (!defined('PERCH_DATE_SHORT'))  define('PERCH_DATE_SHORT', '%d %b %Y');
    if (!defined('PERCH_TIME_SHORT'))  define('PERCH_TIME_SHORT', '%H:%M');
    if (!defined('PERCH_TIME_LONG'))   define('PERCH_TIME_LONG', '%H:%M:%S');
