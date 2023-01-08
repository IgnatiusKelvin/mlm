<h1 class="section-header">
    <div>Daftar Pencapaian Pengguna</div>
</h1>
<div class="row">
    <div class="col-xl-12 col-md-12">
        <div class="card border-left-primary shadow py-2">
            <div class="card-body">
                <a class="btn btn-danger btn-sm mb-3" href="#" data-toggle="modal" data-target="#tambah">Tambah Data</a>
                <div class="modal fade" id="tambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Tambah Pencapaian Pengguna</h5>

                            </div>
                            <form method="post">
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label>Pilih Pengguna</label>
                                        <select name="idpengguna" class="form-control" required>
                                            <option value="">Pilih Pengguna</option>
                                            <?php
                                            $ambiluser = $koneksi->query("SELECT * FROM pengguna where level='User'");
                                            while ($user = $ambiluser->fetch_assoc()) {

                                                $ambilachievement = $koneksi->query("SELECT * FROM achievement
                                                WHERE idpengguna='$user[idpengguna]'") or die(mysqli_error($koneksi));
                                                $cekachievement = $ambilachievement->num_rows;

                                                if ($cekachievement == 0) {
                                            ?>
                                                    <option value="<?= $user['idpengguna'] ?>"><?= $user['nama'] . ' - ' . $user['identerprise'] ?></option>
                                                <?php } ?>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Pencapaian</label>
                                        <textarea name="achievement" value="" class="form-control ckeditor" placeholder="Achievement" required>
                                        
                                        </textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Poin Posisi</label>
                                        <input type="text" name="positionpoints" value="" class="form-control" placeholder="Poin Posisi" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Poin Teknikal</label>
                                        <input type="text" name="technicalpoints" value="" class="form-control" placeholder="Poin Teknikal" required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary tutup" data-dismiss="modal">Tutup</button>
                                    <button type="submit" name="tambah" value="tambah" class="btn btn-primary">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered laporanachievement">
                        <thead class="bg-danger">
                            <tr>
                                <th style="color: white">No</th>
                                <th style="color: white">Nama</th>
                                <th style="color: white">ID Enterprise</th>
                                <th style="color: white">Pencapaian</th>
                                <th style="color: white">Poin Posisi</th>
                                <th style="color: white">Poin Teknikal</th>
                                <th style="color: white">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $nomor = 1;
                            $ambil = $koneksi->query("SELECT * FROM achievement left join pengguna on achievement.idpengguna = pengguna.idpengguna") or die(mysqli_error($koneksi));
                            while ($data = $ambil->fetch_assoc()) { ?>
                                <tr>
                                    <td><?php echo $nomor ?></td>
                                    <td><?php echo $data["nama"] ?></td>
                                    <td><?php echo $data["identerprise"] ?></td>
                                    <td><?php echo $data["achievement"] ?></td>
                                    <td><?php echo $data["positionpoints"] ?></td>
                                    <td><?php echo $data["technicalpoints"] ?></td>
                                    <td>
                                        <a href="#" data-toggle="modal" data-target="#edit<?= $nomor ?>" class="btn btn-warning btn-sm">Ubah Data</a>
                                        <a href="index.php?halaman=achievementhapus&id=<?php echo $data['idachievement']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin untuk menghapus data ini?')">Hapus</a>
                                    </td>
                                </tr>
                                <div class="modal fade" id="edit<?= $nomor ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Ubah Pencapaian Pengguna</h5>
                                            </div>
                                            <form action="" method="post">
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label>Nama</label>
                                                        <input type="hidden" name="idachievement" value="<?= $data['idachievement'] ?>" class="form-control" readonly>
                                                        <input type="text" name="idpengguna" value="<?= $data['nama'] ?>" class="form-control" readonly>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Pencapaian</label>
                                                        <textarea name="achievement" class="form-control ckeditor" placeholder="Achievement" required><?= $data['achievement'] ?></textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Poin Posisi</label>
                                                        <input type="text" name="positionpoints" value="<?= $data['positionpoints'] ?>" class="form-control" placeholder="Position Points" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Poin Teknikal</label>
                                                        <input type="text" name="technicalpoints" value="<?= $data['technicalpoints'] ?>" class="form-control" placeholder="Technical Points" required>
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
    $positionpoints = $_POST['positionpoints'];
    $technicalpoints = $_POST['technicalpoints'];
    $achievement = $_POST['achievement'];
    $koneksi->query("INSERT INTO achievement (idpengguna, positionpoints, technicalpoints, achievement)
								VALUES('$idpengguna','$positionpoints','$technicalpoints','$achievement')") or die(mysqli_error($koneksi));
    echo "<script>alert('Data berhasil disimpan')</script>";
    echo "<script> location ='index.php?halaman=achievementdaftar';</script>";
}
if (isset($_POST['edit'])) {
    $koneksi->query("UPDATE achievement SET positionpoints='$_POST[positionpoints]',technicalpoints='$_POST[technicalpoints]',achievement='$_POST[achievement]' WHERE idachievement='$_POST[idachievement]'");
    echo "<script>alert('Data berhasil disimpan')</script>";
    echo "<script> location ='index.php?halaman=achievementdaftar';</script>";
}
?>