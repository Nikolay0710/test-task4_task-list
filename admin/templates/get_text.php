<div class='content'>
	<h2 class='title__list'>Список задач</h2>
		<?php if(!empty($task_list)): ?>
			<?php foreach($task_list as $item): ?>
				<table class='table-task-list'>
					<thead>
						<tr>
							<td>Имя пользователя:</td>
							<td colspan='2'><?=$item['name']?></td>
						</tr>
						<tr>
							<td>E-mail:</td>
							<td colspan='2'><a href='mailto:<?=$item['email']?>'><?=$item['email']?></a></td>
						</tr>
					</thead>
					<tfoot>
						<tr>
							<td>Дата добавление:</td>
							<td colspan='2'><?=$item['date']?></td>
						</tr>
						<tr>
							<td>Статус проверки:</td>
							<td colspan='2'><?php if($item['flag'] == 0) echo 'Еще не проверялось администратором'; else echo 'Отредактировано администратором';?></td>
						</tr>
						<tr>
							<td>Просмотр:</td>
							<td><a href='?view=edit_text&amp;id=<?=$item['id']?>'>Отредактировать</a></td>
							<td>
								<?php if($_SESSION['auth']['admin_role'] == 2): ?>
									<a href='?view=del_list&amp;del_list=<?=$item['id']?>' class='del'>Удалить</a>
								<?php else: ?>
									<a href='#' class='del no-del' title='Нужно иметь права администратора'>Удалить</a>
								<?php endif; ?>
							</td>
						</tr>
					</tfoot>
					<tbody>
						<tr>
							<td>Текст задачи:</td>
							<td colspan='2'><?=$item['text']?></td>
						</tr>
					</tbody>
				</table>
			<?php endforeach; ?>
			<?php else: echo 'В базе нет записей'; ?>
		<?php endif;
			if(isset($_SESSION['answer'])) echo $_SESSION['answer']; 
			unset($_SESSION['answer']);
		?>
</div>