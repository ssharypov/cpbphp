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
            </tr>
        </thead>
        <tbody>
            <?php
            foreach($deps as $dep) {
                echo "<tr><td colspan=\"4\" class=\"depname\">$dep[1]</td></tr>";
                $contacts = contact_list($dep[0]);
                foreach($contacts as $contact) {
                    echo "<tr>";
                    echo "<td>$contact[1]</td>";
                    echo "<td>$contact[2]</td>";
                    echo "<td>$contact[3]</td>";
                    echo "<td>$contact[4]</td>";
                    echo "</tr>\n";
                }
            }
            ?>
        </tbody>
        <tfoot>
        </tfoot>
    </table>
</form>