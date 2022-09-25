<?php
$username = "root";
$serverhost = "localhost";
$database = "phpdasar";

$conn = mysqli_connect($serverhost, $username, '', $database);

function query($query) {
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];

    while ($row = mysqli_fetch_assoc($result)) {
        array_push($rows, $row);
    }

    return $rows;
}

function query_delete($query) {
    global $conn;
    mysqli_query($conn, $query);
}