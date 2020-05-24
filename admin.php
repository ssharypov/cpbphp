<?php
    require_once "config.php";
    require_once "dbfunc.php";
    /** Работа с подразделениями */
    /** Добавление */
    if(isset($_POST['adddepok']) && $_POST['adddepok']=="OK" && $_SERVER['REQUEST_URI']=='/admin.php?section=editdeps') {
        if(!empty($_POST['depname']) && is_numeric($_POST['depsort'])) {
            echo "OK";
            dep_add($_POST['depname'],$_POST['depsort']);
            header("Location: /admin.php?section=editdeps");
        }
    }
    /** Изменение */
    if(isset($_POST['depmoveup'])) {
        $depid=key($_POST['depmoveup']);
        dep_moveup($depid);
        header("Location: /admin.php?section=editdeps");
    };
    if(isset($_POST['depmovedown'])) {
        $depid=key($_POST['depmovedown']);
        dep_movedown($depid);
        header("Location: /admin.php?section=editdeps");
    };
    $depchange = false;
    if(isset($_POST['depchange'])) {
        $depchange=true;
        $depid=key($_POST['depchange']);
        $department=dep_get_record($depid);
    };
    if(isset($_POST['depeditok'])) {
        if(!empty($_POST['depname']) && !empty($_POST['depid'])) {
            $depid=$_POST['depid'];
            $depname=$_POST['depname'];
            dep_change_name($depid,$depname);
            header("Location: /admin.php?section=editdeps");
        }
    }
    if(isset($_POST['depeditcancel'])) {
        header("Location: /admin.php?section=editdeps");
    }
    $depdelete = false;
    if(isset($_POST['depdelete'])) {
        $depdelete=true;
        $depid=key($_POST['depdelete']);
        dep_delete($depid);
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
    <?php /*
    echo "<pre>";
    echo var_dump($_POST);
    echo $depchange;
    echo "</pre>";*/
    ?>
</body>
</html>