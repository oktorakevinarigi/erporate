<?php

$server = "localhost";
$user   = "root";
$pass   = "";
$db     = "erporate";

$conn = mysqli_connect($server,$user,$pass,$db);

if(!$conn)
{
    die("Maaf, Koneksi Gagal:".mysqli_connect_error());
}

?>