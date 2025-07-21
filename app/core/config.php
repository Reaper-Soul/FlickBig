<?php

define('VERSION', '0.7.0');

define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(__DIR__));
define('APPS', ROOT . DS . 'app');
define('CORE', ROOT . DS . 'core');
define('LIBS', ROOT . DS . 'lib');
define('MODELS', ROOT . DS . 'models');
define('VIEWS', ROOT . DS . 'views');
define('CONTROLLERS', ROOT . DS . 'controllers');
define('LOGS', ROOT . DS . 'logs');	
define('FILES', ROOT . DS. 'files');

// ---------------------  NEW DATABASE TABLE -------------------------
define('DB_HOST',         'i25ku.h.filess.io');
define('DB_USER',         'MariaMaria_awayglass'); 
define('DB_PASS',         $_ENV['DB_PASS']);
define('DB_DATABASE',     'MariaMaria_awayglass');
define('DB_PORT',         '3305');
define('OMDB_API_KEY',    $_ENV['OMDB_API_KEY']);
define('OMDB_API_KEY_2',  $_ENV['OMDB_API_KEY_2']);
define('OMDB_API_KEY_3',  $_ENV['OMDB_API_KEY_3']);
define('GEMINI_API_KEY',  $_ENV['GEMINI_API_KEY']);
define('GEMINI_API_KEY_2',  $_ENV['GEMINI_API_KEY_2']);