<?php 

	defined('INDEX') or die('Access denied'); // Проверка на доступность константы \\
    
    define('PAST', 'http://task-list.loc/');  // Имя домена \\
    define('MODEL', 'model/model.php'); // Имя модели //
    define('CONTROLLER', 'controller/controller.php'); // Имя контроллера \\
    define('VIEW', 'views/'); // Папка с видами //
    define('TEMPLATE', VIEW . 'tmp_task_list/'); // Активный шаблон \\
    define('COUNT_TASK_LIST', 3); // Количество выводов список задач \\
    define('ADMIN_PAST', PAST .'admin/'); // Админка \\
    define('ADMIN_ON_PAST', 'admin/'); // Админка \\
    define('ADMIN_TEMPLATE', ADMIN_ON_PAST .'templates/'); // шаблоны \\
    define('ADMIN_PAST_TEMPLATE', PAST . ADMIN_TEMPLATE); // шаблоны \\
    define('ADMIN_TEMPLATE_BLOCKS', ADMIN_TEMPLATE .'blocks/'); // блоки сайта \\

    const DB_HOST = 'localhost';  // Сервер базы данных //
    const DB_USER = 'root'; // Имя пользователя \\
    const DB_PASS = 'root'; // Пароль пользователя //
    const DB_NAME = 'task-list'; // Имя базы данных \\
    $db = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    if (!$db) {
		echo "Ошибка: Невозможно установить соединение с MySQL." . PHP_EOL;
		echo "Код ошибки errno: " . mysqli_connect_errno() . PHP_EOL;
		echo "Текст ошибки error: " . mysqli_connect_error() . PHP_EOL;
		exit();
    }