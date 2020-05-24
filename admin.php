<?php
    require_once "config.php";
    require_once "dbfunc.php";
    if(isset($_POST['adddepok']) && $_POST['adddepok']=="OK" && $_SERVER['REQUEST_URI']=='/admin.php?section=editdeps') {
        if(!empty($_POST['depname']) && is_numeric($_POST['depsort'])) {
            echo "OK";
            add_dep($_POST['depname'],$_POST['depsort']);
        }
    }
    if(isset($_POST['moveup'])) {
        echo var_dump($_POST['moveup'])."<br>";
        echo key($_POST['moveup']);
    };
    if(isset($_POST['movedown'])) {
        echo var_dump($_POST['movedown'])."<br>";
        echo key($_POST['movedown']);
    };
    if(isset($_POST['change'])) {
        echo var_dump($_POST['change'])."<br>";
        echo key($_POST['change']);
    };
    if(isset($_POST['delete'])) {
        echo var_dump($_POST['delete'])."<br>";
        echo key($_POST['delete']);
    };
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
    <?php
        if(isset($_GET['section'])) {
            if($_GET['section']=='editdeps') include "editdeps.php";
        }
    ?>
</body>
</html>