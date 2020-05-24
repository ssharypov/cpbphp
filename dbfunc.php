<?php
/**
 * Работа с подразделениями
 */
function dep_count() {
    global $dblink;
    $query = "SELECT COUNT(depid) FROM departments";
    $result = mysqli_query($dblink,$query);
    $row = mysqli_fetch_row($result);
    return $row[0];
}

function dep_sort_max() {
    global $dblink;
    $query = "SELECT MAX(depsort) FROM departments";
    $result = mysqli_query($dblink,$query);
    $row = mysqli_fetch_row($result);
    return $row[0];
}

function dep_list() {
    global $dblink;
    $query = "SELECT * FROM departments ORDER BY depsort ASC";
    $result = mysqli_query($dblink,$query);
    $deps = array();
    while($row=mysqli_fetch_row($result)) {
        $deps[] = $row;
    }
    return $deps;
}

function dep_add($depname,$depsort) {
    global $dblink;
    if(dep_count() > 1) {
        if($depsort>dep_sort_max()) {
            $query = "INSERT INTO departments (depname,depsort) VALUES ('$depname',$depsort)";
            mysqli_query($dblink,$query);
        } else {
            $query = "UPDATE departments SET depsort=depsort+1 WHERE depsort > $depsort";
            mysqli_query($dblink,$query);
            $query = "INSERT INTO departments (depname,depsort) VALUES ('$depname',($depsort+1))";
            mysqli_query($dblink,$query);
        }
    } else {
        $query = "INSERT INTO departments (depname,depsort) VALUES ('$depname',$depsort)";
        mysqli_query($dblink,$query);
    }
}

function dep_moveup($depid) {
    global $dblink;
    $query = "SELECT depsort-1 FROM departments WHERE depid=$depid";
    $result = mysqli_query($dblink,$query);
    $row = mysqli_fetch_row($result);
    $ltdepsort = $row[0];
    $curdepsort=($ltdepsort+1);
    $query = "UPDATE departments SET depsort=$curdepsort WHERE depsort=$ltdepsort";
    mysqli_query($dblink,$query);
    $query = "UPDATE departments SET depsort=$ltdepsort WHERE depid=$depid";
    mysqli_query($dblink,$query);
}

function dep_movedown($depid) {
    global $dblink;
    $query = "SELECT depsort+1 FROM departments WHERE depid=$depid";
    $result = mysqli_query($dblink,$query);
    $row = mysqli_fetch_row($result);
    $ltdepsort = $row[0];
    $curdepsort=($ltdepsort-1);
    $query = "UPDATE departments SET depsort=$curdepsort WHERE depsort=$ltdepsort";
    mysqli_query($dblink,$query);
    $query = "UPDATE departments SET depsort=$ltdepsort WHERE depid=$depid";
    mysqli_query($dblink,$query);
}

function dep_get_record($depid) {
    global $dblink;
    $query = "SELECT * FROM departments WHERE depid=$depid";
    $result = mysqli_query($dblink,$query);
    $row = mysqli_fetch_row($result);
    return $row;
}
function dep_change_name($depid,$depname) {
    global $dblink;
    $query = "UPDATE departments SET depname='$depname' WHERE depid=$depid";
    mysqli_query($dblink,$query);
}

function dep_not_empty($depid) {
    global $dblink;
    $query = "SELECT COUNT(contactid) FROM contacts WHERE depid=$depid";
    $result = mysqli_query($dblink,$query);
    $row = mysqli_fetch_row($result);
    if($row[0]>0) return true;
    else return false;
}

function dep_delete($depid) {
    global $dblink;
    $query = "DELETE FROM departments WHERE depid=$depid";
    mysqli_query($dblink,$query);
    echo mysqli_error($dblink);
}
/**
 * Работа с контактами
 */
function contact_count($depid) {
    global $dblink;
    $query = "SELECT COUNT(contactid) FROM contacts WHERE depid=$depid";
    $result = mysqli_query($dblink,$query);
    $row = mysqli_fetch_row($result);
    return $row[0];
}

