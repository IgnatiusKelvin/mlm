<?php
$ambilusertarget = $koneksi->query("SELECT * FROM peserta left join pengguna on peserta.idpengguna = pengguna.idpengguna WHERE idpeserta='$_GET[id]'") or die(mysqli_error($koneksi));
$usertarget = $ambilusertarget->fetch_assoc();

$idpengguna = $usertarget['idpengguna'];
$idtarget = $usertarget['idtarget'];

$ambiltarget = $koneksi->query("SELECT * FROM target WHERE idtarget='$idtarget'") or die(mysqli_error($koneksi));
$target = $ambiltarget->fetch_assoc();
$ambilquestion = $koneksi->query("SELECT * FROM question WHERE idtarget='$idtarget' order by idquestion asc") or die(mysqli_error($koneksi));
?>
<h1 class="section-header">
    <div>Target Pengguna <?= $target['namatarget'] ?> - <?= $usertarget['nama'] ?></div>
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
                                        <a class="btn btn-secondary btn-sm" href="#">Belum dicapai</a>
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
                                <div class="col-md-12">
                                    <a class="btn btn-success btn-lg btn-block" href="../foto/<?= $peserta['file'] ?>" target="_blank">Unduh</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary tutup" data-dismiss="modal">Tutup</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php
    $idpeserta = $peserta['idpeserta'];
    $no++;
}
?>