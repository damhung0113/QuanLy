<?php
$connect = mysqli_connect('127.0.0.1', 'root', '', 'test');
mysqli_set_charset($connect, "utf8");
if (!isset($_SESSION)) {
    session_start();
}
