<?php

	//ini_set('display_errors', -1);
    //error_reporting(E_ALL);

	// проверка на доступность константы \\
    defined('INDEX') or die('Access denied');

    session_start() ;// стартуем сессию

    require(MODEL); // подключение модели
    require('functions/functions.php');  // подключение файла функции
    
    // print_arr($task_list);

	$view = empty($_GET['view']) ? 'main' : $_GET['view']; // получение динамичной части шаблона (.content)

	switch($view) {

		case('main'):
            // страницы
        	if(isset($_POST['submit'])) {
    			set_task_list();
    			redirect();
    		}
             /** ===== Cортировка ===== */
            // массив параметров сортировки ключи - это то что передаю гет параметром, 
            // а вот что значение уже показываем пользователю 1 а второй ключ для модели
            $order_p = array(
                            'namea' => array('По имени от А до Я','name ASC'),
                            'named' => array('По имени от Я до А','name DESC'),
                            'emaila' => array('По email от А до Я','email ASC'),
                            'emaild' => array('По email от Я до А','email DESC'),
                            'datea' => array('По дате добавление к последним','date ASC'),
                            'dated' => array('По дате добавление c последних','date DESC')
            );
            $orde_get = cleanHtmlCodes( $_GET['order'] ); // получаем возможный пораметр сортировки

            if(array_key_exists($orde_get, $order_p)) {
                $order = $order_p[$orde_get][0];
                $order_db = $order_p[$orde_get][1];
            }
            else {
                $order = $order_p['namea'][0];
                $order_db = $order_p['namea'][1];
            }
            /** ===== Cортировка ===== */
            // получаем параметер для навигации
    		if(isset($_GET['page'])) {
                $list = (int) $_GET['page'];
                if($list < 1) $list = 1;
            } else $list = 1;
	    	// пораметры для навигации
            $count_pages = count_oll_task_list();
            $pages_count = ceil($count_pages / COUNT_TASK_LIST);
            if(!$pages_count) $pages_count = 1;
            if($list > $pages_count) $list = $pages_count;
            $start_pos = (($list - 1) * COUNT_TASK_LIST);
            $task_list = get_task_list($start_pos, COUNT_TASK_LIST, $order_db);
        break;

		default:
			$view = 'main';
		break;
	}

	require(TEMPLATE . 'index.php'); // подключение вида