<?php 
    // проверка на доступность константы \\
    defined('INDEX') or die('Access denied');
?>
        <div class="content">
			<h2>Добавление пользователя</h2>
            <form action="" method="post">
            	<table class="add_edit_page" cellspacing="0" cellpadding="0">
            	  <tr>
            		<td class="add-edit-txt">ФИО пользователя:<span class="red">*</span></td>
            		<td><input class="head-text" type="text" name="name" value="<?=$_SESSION['add_user']['name']?>" /></td>
            	  </tr>
            	  <tr>
            		<td>Логин пользователя:<span class="red">*</span></td>
            		<td><input class="head-text" type="text" name="login" placeholder="<?=$_SESSION['add_user']['login2']?>" value="<?=htmlspecialchars($_SESSION['add_user']['login'])?>" /></td>
            	  </tr>
                  <tr>
            		<td>Пароль пользователя:<span class="red">*</span></td>
            		<td><input class="head-text" type="password" name="password1" placeholder="<?=htmlspecialchars($_SESSION['add_user']['password1'])?>" /></td>
            	  </tr>
                  <tr>
            		<td>Подтвердите пароль:<span class="red">*</span></td>
            		<td><input class="head-text" type="password" name="password2" placeholder="<?=htmlspecialchars($_SESSION['add_user']['password2'])?>" /></td>
            	  </tr>
	              <tr>
            		<td>Роль пользователя:</td>
            		<td>
                        <?php if(($_SESSION['auth']['id_role'] != $get_user['id']) AND ($user_admin['id_role'] == $_SESSION['auth']['admin_role'])): // если редактируется не свой профиль ?>
                            <?php if($_SESSION['auth']['id_role'] !== $_SESSION['auth']['admin_role']): ?> 
                                    <label><input type="radio" name='role_user' value="1" /> "Модератор"</label> <br />
                                    <label><input type='radio' name='role_user' value="2" /> "Администратор"</label>
                            <?php endif; ?>
                        <?php else: ?>
                             <label><input type="radio" name='role_user' value="1" /> "Модератор"</label> <br />
                        <?php endif; ?>
                    </td>
            	  </tr>
            	</table>
               <input type="image" name="add_user" alt="Сохранить" src="<?=ADMIN_PAST_TEMPLATE?>images/save_btn.jpg" />
             </form>
             <?php 
                if(isset($_SESSION['add_user']['error'])) echo $_SESSION['add_user']['error'];
                unset($_SESSION['add_user']); 
             ?>
		</div> <!-- .content -->
	</div> <!-- .content-main -->
</div> <!-- .karkas -->
</body>
</html>