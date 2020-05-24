<?php
echo $alertmsg;
if($contactchange) {
?>
<div id="edit-screen">
    <h1></h1>
    <form action="admin.php?section=editcontacts" method="post">
        Изменить контакт <br><br>
        <input type="text" name="fio" value="<?=$contact[1];?>"><br><br>
        Изменить должность <br><br>
        <input type="text" name="post" value="<?=$contact[2];?>"><br><br>
        Изменить внутренний телефон <br><br>
        <input type="text" name="intnum" value="<?=$contact[3];?>"><br><br>
        Изменить другие телефоны <br><br>
        <input type="text" name="extnum" value="<?=$contact[4];?>"><br><br>
        <input type="hidden" name="contactid" value=<?=$contact[0];?>>
        поменять подразделение<br><br>
        <select name="depid" id="">
            <?php
                $deps = dep_list();
                foreach($deps as $dep) {
                    echo "<option value=\"$dep[0]\"";
                    if($dep[0] == $contact[5]) echo " selected";
                    echo ">";
                    echo $dep[1];
                    echo "</option>";
                }
            ?>
        </select><br><br>
        <input type="submit" name="contacteditok" value="OK"><br>
        <input type="submit" name="contacteditcancel" value="CANCEL">
    </form>
</div>
<?php
}
?>
<h1>Редактор контактов</h1>
<fieldset>
    <legend>Добавить новый контакт...</legend>
    <?php
    if(dep_count()==0) {
    ?>
    Сначала создайте подразделение &rarr;
    <a href="admin.php?section=editdeps">создать</a>
    <?php
    } else {
    ?>
    <form action="admin.php?section=editcontacts" method="post">
        <table border="0">
            <tr>
                <td>
                    <?php
                    if(isset($fio)) {
                    ?>
                    <input type="text" name="fio" value="<?=$fio;?>">
                    <?php
                    } else {
                    ?>
                    <input type="text" name="fio" value="ФИО / название контакта">
                    <?php 
                    }
                    ?>
                </td>
                <td>
                    его должность
                    <?php
                    if(isset($fio)) {
                    ?>
                    <input type="text" name="post" value="<?=$post;?>">
                    <?php
                    } else {
                    ?>
                    <input type="text" name="post" value="здесь указать должность">
                    <?php 
                    }
                    ?>
                </td>
                <td>
                    в следующее подразделение
                    <select name="depid" id="" onchange="this.form.submit()">
                    <option value="0">-- не выбрано --</option>
                    <?php
                        $deps = dep_list();
                        foreach($deps as $dep) {
                            echo "<option value=\"$dep[0]\"";
                            if(isset($depid) && $dep[0] == $depid) echo " selected";
                            echo ">";
                            echo $dep[1];
                            echo "</option>";
                        }
                    ?>
                    </select>
                    <?php
                    if(isset($depid))
                    ?>
                </td>
            </tr>
            <tr>
                <td>
                    вн. тел.
                    <input type="text" name="intnum">
                </td>
                <td>
                    др.  тел.
                    <input type="text" name = "extnum">
                </td>
                <td>
                    и отобразить
                    <select name="contactsort" id="">
                        <option value="<?php echo ($contact_counts+1);?>">В конце списка</option>
                        <?php
                        foreach($contacts as $contact) {
                            echo "<option value=\"$contact[0]\">после $contact[1]</option>\n\t\t\t";
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td align="right" colspan="3">
                    <input type="submit" name="contactok" value="OK">
                </td>
            </tr>
        </table>
    </form>
    <?php
    };
    ?>
    <a href="admin.php?section=editdeps">Редактировать подразделения</a>
</fieldset>
<br>
<form action="admin.php?section=editcontacts" method="post">
    <table id="contact-table">
        <thead>
            <tr>
                <th>Сотрудник</th>
                <th>Должность</th>
                <th>Внутренние номера</th>
                <th>Сотовые / городские номера</th>
                <th>Действия</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach($deps as $dep) {
                echo "<tr><td colspan=\"5\" class=\"depname\">$dep[1]</td></tr>";
                $contacts = contact_list($dep[0]);
                foreach($contacts as $contact) {
                    echo "<tr>";
                    echo "<td>$contact[1]</td>";
                    echo "<td>$contact[2]</td>";
                    echo "<td>$contact[3]</td>";
                    echo "<td>$contact[4]</td>";
                    echo "<td style=\"text-align: center\">";
                    if($contact !== reset($contacts)) echo "<input type=\"submit\" name=\"contactmoveup[$contact[0]]\" value=\"Вверх\">";
                    if($contact !== end($contacts)) echo "<input type=\"submit\" name=\"contactmovedown[$contact[0]]\" value=\"Вниз\">";
                    echo "<input type=\"submit\" name=\"contactchange[$contact[0]]\" value=\"Изменить\">";
                    echo "<input type=\"submit\" name=\"contactdelete[$contact[0]]\" value=\"Удалить\">";
                    echo "</td>";
                    echo "</tr>\n";
                }
            }
            ?>
        </tbody>
        <tfoot>
        </tfoot>
    </table>
</form>