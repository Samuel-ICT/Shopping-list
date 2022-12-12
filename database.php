<?php
session_start();
$db_host = "localhost";
$db_name = "shopping_list";
$user = 'root';
$pass = '';
$db_conn = new PDO('mysql:host='.$db_host.';dbname='.$db_name, $user, $pass);
?>