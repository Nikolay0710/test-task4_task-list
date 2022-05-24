<?php 
    // проверка на доступность константы \\
    defined('INDEX') or die('Access denied');
?>
        <div class="content">
			<h2>Редактирование пользователя</h2>
            <form action="" method="post">
            	<table class="add_edit_page" cellspacing="0" cellpadding="0">
            	  <tr>
            		<td class="add-edit-txt">ФИО пользователя:<span class="red">*</span></td>
            		<td><input class="head-text" type="text" name="name" value="<?=(!empty($_SESSION['edit_user']['name'])) ? $_SESSION['edit_user']['name'] : $get_user['name'];?>" /></td>
            	  </tr>
            	  <tr>
            		<td>Логин пользователя:</td>
            		<td>
                        <?php if(($_SESSION['auth']['id_role'] == $get_user['id']) OR ($user_admin['id_role'] == $_SESSION['auth']['admin_role'])): // если редактируется не свой профиль ?>
                        <input class="head-text" type="text" name="login" value="<?=(!empty($_SESSION['edit_user']['login'])) ? $_SESSION['edit_user']['login'] : $get_user['login'];?>" />
                        <?php else: // если редактируется не свой профель ?>
                        <input class="head-text" type="text" name="login" value="Логин изменять невозможно..." disabled="disabled" />
                        <?php endif; ?>
                    </td>
            	  </tr>
                  <tr>
            		<td>Текущий пароль:<span class="red">*</span></td>
            		<td>
                        <?php if(($_SESSION['auth']['id_role'] == $get_user['id']) OR ($user_admin['id_role'] == $_SESSION['auth']['admin_role'])): ?>
                            <input class="head-text" type="password" name="current_pass" <?=!empty($_SESSION['edit_user']['self_pass_user']) ? "value='" . $_SESSION['edit_user']['self_pass_user'] : '';?> />
                        <?php else: ?>
                            <input class="head-text" type="text" name="login" value="Пароль изменить невозможно..." disabled="disabled" />
                    <?php endif; ?>
                    </td>
            	  </tr>
                  <tr>
            		<td>Новый пароль:</td>
            		<td><input class="head-text" type="password" name="password1" /></td>
            	  </tr>
                  <tr>
            		<td>Подтвердите пароль:</td>
            		<td><input class="head-text" type="password" name="password2" /></td>
            	  </tr>
	              <tr>
            		<td>Роль пользователя:</td>
            		<td>
                        <?php if(($_SESSION['auth']['id_role'] != $get_user['id']) AND ($user_admin['id_role'] == $_SESSION['auth']['admin_role'])): // если редактируется не свой профиль ?>
                            <?php if($_SESSION['auth']['id_role'] === $_SESSION['auth']['admin_role']): ?>
								<label><input type='radio' name='role_user' value="2" /> "Администратор"</label>
                            <?php else: ?>
								<label><input type="radio" name='role_user' value="1" /> "Модератор"</label> <br />
                            <?php endif; ?>
                        <?php else: ?>
                            Роль изменить невозможно...
                        <?php endif; ?>
                    </td>
            	  </tr>
            	</table>
               <input type="image" name="edit_user" alt="Сохранить" src="<?=ADMIN_PAST_TEMPLATE?>images/save_btn.jpg" />
             </form>
             <?php 
                if(isset($_SESSION['edit_user']['error'])) echo $_SESSION['edit_user']['error'];
                unset($_SESSION['edit_user']);
             ?>
		</div> <!-- .content -->
	</div> <!-- .content-main -->
</div> <!-- .karkas -->
</body>
</html>