function contact_sort_max($depid) {
    global $dblink;
    $query = "SELECT MAX(contactsort) FROM contacts WHERE depid=$depid";
    $result = mysqli_query($dblink,$query);
    $row = mysqli_fetch_row($result);
    return $row[0];
}

function contact_list($depid) {
    global $dblink;
    $query = "SELECT * FROM contacts WHERE depid=$depid ORDER BY contactsort, fio ASC";
    $result = mysqli_query($dblink,$query);
    $deps = array();
    while($row=mysqli_fetch_row($result)) {
        $deps[] = $row;
    }
    return $deps;
}

function contact_add($fio,$post,$intnum,$extnum,$depid,$contactsort) {
    global $dblink;
    if(contact_count($depid) > 1) {
        if($contactsort>contact_sort_max($depid)) {
            $query = "INSERT INTO contacts(fio,post,intnum,extnum,depid,contactsort) VALUES('$fio','$post','$intnum','$extnum',$depid,$contactsort)";
            mysqli_query($dblink,$query);
        } else {
            $query = "UPDATE contacts SET contactsort=contactsort+1 WHERE depid=$depid AND contactsort > $contactsort";
            mysqli_query($dblink,$query);
            $query = "INSERT INTO contacts(fio,post,intnum,extnum,depid,contactsort) VALUES('$fio','$post','$intnum','$extnum',$depid,($contactsort+1))";
            mysqli_query($dblink,$query);
        }
    } else {
        $query = "INSERT INTO contacts(fio,post,intnum,extnum,depid,contactsort) VALUES('$fio','$post','$intnum','$extnum',$depid,$contactsort)";
        mysqli_query($dblink,$query);
    }
}

function contact_moveup($contactid) {
    global $dblink;
    $query = "SELECT contactsort-1,depid FROM contacts WHERE contactid=$contactid";
    echo $query;
    $result = mysqli_query($dblink,$query);
    $row = mysqli_fetch_row($result);
    $ltcontactsort = $row[0];
    $depid = $row[1];
    $curcontactsort=($ltcontactsort+1);
    $query = "UPDATE contacts SET contactsort=$curcontactsort WHERE contactsort=$ltcontactsort AND depid=$depid";
    echo $query;
    mysqli_query($dblink,$query);
    $query = "UPDATE contacts SET contactsort=$ltcontactsort WHERE contactid=$contactid AND depid=$depid";
    echo $query;
    mysqli_query($dblink,$query);
}
function contact_movedown($contactid) {
    global $dblink;
    $query = "SELECT contactsort+1,depid FROM contacts WHERE contactid=$contactid";
    echo $query;
    $result = mysqli_query($dblink,$query);
    $row = mysqli_fetch_row($result);
    $ltcontactsort = $row[0];
    $depid = $row[1];
    $curcontactsort=($ltcontactsort-1);
    $query = "UPDATE contacts SET contactsort=$curcontactsort WHERE contactsort=$ltcontactsort AND depid=$depid";
    echo $query;
    mysqli_query($dblink,$query);
    $query = "UPDATE contacts SET contactsort=$ltcontactsort WHERE contactid=$contactid AND depid=$depid";
    echo $query;
    mysqli_query($dblink,$query);
}
function contact_get_record($contactid) {
    global $dblink;
    $query = "SELECT * FROM contacts WHERE contactid=$contactid";
    $result = mysqli_query($dblink,$query);
    $row = mysqli_fetch_row($result);
    return $row;
}
function contact_change($contactid,$fio,$post,$intnum,$extnum,$depid) {
    global $dblink;
    $query = "UPDATE contacts SET fio='$fio', post='$post', intnum='$intnum', extnum='$extnum', depid=$depid WHERE contactid=$contactid";
    mysqli_query($dblink,$query);
}

function contact_delete($contactid) {
    global $dblink;
    $query = "DELETE FROM contacts WHERE contactid=$contactid";
    mysqli_query($dblink,$query);
}