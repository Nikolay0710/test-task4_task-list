<?php 

    /** ===== Распечатка массива ===== */
	function print_arr($arr)
	{
		echo "<pre>";
		print_r($arr);
		echo "</pre>";
	}
    /** ===== Распечатка массива ===== */
	
    /** ===== Редирект ===== */
    function redirect($http = false) {
        if($http) $redirect = $http;
        else $redirect = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : PAST;
        header("Location: $redirect");
        exit();
    }
    /** ===== Редирест ===== */

	/** ===== Фильтрация входящих данных от пользователей ===== */
    function cleanHtmlCodes($cleanHtml)
	{
		$resCleanHtml = trim(htmlspecialchars(mysqli_real_escape_string($GLOBALS['db'], $cleanHtml)));
		return $resCleanHtml;
	}
    /** ===== Фильтрация входящих данных от пользователей ===== */

    /** ===== Постраничная навигация ===== */
    function paginatio($page, $pages_count) 
    {
        if($_SERVER['QUERY_STRING']) { // если есть параметры в запросе
            foreach($_GET as $key => $value) {
                // формеруем строку пораметра без номера страницы ... номер передается параметром функции
                if($key != 'page') $uri .= "$key=$value&amp;";
            }
        }
        // формерование ссылок
        $back = ''; // ссылка НАЗАД
        $forward = ''; // ссыдка ВПЕРЕД
        $startpage = ''; // ссылка в НАЧАЛО
        $endpage = ''; // ссылка в КОНЕЦ
        $page2left = ''; // пторая страница с лева
        $page1left = ''; // первая страница с лева
        $page2raight = ''; // пторая страница с справа
        $page1raight = ''; // первая страница с справа
        
        if($page > 1) {
            $back = "<a href='?{$uri}page=" . ($page - 1) . "' class='nav_link'>&lt;</a>";
        }
        if($page < $pages_count) {
            $forward = "<a href='?{$uri}page=" . ($page + 1) . "' class='nav_link'>&gt;</a>";
        }
        if($page > 3) {
            $startpage = "<a href='?{$uri}page=1' class='nav_link'>&laquo;</a>";
        }
        if($page < ($pages_count - 2)) {
            $endpage = "<a href='?{$uri}page=" . $pages_count . "' class='nav_link'>&raquo;</a>";
        }
        if($page - 2 > 0) {
            $page2left = "<a href='?{$uri}page=" . ($page - 2) . "' class='nav_link'>" . ($page - 2) . "</a>";
        }
        if($page - 1 > 0) {
            $page1left = "<a href='?{$uri}page=" . ($page - 1) . "' class='nav_link'>" . ($page - 1) . "</a>";
        }
        if($page + 2 <= $pages_count) {
            $page2raight = "<a href='?{$uri}page=" . ($page + 2) . "' class='nav_link'>" . ($page + 2) . "</a>";
        }
        if($page + 1 <= $pages_count) {
            $page1raight = "<a href='?{$uri}page=" . ($page + 1) . "' class='nav_link'>" . ($page + 1) . "</a>";
        }
        // формируем вывод навигации
        echo "<div class='paginatio'>" . $startpage . $back .  $page2left . $page1left . "<a class='nav_active'>" . $page . "</a>" . $page1raight . $page2raight . $forward . $endpage . "</div>";
    }
    /** ===== Постраничная навигация ===== */