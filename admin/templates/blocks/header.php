<?php 
    // проверка на доступность константы \\
    defined('INDEX') or die('Access denied');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name='viewport' content='width-devaice=width, initial-scale=1.0' />
<meta rel='shortcut icon' type='image/x-icon' href='<?=PAST?>views/tmp_task_list/favicon.png' />
<title>Админ панель</title>
<meta http-equiv="Content-Type" content="text/html; charset='UTF-8'" />
<link rel="stylesheet" type="text/css" href="<?=ADMIN_PAST_TEMPLATE?>styles/style.css" />
<script type='text/javascript' src='<?=ADMIN_PAST_TEMPLATE?>script/jquery-1.7.2.min.js'></script>
<script type='text/javascript' src='<?=ADMIN_PAST_TEMPLATE?>script/workscripts.js'></script>
</head>
<body>
<div class="karkas">
	<div class="head">
		<a href="<?=ADMIN_PAST?>"><img src="<?=ADMIN_PAST_TEMPLATE?>images/logoAdm.jpg" /></a>
		<p><a href="<?=PAST?>" target="_blank">На сайт</a> | <a href="?do=logout" id="logout"><strong>Выйти</strong></a></p>
	</div> <!-- .head -->