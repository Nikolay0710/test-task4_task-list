<?php 
    // проверка на доступность константы \\
    defined('INDEX') or die('Access denied');
?>
    <div class="content-main">
		<div class="leftBar">
			<ul class="nav-left">
				<li><a href='<?=ADMIN_PAST?>'>Список задач</a></li>
				<li><a href='?view=users_page'>Пользователи сайта с различными уровнями доступа</a></li>
				<li><a href="?do=logout"><strong>Выйти из админки</strong></a></li>
            </ul>
		</div> <!-- .leftBar -->