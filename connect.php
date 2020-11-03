<?php
$connect = mysqli_connect('127.0.0.1', 'root', '', 'test');
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  die();
}
mysqli_set_charset($connect, "utf8");
if (!isset($_SESSION)) {
  session_start();
}
