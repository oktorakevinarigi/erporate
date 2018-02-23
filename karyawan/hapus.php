<?php
require "../koneksi.php";

$id = $_GET['id'];
$sql = mysqli_query($conn,"DELETE FROM karyawan WHERE id_karyawan='$id'");
header('location:index.php');

?>