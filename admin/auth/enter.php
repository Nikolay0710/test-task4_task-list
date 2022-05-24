<?php
    /** === Файл авторизации приветствует!))))))))))) === **/
    
    session_start();
    
    // Ставим флаг против прямого обращение к Админ - панели
    define('INDEX', TRUE);
    
    // Подключение конфигурационного файла из пользователькой части
    require($_SERVER['DOCUMENT_ROOT'] . '/config.php');
   
   // Если вдруг взбрело в голову войти снова на - эту же страницу но при - этом авторизованнам то перенаправляем на главную
   if(isset($_SESSION['auth']['admin'])) header("Location: " . ADMIN_PAST . "");
   
   if(isset($_POST['enter_x'])) {
        $login = trim(mysqli_real_escape_string($GLOBALS['db'], strip_tags($_POST['user'])));
        $password = trim($_POST['pass']);
        
        $query = "SELECT `id`, `name`, `login`, `pass`, `id_role` FROM `user` WHERE `login` = '$login'";
        $res = mysqli_query($GLOBALS['db'], $query) or die(mysqli_error($GLOBALS['db']));
        
        $row = mysqli_fetch_assoc($res);
        if($row['pass'] == md5($password)) {
            $_SESSION['auth']['admin_id'] = $row['id'];
            $_SESSION['auth']['admin'] = htmlspecialchars($row['name']);
			$_SESSION['auth']['id_role'] = $row['id'];
            $_SESSION['auth']['admin_role'] = $row['id_role'];
            
            // переадрисация
			$_SESSION['Access_denied'] = "<div class='success' style='text-align: center;'>Перенаправляем, пожалуйста ожидайте.</div>";
            header("ReFresh: 5; url=" . ADMIN_PAST . "");
        }
        elseif (empty($login) and empty($password)) {
            $_SESSION['Access_denied'] = "<div class='error' style='text-align: center;'>Вы ничего не вели?!</div>";
            header("Location: {$_SERVER['PHP_SELF']}");
            exit();
        }
        else {
            $_SESSION['Access_denied'] = "<div class='error' style='text-align: center;'>Неверные учетные данные.</div>";
            header("Location: {$_SERVER['PHP_SELF']}");
            exit();
        }
   }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="<?=ADMIN_PAST_TEMPLATE?>styles/style.css" />
<title>Вход в админку</title>
</head>
<body>
    <div class="karkas">
    	<div class="head">
    		<a href="#"><img src="<?=ADMIN_PAST_TEMPLATE?>images/logoAdm.jpg" /></a>
    		<p>Вход в админку</p>
    	</div>
    	<div class="enter">
            <form method="post" action="">
                <table border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td>Username:</td>
                    <td><input type="text" name="user" /></td>
                  </tr>
                  <tr>
                    <td>Password:</td>
                    <td><input type="password" name="pass" /></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td><input type="image" name="enter" src="<?=ADMIN_PAST_TEMPLATE?>images/enter_btn.jpg" name="submit" /></td>
                  </tr>
                </table>      
            </form>
            <?php 
                if(isset($_SESSION['Access_denied'])) echo $_SESSION['Access_denied'];
                unset ($_SESSION['Access_denied']);
            ?>
        </div>
    </div>
</body>
</html>

<?php
    /** === Файл авторизации приветствует!))))))))))) === **/
?>