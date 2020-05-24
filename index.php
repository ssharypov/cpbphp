<?php
    require_once "config.php";
    require_once "dbfunc.php";
    $deps = dep_list();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css.css"/>
    <title>Document</title>
</head>
<body>
    <table id="contact-table">
        <thead>
            <tr>
                <th>Сотрудник</th>
                <th>Должность</th>
                <th>Внутренние<br>номера</th>
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
</body>
</html>