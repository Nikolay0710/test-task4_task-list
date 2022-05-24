    <h2 class='title__list'>Список задач <a href='<?=ADMIN_PAST?>' class='admin'>Вход в админку</a><hr /></h2>
        <div class="vid-sort">
			Сортировать :&nbsp;
            <a id="param_order" class="sort-top"><?=$order?></a>
            <div class="sort-wrap">
                <?php foreach($order_p as $key => $val): ?>
                <?php if($order == $val[0]) continue; ?>
                <a href="?view=main&amp;order=<?=$key?>&amp;page=<?=$list?>" class="sort-bot"><?=$val[0]?></a>
                <?php endforeach; ?>
            </div>
		</div> <!-- .vid-sort -->
		<?php if(!empty($task_list)): ?>
			<?php foreach($task_list as $item): ?>
				<table class='table-task-list'>
					<thead>
						<tr>
							<td>Имя пользователя:</td>
							<td><?=$item['name']?></td>
						</tr>
						<tr>
							<td>E-mail:</td>
							<td><a href='mailto:<?=$item['email']?>'><?=$item['email']?></a></td>
						</tr>
					</thead>
					<tfoot>
						<tr>
							<td>Дата добавление:</td>
							<td><?=$item['date']?></td>
						</tr>
					</tfoot>
					<tbody>
						<tr>
							<td>Текст задачи:</td>
							<td><?=$item['text']?></td>
						</tr>
					</tbody>
				</table>
			<?php endforeach; ?>
			<?php else: echo 'В базе нет записей'; ?>
		<?php endif; ?>

		<?php if(COUNT_TASK_LIST > 1) paginatio($list, $pages_count); ?>
		
		<h3 class='title__list'>Добавить новый список задач</h3>
		
		<table class='table-task-add'>
			<form method='POST' action=''>
			<thead>
				<tr>
					<td>Имени пользователя:</td>
					<td>E-mail:</td>
				</tr>
				<tr>
					<td><input type='text' name='userName' placeholder='Имя' required='required' /></td>
					<td><input type='email' name='email' placeholder='Email' required='required' /></td>
				</tr>
			</thead>
			<tfoot>
				<tr>
					<td colspan='2' align='center'><button name='submit'>Добавить</button></td>
				</tr>
			</tfoot>
			<tbody>
				<tr>
					<td align='center'>Текст задачи:</td>
					<td><textarea cols='20' rows='10' name='fullText'></textarea></td>
				</tr>
			</tbody>
			</form>
		</table>

		<?php 
			if(isset($_SESSION['notifications']['resultat'])) echo $_SESSION['notifications']['resultat']; 
			unset($_SESSION['notifications']['resultat']);
		?>