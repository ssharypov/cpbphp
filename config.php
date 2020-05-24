<?php
    $dbhost="localhost";
    $dbport="3307";
    $dbname="phonebook";
    $dbuser="root";
    $dbpass="usbw";
    $dblink = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname,$dbport);
    mysqli_query($dblink,"SET NAMES utf8");

