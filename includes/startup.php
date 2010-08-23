<?php

error_reporting (E_ALL | E_STRICT);
if (version_compare(phpversion(), '5.1.0', '<') == true) { die ('PHP5.1 Only or obove'); }

//Setting timezone
date_default_timezone_set('Europe/Riga');



// Константы:
define ('DIRSEP', DIRECTORY_SEPARATOR);



//Проста Добавлена Суб папка (если ненадо то поставить "/")
define ('subdir', '/MVC2/');

// Узнаём путь до файлов сайта
$site_path = dirname(dirname(__FILE__)) . DIRSEP;

define ('site_path', $site_path);

    // Загрузка классов «на лету»
    function __autoload($class_name) {
            $filename = strtolower($class_name) . '.php';
            $file = site_path . 'lib' . DIRSEP . $filename;
            if (file_exists($file) == false) {
                    return false;
            }
            include ($file);
    }





?>
