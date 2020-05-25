<?php
echo $alertmsg;
if($depchange) {
?>
<div id="edit-screen">
    <h1></h1>
    <form action="admin.php?section=editdeps" method="post">
        Изменить название подразделения <br><br>
        <input type="text" name="depname" value="<?=$department[1];?>"><br><br>
        <input type="hidden" name="depid" value=<?=$department[0];?>>
        <input type="submit" name="depeditok" value="OK"><br>
        <input type="submit" name="depeditcancel" value="CANCEL">
    </form>
</div>
<?php
}
?>
<h1>Редактор подразделений</h1>
<fieldset>
    <legend>Добавить новое подразделение...</legend>
    <form action="admin.php?section=editdeps" method="post">
        Название подразделения
        <input type="text" name="depname" value="">
        <?php
            if($dep_counts>0) {
        ?>
        и отобразить 
        <select name="depsort" id="">
            <option value="<?=$dep_counts+1;?>" selected>В конце списка</option>
            <?php
            foreach($deps as $dep) {
                echo "<option value=\"$dep[0]\">после $dep[1]</option>\n\t\t\t";
            }
            ?>
        </select>
        <?php
            } else {
        ?>
        <input type="hidden" name="depsort" value="1">
        <?php
            };
        ?>
        <input type="submit" name="adddepok" value="OK">
    </form>
    <a href="admin.php?section=editcontacts">Редактировать контакты</a>
</fieldset>

<form action="admin.php?section=editdeps" method="post">
    <table>
        <thead>
            <tr>
                <th>Название подразделения</th>
                <th>Действия</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach($deps as $dep) {
                echo "<tr>";
                echo "<td>".$dep[1]."</td>";
                echo "<td>";
                if($dep !== reset($deps)) echo "<input type=\"submit\" name=\"depmoveup[$dep[0]]\" value=\"Вверх\">";
                if($dep !== end($deps)) echo "<input type=\"submit\" name=\"depmovedown[$dep[0]]\" value=\"Вниз\">";
                echo "<input type=\"submit\" name=\"depchange[$dep[0]]\" value=\"Изменить\">";
                echo "<input type=\"submit\" name=\"depdelete[$dep[0]]\" value=\"Удалить\">";
                echo "</td>";
                echo "</tr>\n";
            };
            ?>
        </tbody>
        <tfoot>
        </tfoot>
    </table>
</form>