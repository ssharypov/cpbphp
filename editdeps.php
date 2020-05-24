<?php
    $query = "SELECT * FROM departments ORDER BY depsort ASC";
    $result = mysqli_query($dblink,$query);
?>
<h1>Редактор подразделений</h1>
<fieldset>
    <legend>Добавить новое подразделение...</legend>
    <form action="admin.php?section=editdeps" method="post">
        <input type="text" name="depname" value="название подразделения">
        <?php
            if(mysqli_num_rows($result)>0) {
        ?>
        и отобразить 
        <select name="depsort" id="">
            <option value="<?=(mysqli_num_rows($result)+1);?>" selected>В конце списка</option>
            <?php
            while($row=mysqli_fetch_row($result)) {
                echo "<option value=\"$row[0]\">после $row[1]</option>\n\t\t\t";
                $max=$row[0];
            };
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
            mysqli_data_seek($result,0);
            while($row=mysqli_fetch_row($result)) {
                echo "<tr>";
                echo "<td>".$row[1]."</td>";
                echo "<td>";
                echo "<input type=\"submit\" name=\"moveup[$row[0]]\" value=\"Вверх\">";
                echo "<input type=\"submit\" name=\"movedown[$row[0]]\" value=\"Вниз\">";
                echo "<input type=\"submit\" name=\"change[$row[0]]\" value=\"Изменить\">";
                echo "<input type=\"submit\" name=\"delete[$row[0]]\" value=\"Удалить\">";
                echo "</td>";
                echo "</tr>\n";
            }
            ?>
        </tbody>
        <tfoot>
        </tfoot>
    </table>
</form>