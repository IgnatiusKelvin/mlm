<?php
$idpengguna = $_SESSION['pengguna']['idpengguna'];
$idtarget = $_GET['id'];
$ambiltarget = $koneksi->query("SELECT * FROM target WHERE idtarget='$idtarget'") or die(mysqli_error($koneksi));
$target = $ambiltarget->fetch_assoc();
$ambilquestion = $koneksi->query("SELECT * FROM question WHERE idtarget='$idtarget' order by idquestion asc") or die(mysqli_error($koneksi));
?>
<h1 class="section-header">
    <div><?= $target['namatarget'] ?></div>
</h1>
<?php
$no = 1;
$idpeserta = 0;
while ($data = $ambilquestion->fetch_assoc()) {
    $ambilpeserta = $koneksi->query("SELECT * FROM peserta WHERE idquestion='$data[idquestion]' and idpengguna='$idpengguna'") or die(mysqli_error($koneksi));
    $peserta = $ambilpeserta->fetch_assoc();
    $cekpeserta = $ambilpeserta->num_rows;
?>
    <div class="row">
        <div class="col-md-12">
            <div class="card border-left-primary shadow py-2">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                <center>
                                    <h4 class="text-dark">Pertanyaan <?= $no ?></h4>
                                    <p><?= $data['question'] ?></p>
                                    <?php if ($cekpeserta >= 1) { ?>
                                        <a class="btn btn-success btn-sm" href="#" data-toggle="modal" data-target="#sudah<?= $no ?>">Selesai</a>
                                    <?php } else { ?>
                                        <?php if ($no > 1) {
                                            $ambilpesertasebelum = $koneksi->query("SELECT * FROM peserta WHERE idpeserta='$idpeserta'") or die(mysqli_error($koneksi));
                                            $sebelum = $ambilpesertasebelum->fetch_assoc();
                                            $cekpesertasebelum = $ambilpesertasebelum->num_rows;
                                        ?>
                                            <?php if ($cekpesertasebelum >= 1) { ?>
                                                <a class="btn btn-danger btn-sm" href="#" data-toggle="modal" data-target="#sudah<?= $no ?>">Sudah Capai</a>
                                                <a class="btn btn-danger btn-sm" href="#" data-toggle="modal" data-target="#belum<?= $no ?>">Belum Capai</a>
                                            <?php } else { ?>
                                                <a class="btn btn-secondary btn-sm" href="#">Sudah Capai</a>
                                                <a class="btn btn-secondary btn-sm" href="#">Belum Capai</a>
                                            <?php } ?>
                                        <?php } else { ?>
                                            <a class="btn btn-danger btn-sm" href="#" data-toggle="modal" data-target="#sudah<?= $no ?>">Sudah Capai</a>
                                            <a class="btn btn-danger btn-sm" href="#" data-toggle="modal" data-target="#belum<?= $no ?>">Belum Capai</a>
                                        <?php } ?>
                                    <?php } ?>
                                </center>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="sudah<?= $no ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Bukti Partisipasi</h5>
                </div>
                <form method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Bukti Partisipasi</label>
                            <input type="hidden" name="idquestion" value="<?= $data['idquestion'] ?>" class="form-control" required>
                            <div class="row">
                                <?php if ($cekpeserta >= 1) { ?>
                                    <div class="col-md-8">
                                        <input type="hidden" name="tipe" value="Edit">
                                        <input type="hidden" name="filelama" value="<?= $peserta['file'] ?>" class="form-control">
                                        <input type="file" name="foto" class="form-control" required>
                                    </div>
                                    <div class="col-md-4">
                                        <a class="btn btn-success btn-lg" href="../foto/<?= $peserta['file'] ?>" target="_blank">Unduh</a>
                                    </div>
                                <?php } else { ?>
                                    <div class="col-md-12">
                                        <input type="hidden" name="tipe" value="Tambah">
                                        <input type="file" name="foto" class="form-control" required>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary tutup" data-dismiss="modal">Tutup</button>
                        <button type="submit" name="simpan" value="simpan" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="belum<?= $no ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Informasi Target</h5>
                </div>
                <div class="modal-body">
                    <p class="text-center">
                    Silahkan klik link dibawah ini jika Anda ingin mengejar target Anda</p>
                    </p>
                    <center>
                        <a class="btn btn-info btn-sm mt-3" href="<?= $data['link'] ?>" target="_blank">Ingin Capai Target</a>
                    </center>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary tutup" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
<?php
    $idpeserta = $peserta['idpeserta'];
    $no++;
}
?>
<?php
if (isset($_POST['simpan'])) {
    if ($_POST['tipe'] == 'Edit') {
        $namafoto = $_FILES['foto']['name'];
        $lokasifoto = $_FILES['foto']['tmp_name'];
        if (!empty($lokasifoto)) {
            move_uploaded_file($lokasifoto, "../foto/$namafoto");
            $namafoto = $namafoto;
        } else {
            $namafoto = $_POST['filelama'];
        }
        $koneksi->query("UPDATE peserta SET file='$namafoto', status='Sudah' WHERE idquestion='$_POST[idquestion]' and idpengguna='$idpengguna'") or die(mysqli_error($koneksi));
    } else {
        $namafoto = $_FILES['foto']['name'];
        $lokasifoto = $_FILES['foto']['tmp_name'];
        move_uploaded_file($lokasifoto, "../foto/$namafoto");
        $koneksi->query("INSERT INTO peserta (idtarget,idquestion, idpengguna, file, status)
        VALUES('$idtarget','$_POST[idquestion]','$idpengguna','$namafoto','Sudah')") or die(mysqli_error($koneksi));
    }
    echo "<script>alert('Data berhasil disimpan');</script>";
    echo "<script> location ='index.php?halaman=questionjawab&id=$_GET[id]';</script>";
}
?>