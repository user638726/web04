<?php 
include_once "db.php";
session_start();
unset($_SESSION['login']);

to("../index.php?do=login");


?>