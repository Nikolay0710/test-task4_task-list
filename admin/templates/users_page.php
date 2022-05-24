<?php 
    // проверка на доступность константы \\
    defined('INDEX') or die('Access denied');
?>
        <div class="content">
			<h2>Список пользователей</h2>
			<a href="?view=add_user"><img class="add_some" src="<?=ADMIN_PAST_TEMPLATE?>images/add_user.jpg" alt="Добавить страницу" /></a>
			<table class="tabl" cellspacing="1">
			  <tr>
				<th class="add-samll">№</th>
				<th class="str_name">Пользователи</th>
                <th class="str_name">Логин</th>
                <th class="str_name">Роль</th>
				<th class="str_action">Действие</th>
			  </tr>
              <?php if($array_users): ?>
              <?php $i = 1; // для нумерации страниц ?>
              <?php foreach($array_users as $users): ?>
			  <tr <?php if($_SESSION['auth']['id_role'] == $users['id']) echo 'class="role"'; ?> class="add-samll">
				<td><?=$i?></td>
				<td class="name_page"><?=htmlspecialchars($users['name'])?></td>
                <td><?=$users['login']?></td>
                <td><?php
                    if($users['id_role'] != 2) echo 'Модератор';
                    else echo 'Администратор';
                ?></td>
    				<td><a href="?view=edit_user&amp;user_id=<?=$users['id']?>" class="edit">изменить</a>&nbsp; | &nbsp;
              <?php if($_SESSION['auth']['admin_role'] == 2): ?>
                  <a href="?view=del_user&amp;del_user=<?=$users['id']?>" class='del'>Удалить</a>
                  <?php else: ?>
                  <a href='#' class='del no-del' title='Нужно иметь права администратора'>Удалить</a>
                <?php endif; ?>
            </td>
			  </tr>
              <?php $i ++; // 1+ ?>
              <?php endforeach; ?>
              <?php else: ?>
              <tr>
                <td colspan="4">На сайте нет пользователей для вывода их на страницу</td>
              </tr>
              <?php endif; ?>
			</table>
			<a href="?view=add_user"><img class="add_some" src="<?=ADMIN_PAST_TEMPLATE?>images/add_user.jpg" alt="Добавить страницу" /></a>
             <?php 
                if(isset($_SESSION['orders']['answer'])) echo $_SESSION['orders']['answer'];
                unset($_SESSION['orders']['answer']);
             ?>
		</div> <!-- .content -->
	</div> <!-- .content-main -->
</div> <!-- .karkas -->
</body>
</html>