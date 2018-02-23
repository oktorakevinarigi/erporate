<?php
require "../koneksi.php";

if(isset($_POST['simpan']))
{
    $nama       = $_POST['nama'];
    $jenkel     = $_POST['jenkel'];
    $jabatan    = $_POST['jabatan'];
    $nohp       = $_POST['nohp'];
    $alamat     = $_POST['alamat'];

    $sql = mysqli_query($conn,"INSERT INTO karyawan SET nama='$nama', jenis_kelamin='$jenkel', jabatan='$jabatan', no_hp='$nohp', alamat='$alamat'");
    echo "<script>alert('Data Berhasil Ditambahkan');window.location=('index.php');</script>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Erporate</title>
    <link rel="stylesheet" href="../bootstrap/dist/css/bootstrap.min.css" crossorigin="anonymous">
</head>
<body>
<br><br>
<div class="container">
    <ul class="nav nav-pills">
    <li class="nav-item">
            <a class="nav-link" href="../index.php">Absensi</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" href="#">Tambah Data Karyawan</a>
        </li>
    </ul>
    <br><br><br>
    <h2 style="text-align:center">Silahkan Input Data Karyawan</h2>
    <div style="margin-top:50px; padding-bottom:50px;">
        <form method="POST" action="">
            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" class="form-control" name="nama" id="nama" aria-describedby="emailHelp" placeholder="Masukkan Nama">
            </div>
            <div class="form-group">
                <label for="jenkel">Jenis Kelamin</label>
                <select class="form-control" name="jenkel" id="jenkel">
                    <option value="Pria">Pria</option>
                    <option value="Wanita">Wanita</option>
                </select>
            </div>
            <div class="form-group">
                <label for="jabatan">Jabatan</label>
                <input type="text" class="form-control" id="jabatan" name="jabatan" placeholder="Jabatan">
            </div>
            <div class="form-group">
                <label for="nohp">No HP</label>
                <input type="text" class="form-control" id="nohp" name="nohp" placeholder="Nomor HP">
            </div>
            <div class="form-group">
                <label for="alamat">Alamat</label>
                <textarea name="alamat" class="form-control" id="alamat" rows="6" placeholder="Alamat"></textarea>
            </div>
            <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
        </form>
    </div>

    <br><br><br><h2 style="text-align:center">Data Karyawan</h2>
    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th scope="col">No</th>
                <th scope="col">Nama</th>
                <th scope="col">Jenis Kelamin</th>
                <th scope="col">Jabatan</th>
                <th scope="col">No HP</th>
                <th scope="col">Alamat</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $no = 1;
        $sql    = mysqli_query($conn,"SELECT * FROM karyawan");
        while($row    = mysqli_fetch_assoc($sql)): ?>
        <tr>
            <th><?= $no++; ?></th>
            <td><?= $row['nama']; ?></td>
            <td><?= $row['jenis_kelamin']; ?></td>
            <td><?= $row['jabatan']; ?></td>
            <td><?= $row['no_hp']; ?></td>
            <td><?= $row['alamat']; ?></td>
            <td><a class="btn btn-primary" href="#exampleModal" data-toggle="modal" data-target=".bd-example-modal-lg" role="button" data-id="<?= $row['id_karyawan']; ?>">Edit</a> |
                <a class='btn btn-danger' href="#konfirmasi_hapus" data-toggle='modal' data-target='#konfirmasi_hapus' data-href='hapus.php?id=<?= $row['id_karyawan'];?>'>Hapus</a></td>
        </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
</div>

<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="fetched-data"></div>
    </div>
  </div>
</div>
</div>

<div class="modal fade" id="konfirmasi_hapus" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <b>Anda yakin ingin menghapus data ini ?</b><br><br>
                <a class="btn btn-danger btn-ok"> Hapus</a>
                <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-close"></i> Batal</button>
            </div>
        </div>
    </div>
</div>
<br><br>

<script src="../bootstrap/dist/js/jquery.min.js"></script>
<script src="../bootstrap/dist/js/bootstrap.min.js"></script>

  <script type="text/javascript">
    $(document).ready(function(){
        $('#exampleModal').on('show.bs.modal', function (e) {
            var rowid = $(e.relatedTarget).data('id');
            //menggunakan fungsi ajax untuk pengambilan data
            $.ajax({
                type : 'post',
                url : 'edit.php',
                data :  'rowid='+ rowid,
                success : function(data){
                $('.fetched-data').html(data);//menampilkan data ke dalam modal
                }
            });
         });
    });
  </script>
    <script type="text/javascript">
    //Hapus Data
    $(document).ready(function() {
        $('#konfirmasi_hapus').on('show.bs.modal', function(e) {
            $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
        });
    });
  </script>
</body>
</html>