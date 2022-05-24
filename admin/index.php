<?php
    /** ===> Файл конфигурационный, и единый файл входа в Админ часть приветствует вас! и желает приятной работы <=== */
    
    // Ставим флаг против прямого обращение к Админе панели
    define('INDEX', TRUE);
    
    session_start(); // Стартуем сессию
    
    // Выход с администраторской части
    if(isset($_GET['do']) == 'logout') {
        unset($_SESSION['auth']);
        $_SESSION['Access_denied'] = "<div class='success' style='text-align: center;'>Вы вышли из системы.</div>";
        header("Location: {$_SERVER['PHP_SELF']}");
        exit();
    }
    
    // Подключение файла конфигурации из пользовательской части
    require($_SERVER['DOCUMENT_ROOT'] .'/config.php');
    
    // Подключение авторизации (защита) вход только авторизованным пользователям
    if(!isset($_SESSION['auth']['admin'])) {
        require(__DIR__ .'/auth/index.php');
    }

    // Подключение файла функции из пользойской части
    require('../functions/functions.php');
    
    // Подключение файла функции Админ части
    require('functions/functions.php');

    $user_admin = get_user_admin();
        
    // Получение денамичной части сайта (CONTENTA)
    $view = empty($_GET['view']) ? 'get_text' : $_GET['view'];
    
    switch($view) {
       
        case('get_text'):
            // Получаем весь список задач
            $task_list = get_task_list();

            // Удаление списков задач
            if(isset($_GET['del_list']) && is_numeric($_GET['del_list'])) {
                del_list();
                header("Location: {$_SERVER['PHP_SELF']}");
                exit();
            }
        break;

        case('edit_text'):
            $get_id = (int)$_GET['id'];
            $get_text = get_text($get_id);

            if($_POST['fullText']) {
                if(edit_task_text($get_id)) {
                    header('Location: '. ADMIN_PAST);
                    exit;
                } else redirect();
            }
        break;

        case('users_page'):
            $array_users = get_users();
        break;

        case('add_user'):
            if(isset($_POST['add_user_x'])) {
                $add_user = add_user();
                if($add_user === true) redirect('?view=users_page');
            }
        break;

        case('edit_user'):
            $user_id = abs((int)$_GET['user_id']);
            $get_user = get_user($user_id);
            if(isset($_POST['edit_user_x'])) {
                $new_name_user = cleanHtmlCodes($_POST['name']);
                $new_login_user = cleanHtmlCodes(mb_convert_case($_POST['login'], MB_CASE_LOWER, 'UTF-8'));
                $self_pass_user = cleanHtmlCodes(mb_convert_case($_POST['current_pass'], MB_CASE_LOWER, 'UTF-8'));
                $new_password_1 = cleanHtmlCodes(mb_convert_case($_POST['password1'], MB_CASE_LOWER, 'UTF-8'));
                $new_password_2 = cleanHtmlCodes(mb_convert_case($_POST['password2'], MB_CASE_LOWER, 'UTF-8'));
                $new_role_user = (int) $_POST['role_user'];

                $edit_user = edit_user($new_name_user, $new_login_user, $self_pass_user, $new_password_1, $new_password_2, $new_role_user, $user_id);
                if($edit_user === true) redirect('?view=users_page');
            }
        break;

        case('del_user'):
            if(isset($_GET['del_user'])) {
                $del_user = abs((int)$_GET['del_user']);
                $res_del_user = del_user($del_user);
                if($res_del_user === true) redirect();
                else redirect('?view=users_page');
            }
        break;
		
		case('del_list'):
            if(isset($_GET['del_list'])) {
                $del_list = abs((int)$_GET['del_list']);
                $res_del_user = del_list($del_list);
                if($res_del_user === true) redirect();
            }
        break;
        
        default:
            // По умолчанию загружается вид по умолчанию - это вид главной страницы
            $view = 'get_text';
        break;
    }
    
    // Подключение header.php
    require('../'.ADMIN_TEMPLATE_BLOCKS .'header.php');

    // Подключение left-blocks.php
    require('../'.ADMIN_TEMPLATE_BLOCKS .'left-blocks.php');
    
    // Подключение вида в Админ панели
    require('../'.ADMIN_TEMPLATE . $view .'.php');
    
    /** ===> Файл конфигурационный, и единый файл входа в Админ часть приветствует вас! и желает приятной работы <=== */
?>