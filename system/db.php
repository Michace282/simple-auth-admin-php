<?php
include $_SERVER['DOCUMENT_ROOT'] . '/config.php';
$conn = new mysqli(DB['server'], DB['user'], DB['password'], DB['name']);
if (!$conn) {// check if connection to database is not available
    die("Error connecting to database. ");
}
