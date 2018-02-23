<?php
require "koneksi.php";
require "fungsi.php";


if(isset($_POST['absen']))
{
    $id_karyawan   = $_POST['id_karyawan'];
    $jam_kerja     = $_POST['jamker'];
    $sql = mysqli_query($conn, "SELECT * FROM kehadiran WHERE id_karyawan='$id_karyawan' AND tgl='$tanggal'");
    $qry = mysqli_fetch_assoc($sql);
    $id_kehadiran = $qry['id_kehadiran'];
    $row_num = mysqli_num_rows($sql);

    if($row_num == 1)
    {
        $sql = mysqli_query($conn,"UPDATE kehadiran SET jam_plg='$jam_skrg' WHERE id_kehadiran='$id_kehadiran'");
        echo "<script>alert('Absesn pulang anda berhasil dicatat');window.location=('index.php');</script>";
    }else{
        $sql            = mysqli_query($conn,"INSERT INTO kehadiran SET id_karyawan='$id_karyawan', tgl='$tanggal', jam_dtg='$jam_skrg'");
        $sql_tampil     = mysqli_query($conn,"SELECT * FROM kehadiran ORDER BY id_kehadiran DESC");
        $row_tampil     = mysqli_fetch_assoc($sql_tampil);
        $idker          = $row_tampil['id_kehadiran'];
        $sql_kehadiran  = mysqli_query($conn,"INSERT INTO kehadiran_karyawan SET id_karyawan='$id_karyawan', id_kehadiran='$idker', jam_kerja='$jam_kerja'");
        echo "<script>alert('Absen datang anda berhasil dicatat');window.location=('index.php');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Erporate</title>
    <link rel="stylesheet" href="bootstrap/dist/css/bootstrap.min.css" crossorigin="anonymous">
</head>
<body>
<br><br>
<div class="container">
    <ul class="nav nav-pills">
        <li class="nav-item">
            <a class="nav-link active" href="#">Absensi</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="karyawan/index.php">Tambah Data Karyawan</a>
        </li>
    </ul>
    <br><br><br>
    <h2 style="text-align:center">Silahkan Absen</h2>
    <div style="margin-top:50px">
        <form method="POST" action="">
            <div class="form-group">
                <label for="id_karyawan">Pilih Nama</label>
                <select class="form-control" name="id_karyawan" id="id_karyawan">
                <?php
                $sql = mysqli_query($conn, "SELECT * FROM karyawan");
                while($row = mysqli_fetch_assoc($sql)): ?>
                    <option value="<?= $row['id_karyawan']; ?>"><?= $row['nama']; ?></option>
                <?php endwhile;?>
                </select>
            </div>
            <div class="form-group">
                <label for="jamker">Jam Kerja</label>
                <input type="time" class="form-control" id="jamker" name="jamker" placeholder="Jam Kerja" value="08:00">
            </div>
            <button type="submit" name="absen" class="btn btn-primary">Absen</button>
        </form>
    </div>
    <br><br><br><h2 style="text-align:center">Data Absensi</h2>
    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th scope="col">No</th>
                <th scope="col">Nama</th>
                <th scope="col">Tanggal</th>
                <th scope="col">Jam Datang</th>
                <th scope="col">Jam Pulang</th>
                <th scope="col">Jam Kerja</th>
                <th scope="col">Jumlah Jam</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $no = 1;
        $sql    = mysqli_query($conn,"SELECT kehadiran.id_kehadiran, kehadiran.tgl, kehadiran.jam_dtg, kehadiran.jam_plg, kehadiran_karyawan.id_kehadiran_karyawan, kehadiran_karyawan.jam_kerja, karyawan.nama, timediff(kehadiran.jam_plg, kehadiran.jam_dtg) as selisih FROM kehadiran INNER JOIN (kehadiran_karyawan INNER JOIN karyawan ON kehadiran_karyawan.id_karyawan=karyawan.id_karyawan) ON kehadiran.id_kehadiran=kehadiran_karyawan.id_kehadiran");
        while($row    = mysqli_fetch_assoc($sql)): ?>
        <tr>
            <th><?= $no++; ?></th>
            <td><?= $row['nama']; ?></td>
            <td><?= $row['tgl']; ?></td>
            <td><?= $row['jam_dtg']; ?></td>
            <td><?= $row['jam_plg']; ?></td>
            <td><?= $row['jam_kerja']; ?></td>
            <td><?= substr($row['jam_kerja'],0,2); ?> Jam <?= substr($row['jam_kerja'], -5,2); ?> Menit</td>
        </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
</div>
<br><br>
</body>
</html>