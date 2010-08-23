<?php
//константы,структура, итд.
include 'includes/startup.php';

//декларация навигации
Route::delegate();

//Выводим стндартного макет(layout) на екран
include 'views/layouts/application.html.php';
?>
