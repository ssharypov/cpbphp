<?php
    require_once "config.php";
    require_once "dbfunc.php";
    /** Работа с подразделениями */
    if(isset($_POST['adddepok']) && $_POST['adddepok']=="OK" && $_SERVER['REQUEST_URI']=='/admin.php?section=editdeps') {
        if(!empty($_POST['depname']) && is_numeric($_POST['depsort'])) {
            echo "OK";
            dep_add($_POST['depname'],$_POST['depsort']);
        }
    }
    if(isset($_POST['depmoveup'])) {
        echo var_dump($_POST['depmoveup'])."<br>";
        echo key($_POST['depmoveup']);
    };
    if(isset($_POST['depmovedown'])) {
        echo var_dump($_POST['depmovedown'])."<br>";
        echo key($_POST['depmovedown']);
    };
    if(isset($_POST['depchange'])) {
        echo var_dump($_POST['depchange'])."<br>";
        echo key($_POST['depchange']);
    };
    if(isset($_POST['depdelete'])) {
        echo var_dump($_POST['depdelete'])."<br>";
        echo key($_POST['depdelete']);
    };
    /** Работа с контактами */
    /** Добавление */
    if(isset($_POST['contactok']) && $_POST['contactok']=="OK" && $_SERVER['REQUEST_URI']=="/admin.php?section=editcontacts") {
        if(!empty($_POST['fio']) && !empty($_POST['post']) && is_numeric($_POST['contactsort']) && is_numeric($_POST['depid'])) {
            echo "Contact OK";
            $fio = $_POST['fio'];
            $post = $_POST['post'];
            $intnum = (empty($_POST['intnum'])) ? '' : $_POST['intnum'];
            $extnum = (empty($_POST['extnum'])) ? '' : $_POST['extnum'];
            $depid = $_POST['depid'];
            $contactsort = $_POST['contactsort'];
            contact_add($fio,$post,$intnum,$extnum,$depid,$contactsort);
            //header("Location: /admin.php?section=editcontacts");
        }
    }
    /** Фильтрация */
    if(!isset($_POST['contactok']) && $_SERVER['REQUEST_URI']=="/admin.php?section=editcontacts" && isset($_POST['depid'])) {
        $fio = $_POST['fio'];
        $post = $_POST['post'];
        $intnum = (empty($_POST['intnum'])) ? '' : $_POST['innum'];
        $extnum = (empty($_POST['extnum'])) ? '' : $_POST['extnum'];
        $depid = $_POST['depid'];
        $contactsort = $_POST['contactsort'];
        $depid=$_POST['depid'];
        $contacts = contact_list($depid);
        $contact_counts = count($contacts);
    }
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
            if($_GET['section']=='editdeps') {
                $deps = dep_list();
                $dep_counts = count($deps);
                include "editdeps.php";
            };
            if($_GET['section']=='editcontacts') {
                include "editcontacts.php";
            }
        }
    ?>
    <?php 
    echo "<pre>";
    echo var_dump($_POST);
    echo "</pre>";
    ?>
</body>
</html>