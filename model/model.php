<?php 

	/** Get task list **/
	function get_task_list($start_pos, $perpage, $order_db)
	{
		$query = "SELECT `name`, `email`, `text`, `date` FROM `task-list` ORDER BY $order_db LIMIT $start_pos, $perpage";
		$res_select_pages = mysqli_query($GLOBALS['db'], $query) or die(mysqli_error($GLOBALS['db']));
		$get_array_pages = array();
		while($row = mysqli_fetch_assoc($res_select_pages)) {
			$get_array_pages[] = $row;
		}
		return $get_array_pages;
	}
	/** Get task list **/

	/** Set new task list **/
	function set_task_list()
	{
		$userName 	= cleanHtmlCodes($_POST['userName']);
		$email 		= trim($_POST['email']);
		$fullText 	= trim(htmlspecialchars(($_POST['fullText'])));

		if(!empty($userName) && !empty($email) && !empty($fullText)) {
			$query = "INSERT INTO `task-list` (`name`, `email`, `text`, `date`) VALUES ('$userName','$email', '$fullText', NOW())";
			$result = mysqli_query($GLOBALS['db'], $query) or die(mysqli_error($GLOBALS['db']));
			if(mysqli_affected_rows($GLOBALS['db']) > 0)
				$_SESSION['notifications']['resultat'] = "<span class='green'>Новый список задач был успешно добавлен!</span>";
		} else $_SESSION['notifications']['resultat'] = "<span class='red'>Не заполнены обязательные поля?</span>";
	}
	/** Set new task list **/

	/** count oll task list for paginatio **/
	function count_oll_task_list()
	{
        $query = "SELECT COUNT(`id`) FROM `task-list`";
        $res = mysqli_query($GLOBALS['db'], $query) or die(mysqli_error($GLOBALS['db']));
        $row = mysqli_fetch_row($res);
        return $row[0];
	}
	/** count oll task list for paginatio **/