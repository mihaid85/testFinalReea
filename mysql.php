<?php
$user = "root";
$password = "";
$host = "localhost";
$db = "test";
$mysql = new mysqli($host, $user, $password, $db);
if ($mysql->connect_error) {
    die("Connection failed: " . $mysql->connect_error);
}