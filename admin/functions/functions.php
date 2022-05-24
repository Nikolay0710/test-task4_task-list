<?php
    /** ===> Файил функции приветствует вас! и желает приятной работы) <=== */

    /** Получаем Администратора для закрытие доступа от модераторов **/
    function get_user_admin()
    {
        $query = "SELECT `id_role` FROM `user` WHERE `id_role` = 2";
        $row = mysqli_query($GLOBALS['db'], $query) or die(mysqli_error($GLOBALS['db']));
        $res = mysqli_fetch_assoc($row);
        return $res;
    }
    /** Получаем Администратора для закрытие доступа от модераторов **/
     
    // проверка на доступность константы \\
    defined('INDEX') or die('Access denied');
    
    /** Get task list **/
	function get_task_list()
	{
		$query = "SELECT `id`, `name`, `email`, `text`, `date`, `flag` FROM `task-list`";
		$res_select_pages = mysqli_query($GLOBALS['db'], $query) or die(mysqli_error($GLOBALS['db']));
		$get_array_pages = array();
		while($row = mysqli_fetch_assoc($res_select_pages)) {
			$get_array_pages[] = $row;
		}
		return $get_array_pages;
	}
	/** Get task list **/

	/** Get task link po id **/
	function get_text($id)
	{
		$query = "SELECT `name`, `email`, `text`, `flag` FROM `task-list` WHERE `id` = $id";
		$res_get_text = mysqli_query($GLOBALS['db'], $query) or die(mysqli_error($GLOBALS['db']));
		return mysqli_fetch_assoc($res_get_text);
	}
	/** Get task link po id **/

	/** edit task link **/

	function edit_task_text($edit){
        $text = trim($_POST['fullText']);
        $flag = $_POST['flag'];

        if(!empty($text)) {
            $text = htmlspecialchars($text);
            
            if($flag == 'yes') $flag = 1;
            else $flag = 0;

            // Формеруем запрос к базе данных
           	$query = "UPDATE `task-list` SET `text` = '$text', `flag` = $flag WHERE `id` = $edit";
            $res = mysqli_query($GLOBALS['db'], $query) or die(mysqli_error($GLOBALS['db']));
            
            if(mysqli_affected_rows($GLOBALS['db']) > 0) {
                $_SESSION['answer'] = "<div class='success'>Список задач был успешно изменен!</div>";
                return true;
            }
            else {
                $_SESSION['edit_page']['error'] = "<div class='error'>Вы ничего не изменили!? Список задач не была изменен.</div>";
                return false;
            }
        }
        else {
            return false;
        }
    }

    /** edit task link **/

    /** delete task list **/
   
    function del_list()
    {
        $del = abs( (integer)$_GET['del_list']);
        $query = "DELETE FROM `task-list` WHERE `id` = $del";
        mysqli_query($GLOBALS['db'], $query);
        if(mysqli_affected_rows($GLOBALS['db']) > 0) {
            $_SESSION['answer'] = "<div class='success'>Список задач был успешно удален!</div>";
            return true;
        } else {
            $_SESSION['answer'] = "<div class='error'>Произошла ошибка. Список задач не был удален...</div>";
            return false;
        }
    }

    /** delete task list **/

    /** Get All Users **/

    function get_users()
    {
        $query = "SELECT `id`, `name`, `login`, `id_role` FROM `user`";
        $res_user = mysqli_query($GLOBALS['db'], $query) or die(mysqli_error($GLOBALS['db']));
        $arr_users = array();
        while($row = mysqli_fetch_assoc($res_user)) {
            $arr_users[] = $row;
        }
        return $arr_users;
    }
    
    /** Get All Users **/

    /** ===== Сохранение пользователей ===== */
    function add_user() {
        $arror = ''; // флаг проверки пустых полей
        
        $name = trim($_POST['name']);
        $login = trim($_POST['login']);
        $password1 = trim($_POST['password1']);
        $password2 = trim($_POST['password2']); 
        $id_role = (int)$_POST['role_user'];
        
        // Проверки на пустату полей
        if(empty($name)) $arror .= '<li>Вы не указали ФИО?</li>';
        if(empty($login)) $arror .= '<li>Вы не указали логин?</li>';
        if(empty($password1)) $arror .= '<li>Вы не указали пароль?</li>';
        if(empty($password2)) $arror .= '<li>Вы не указали повторный пароль?</li>';
        
        if(empty($arror)) {
            // если все поля запомнили то все хорошо!
            // Проверяем нет ли пользователя с таким-же логином
            $query = "SELECT `id` FROM `user` WHERE login = '" . htmlspecialchars($login) . "' LIMIT 1";
            $res = mysqli_query($GLOBALS['db'], $query) or die(mysqli_error($GLOBALS['db']));
            $row = mysqli_num_rows($res); // если вернет 1 - такой user есть, 0 - нет.
            if($row) {
                // если такой логин есть.
                $_SESSION['add_user']['error'] = "<div class='error'>Пользователь с таким логином $login уже зарегистрированный на сайте, Введите другой логин.</div>";
                $_SESSION['add_user']['name'] = $name;
                $_SESSION['add_user']['login2'] = "Новый логин";
                $_SESSION['add_user']['password1'] = "Повторите пароль";
                $_SESSION['add_user']['password2'] = "Подтвердите пароль";
                return false;
            }
            else {
                // ррееггииссттррииррууеемм ппооллььззооввааттеелляя !!!!!!!!!!!!!!!!!!!!!
                // проверяем ввода пароля и логина на определённые ввода символ. !!!!!!!!!!!!!!!!!!!!!!!!!
                if(mb_strlen($password1, 'UTF-8') >= 4 AND mb_strlen($password1, 'UTF-8') <= 8 AND mb_strlen($login, 'UTF-8') >= 5) {
                    
                    $name_cle = htmlspecialchars($name);
                    $login_cle = htmlspecialchars($login);
                    $select_pass1 = md5($password1);
                    $select_pass2 = md5($password2);
                    
                    if($select_pass1 == $select_pass2) {
                        if(empty($id_role)) $id_role = 0;
                       $query = "INSERT INTO `user` (`name`, `login`, `pass`, `id_role`) 
                                 VALUES ('$name_cle', '$login_cle', '$select_pass1', '$id_role')";
                        mysqli_query($GLOBALS['db'], $query) or die(mysqli_error($GLOBALS['db']));
                        if(mysqli_affected_rows($GLOBALS['db']) > 0) {
                            $_SESSION['orders']['answer'] = "<div class='success'>Новый пользователь был успешно добавлен!</div>";
                            return true;
                        }
                        else {
                            $_SESSION['orders']['answer'] = "<div class='error'>Не удалось добавить пользователя</div>";
                            return false;
                        }
                    }
                    else {
                        $_SESSION['add_user']['error'] = "<div class='error'>Ошибка Вы указали разные пароли $password1 != $password2 они должны быть одинаковыми.</div>";
                        $_SESSION['add_user']['name'] = $name;
                        $_SESSION['add_user']['login'] = $login;
                        $_SESSION['add_user']['password1'] = "Пароли не совпали";
                        $_SESSION['add_user']['password2'] = "Пароли не совпали";
                        return false;
                    }
                }
                else {
                    if(mb_strlen($login, 'UTF-8') <= 5) $stop .= "<li>Вы указали логин меньше 6 символов?</li>";
                    if(mb_strlen($password1, 'UTF-8') < 4) $stop .= "<li>Вы указали пароль меньше 4 символов?</li>";
                    if(mb_strlen($password1, 'UTF-8') > 8) $stop .= "<li>Вы указали пароль больше 8 символов?</li>";
                    
                    $_SESSION['add_user']['error'] = "<div class='error'>Ошибка недопустимое количество символов <ul> $stop </ul></div>";
                    
                    $_SESSION['add_user']['name'] = $name;
                    $_SESSION['add_user']['login'] = $login;
                    if(mb_strlen($login, 'UTF-8') < 6) { 
                        $_SESSION['add_user']['password1'] = "Пароль придётся вводить заново";
                        $_SESSION['add_user']['password2'] = "Пароль придётся вводить заново";
                    }
                    if(mb_strlen($password1, 'UTF-8') < 4) {
                        $_SESSION['add_user']['password1'] = "Меньше 4 символов";
                        $_SESSION['add_user']['password2'] = "Меньше 4 символов";
                    }
                    if(mb_strlen($password1, 'UTF-8') > 8) {
                        $_SESSION['add_user']['password1'] = "Пароль больше 8 символов?";
                        $_SESSION['add_user']['password2'] = "Пароль больше 8 символов?";
                    }
                    return false;
                }
            }
        }
        else {
            // иначи если не заполнены обязательные поля
            $_SESSION['add_user']['error'] = "<div class='error'>Не запомниты обезательны поля: <ul> $arror </ul> Все поля отмеченные красной звездочкой обязательны для заполнения</div>";
            $_SESSION['add_user']['name'] = $name;
            $_SESSION['add_user']['login'] = $login;
            if(!empty($password1)) $_SESSION['add_user']['password1'] = "Повторите пароль";
            if(!empty($password2)) $_SESSION['add_user']['password2'] = "Подтвердите пароль";
            return false;
        }
    }

    /** ===== Сохранение пользователей ===== */

    /** ===== Получаем пользователя для редактирование ===== */

    function get_user($user_id)
    {
        $query = "SELECT `id`, `name`, `login` FROM `user` WHERE `id` = $user_id";
        $row = mysqli_query($GLOBALS['db'], $query) or die(mysqli_error($GLOBALS['db']));
        $res = mysqli_fetch_assoc($row);
        return $res;
    }

     /** ===== Получаем пользователя для редактирование ===== */

     /** ===== Сохранение пользователя ===== */

    function edit_user($new_name_user, $new_login_user, $self_pass_user, $new_password_1, $new_password_2, $new_role_user, $get_user)
    {
        // Проверки на пустату полей
        if(empty($new_name_user)) $arror .= '<li>Вы не указали ФИО?</li>';
        if(empty($new_login_user)) $arror .= '<li>Вы не указали логин?</li>';
        if(empty($self_pass_user)) $arror .= '<li>Вы не указали текущий свой пароль?</li>';

        if(!empty($new_name_user) && !empty($new_login_user) && !empty($self_pass_user)) {
            $self_pass_user = md5($self_pass_user);
            $query = "SELECT `pass` FROM `user` WHERE `pass` = '$self_pass_user' LIMIT 1";
            mysqli_query($GLOBALS['db'], $query) or die(mysqli_error($GLOBALS['db']));
            if(mysqli_affected_rows($GLOBALS['db']) > 0) {
                if(!empty($new_password_1) && !empty($new_password_2)) {
                    if($new_password_1 == $new_password_2) {
                        $new_password = md5($new_password_1);
                        $new_pass = ",`pass` = '$new_password'";
                    } else $arror .= '<li>Вы указали разные пароли?</li>';
                } else $new_pass = '';

                if(!empty($arror)) {
                    // иначе если заполнены поля но с разными значениями то выводим на экран
                    $_SESSION['edit_user']['error'] = "<div class='error'>Не заполнено поле: <ul> $arror </ul> </div>";
                    return false;
                }

                if(empty($new_role_user)) $new_role_user = "`id_role` = ". 1;
                else $new_role_user = ",`id_role` = $new_role_user";
                if(($_SESSION['auth']['id_role'] != $get_user['id']) || ($get_user['id_role'] == $_SESSION['auth']['admin_role'])) $new_role_user = '';

                $query = "UPDATE `user` SET `name` = '$new_name_user', 
                                            `login` = '$new_login_user'
                                            $new_pass $new_role_user
                                            WHERE `id` = $get_user";
                mysqli_query($GLOBALS['db'], $query) or die(mysqli_error($GLOBALS['db']));
                if(mysqli_affected_rows($GLOBALS['db']) > 0) {
                    $_SESSION['orders']['answer'] = "<div class='success'>Пользователь был успешно изменен!</div>";
                    return true;
                }
            } else {
                $_SESSION['edit_user']['error'] = "<div class='error'>Не удалось изменить пользователя</div>";
                return false;
            }
        } else {
            // иначи если не заполнены обязательные поля
            $_SESSION['edit_user']['error'] = "<div class='error'>Не запомниты обезательны поля: <ul> $arror </ul> Все поля отмеченные красной звездочкой обязательны для заполнения</div>";
            $_SESSION['edit_user']['name'] = $new_name_user;
            $_SESSION['edit_user']['login'] = $new_login_user;
            $_SESSION['edit_user']['self_pass_user'] = $self_pass_user;
            return false;
        }
    }
     /** ===== Сохранение пользователя ===== */

     /** ===== Удаление пользователя ===== */
    function del_user($del_user) {
        $query = "SELECT `id`, `id_role` FROM `user` WHERE `id` = $del_user";
        $ressult = mysqli_query($GLOBALS['db'], $query) or die(mysqli_error($GLOBALS['db']));
        $row = mysqli_fetch_assoc($ressult);
        if(mysqli_affected_rows($GLOBALS['db']) > 0) {
           if(($row['id_role'] != $_SESSION['auth']['admin_role']) || ($row['id'] != $_SESSION['auth']['admin_id'])) {
               $query = "DELETE FROM `user` WHERE `id` = $del_user LIMIT 1";
               mysqli_query($GLOBALS['db'], $query) or die(mysqli_error($GLOBALS['db']));
               if (mysqli_affected_rows($GLOBALS['db']) > 0) {
                   $_SESSION['orders']['answer'] = "<div class='success'>Пользователь был успешно удален!</div>";
                   return true;
               }
           }
           else {
               $_SESSION['orders']['answer'] = "<div class='error'>Вы не можете удалить самого себя?</div>";
               return false;
           }
        } else {
            $_SESSION['orders']['answer'] = "<div class='error'>Пользователь такого в базе нет.</div>";
            return false;
        }
    }

    /** ===> Файил функции приветствует вас! и желает приятной работы) <=== */
?>