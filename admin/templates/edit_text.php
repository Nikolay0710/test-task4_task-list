<?php 
    // проверка на доступность константы \\
    defined('INDEX') or die('Access denied');
?>
    <div class="content">
        <h3 class='title__list'>Отредактировать список задач</h3>
        
        <table class='table-task-add'>
            <form method='POST' action=''>
            <thead>
                <tr>
                    <td>Имя пользователя:</td>
                    <td>E-mail:</td>
                </tr>
                <tr>
                    <td><input type='text' name='userName' value='<?=$get_text['name']?>' required='required' disabled='disabled' /></td>
                    <td><input type='email' name='email' value='<?=$get_text['email']?>' required='required' disabled='disabled' /></td>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <td><label><input type='checkbox' name='flag' value='yes' <?php if($get_text['flag'] == 1) echo "checked='checked'";?> /> Отметить как: <br /> "Отредактировано администратором"</label></td>
                    <td align='center'><br /><button name='submit'>Изменить</button></td>
                </tr>
            </tfoot>
            <tbody>
                <tr>
                    <td align='center'>Текст задачи:</td>
                    <td><textarea cols='20' rows='10' name='fullText'><?=$get_text['text']?></textarea></td>
                </tr>
            </tbody>
            </form>
        </table>
        <?php 
            if(isset($_SESSION['edit_page']['error'])) echo $_SESSION['edit_page']['error']; 
            unset($_SESSION['edit_page']['error']);
        ?>
	</div> <!-- .content -->