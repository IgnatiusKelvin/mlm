<h1 class="section-header">
    <div>Target Pengguna</div>
</h1>
<div class="row">
    <div class="col-xl-12 col-md-12">
        <div class="card border-left-primary shadow py-2">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="tabel">
                        <thead class="bg-danger">
                            <tr>
                                <th style="color: white">No</th>
                                <th style="color: white">Nama</th>
                                <th style="color: white">ID Enterprise</th>
                                <th style="color: white">ID Sponsor</th>
                                <th style="color: white">Target Pengguna</th>
                                <th style="color: white">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $nomor = 1;
                            $ambil = $koneksi->query("SELECT * FROM peserta left join pengguna on peserta.idpengguna = pengguna.idpengguna left join target on peserta.idtarget = target.idtarget group by peserta.idtarget, peserta.idpengguna") or die(mysqli_error($koneksi));
                            while ($data = $ambil->fetch_assoc()) { ?>
                                <tr>
                                    <td><?php echo $nomor ?></td>
                                    <td><?php echo $data["nama"] ?></td>
                                    <td><?php echo $data["identerprise"] ?></td>
                                    <td><?php echo $data["idsponsor"] ?></td>
                                    <td><?php echo $data["namatarget"] ?></td>
                                    <td>
                                        <a href="index.php?halaman=usertargetdetail&id=<?php echo $data['idpeserta']; ?>" class="btn btn-primary btn-sm">Lihat</a>
                                        <a href="index.php?halaman=usertargethapus&id=<?php echo $data['idpeserta']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin akan menghapus data ini?')">Hapus</a>
                                    </td>
                                </tr>
                                <div class="modal fade" id="edit<?= $nomor ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Ubah Target Pengguna</h5>
                                            </div>
                                            <form action="" method="post">
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label>Nama</label>
                                                        <input type="hidden" name="idusertarget" value="<?= $data['idusertarget'] ?>" class="form-control" readonly>
                                                        <input type="text" name="idpengguna" value="<?= $data['nama'] ?>" class="form-control" readonly>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Target Pengguna</label>
                                                        <textarea name="usertarget" class="form-control ckeditor" placeholder="Target Pengguna" required><?= $data['usertarget'] ?></textarea>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary tutup" data-dismiss="modal">Tutup</button>
                                                    <button type="submit" name="edit" value="edit" class="btn btn-primary">Simpan</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <?php $nomor++; ?>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
if (isset($_POST["tambah"])) {
    $idpengguna = $_POST['idpengguna'];
    $usertarget = $_POST['usertarget'];
    $koneksi->query("INSERT INTO usertarget (idpengguna,usertarget)
								VALUES('$idpengguna','$usertarget')") or die(mysqli_error($koneksi));
    echo "<script>alert('Data berhasil disimpan')</script>";
    echo "<script> location ='index.php?halaman=usertargetdaftar';</script>";
}
if (isset($_POST['edit'])) {
    $koneksi->query("UPDATE usertarget SET usertarget='$_POST[usertarget]' WHERE idusertarget='$_POST[idusertarget]'");
    echo "<script>alert('Data berhasil disimpan')</script>";
    echo "<script> location ='index.php?halaman=usertargetdaftar';</script>";
}
?>