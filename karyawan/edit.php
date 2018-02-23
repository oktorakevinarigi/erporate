<?php
require "../koneksi.php";

if(isset($_POST['edit']))
{
    $id         = $_POST['id'];
    $nama       = $_POST['nama'];
    $jenkel     = $_POST['jenkel'];
    $jabatan    = $_POST['jabatan'];
    $nohp       = $_POST['nohp'];
    $alamat     = $_POST['alamat'];

    $sql = mysqli_query($conn,"UPDATE karyawan SET nama='$nama', jenis_kelamin='$jenkel', jabatan='$jabatan', no_hp='$nohp', alamat='$alamat' WHERE id_karyawan='$id'");
    echo "<script>alert('Data berhasil di update');window.location=('index.php')</script>";
    return false;

}
if($_POST['rowid']) {
        $id = $_POST['rowid'];
        // mengambil data berdasarkan id
        // dan menampilkan data ke dalam form modal bootstrap
        $sql = mysqli_query($conn,"SELECT * FROM karyawan WHERE id_karyawan = '$id'");
        //$result = $koneksi->query($sql);
        foreach ($sql as $baris) { ?>

        <form method="POST" action="edit.php">
            <input type="hidden" name="id" value="<?= $id; ?>">
            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" class="form-control" name="nama" id="nama" aria-describedby="emailHelp" value="<?php echo $baris['nama']; ?>">
            </div>
            <div class="form-group">
                <label for="jenkel">Jenis Kelamin</label>
                <select class="form-control" name="jenkel" id="jenkel">
                <?php
                        if($baris['jenis_kelamin']=="Pria"){ ?>
                            <option value="Pria" selected>Pria</option>
                            <option value="Wanita">Wanita</option>
                <?php   }elseif($baris['jenis_kelamin']=="Wanita"){ ?>
                            <option value="Pria">Pria</option>
                            <option value="Wanita" selected>Wanita</option>

                <?php   } ?>


                </select>
            </div>
            <div class="form-group">
                <label for="jabatan">Jabatan</label>
                <input type="text" class="form-control" id="jabatan" name="jabatan" value="<?php echo $baris['jabatan']; ?>">
            </div>
            <div class="form-group">
                <label for="nohp">No HP</label>
                <input type="text" class="form-control" id="nohp" name="nohp" value="<?php echo $baris['no_hp']; ?>">
            </div>
            <div class="form-group">
                <label for="alamat">Alamat</label>
                <textarea name="alamat" class="form-control" id="alamat" rows="6"><?php echo $baris['alamat']; ?></textarea>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" name="edit" class="btn btn-primary">Update</button>
            </div>
        </form>
<?php } } ?>