<?php
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'prenotazione_ristorante';

$connect = new mysqli($host, $username, $password, $database);
if($connect->connect_errno)
{
    die('DB connection error: '.$connect->connect_error);
}
