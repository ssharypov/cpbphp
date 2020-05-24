<?php
function add_dep($depname,$depsort) {
    global $dblink;
    $query = "SELECT COUNT(depid) FROM departments";
    $result = mysqli_query($dblink,$query);
    $row = mysqli_fetch_row($result);
    if($row[0] > 1) {
        $query = "UPDATE departments SET depsort=depsort+1 WHERE depsort > $depsort";
    } else {
        $query = "UPDATE departments SET depsort=depsort+1 WHERE depsort >= $depsort";
    }
    
    mysqli_query($dblink,$query);
    $query = "INSERT INTO departments (depname,depsort) VALUES ('$depname',$depsort)";
    mysqli_query($dblink,$query);
}