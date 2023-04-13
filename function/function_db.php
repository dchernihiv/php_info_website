<?php
define('SERVER', 'localhost');
define('USER', 'root');
define('PASSWORD', '');
define('DB', 'app_db');


function connect() {
    $conn = mysqli_connect(SERVER, USER, PASSWORD, DB);
    if ($conn) {
        mysqli_set_charset($conn, 'utf8');
        return $conn;
    } else {
        exit("Connect error: ".mysqli_error($conn));
    }
}

$conn = connect();

function select($query) {
    global $conn;
    $result = [];
    $res = mysqli_query($conn, $query);
    if (mysqli_num_rows($res) > 0) {
        while ( $row = mysqli_fetch_assoc($res) ) {
            $result[] = $row;
        }
    }
    return $result;
}

function modify_db($query) {
    global $conn;
    if ( mysqli_query($conn, $query) ) {
        return true;
    } 
    return false;
}

