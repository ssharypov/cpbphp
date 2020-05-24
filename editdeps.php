<h1>Редактор подразделений</h1>
<fieldset>
    <legend>Добавить новое подразделение...</legend>
    <form action="admin.php?section=editdeps" method="post">
        <input type="text" name="depname" value="название подразделения">
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
                echo "<input type=\"submit\" name=\"depmoveup[$dep[0]]\" value=\"Вверх\">";
                echo "<input type=\"submit\" name=\"depmovedown[$dep[0]]\" value=\"Вниз\">";
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