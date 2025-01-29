<?php

$servername = "localhost";
$username = "bk_admin";
$password = "ATo7waM[)v1Gf!xc";
$dbname = "bk_database";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}