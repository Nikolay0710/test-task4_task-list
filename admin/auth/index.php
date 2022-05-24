<?php
    
    session_start();
    
    // Ставим флаг против прямого обращение к Админ панели
    define('INDEX', TRUE);

    // Подключение конфигурационного файла из пользователькой части
    require($_SERVER['DOCUMENT_ROOT'] . '/config.php');

    if(!isset($_SESSION['auth']['admin'])) {
        header("Location: ". ADMIN_PAST ."auth/enter.php");
        exit();
    }
    else {
        header("Location: " . ADMIN_PAST);
        exit();
    }

?>