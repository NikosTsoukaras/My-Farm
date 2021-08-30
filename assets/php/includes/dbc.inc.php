<?php


$servername = "localhost";
$dBUsername = "root";
$dBPassword ="";
$dBName = "my_farm";

$conn = new mysqli($servername, $dBUsername, $dBPassword, $dBName);

if (!$conn) {
    die("Η σύνδεση απέτυχε ".mysqli_connect_error());
}