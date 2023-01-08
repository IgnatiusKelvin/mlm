<h1 class="section-header">
    <div>Kelola Bagian</div>
</h1>
<div class="row mb-3">
    <div class="col-xl-12 col-md-12">
        <div class="card border-left-primary shadow py-2">
            <div class="card-body">
                <h4 class="text-center">Daftar Bagian</h4>
                <a class="btn btn-danger btn-sm mb-3" href="#" data-toggle="modal" data-target="#tambah">Tambah Bagian</a>
                <div class="modal fade" id="tambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Tambah Bagian</h5>
                            </div>
                            <form action="" method="post">
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label>Nama Bagian</label>
                                        <textarea name="namatarget" value="" class="form-control" placeholder="Nama Bagian" required></textarea>
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
                    <table class="table table-bordered" id="tabel">
                        <thead class="bg-danger">
                            <tr>
                                <th style="color: white">No</th>
                                <th style="color: white">Bagian</th>
                                <th style="color: white">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $nomor = 1;
                            $ambil = $koneksi->query("SELECT * FROM target");
                            while ($data = $ambil->fetch_assoc()) { ?>
                                <tr>
                                    <td><?php echo $nomor ?></td>
                                    <td><?php echo $data["namatarget"] ?></td>
                                    <td>
                                        <a href="#" data-toggle="modal" data-target="#edit<?= $nomor ?>" class="btn btn-warning btn-sm">Ubah</a>
                                        <a href="index.php?halaman=bagianhapus&id=<?php echo $data['idtarget']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin untuk menghapus bagian ini')">Hapus</a>
                                    </td>
                                </tr>
                                <div class="modal fade" id="edit<?= $nomor ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Ubah Bagian</h5>
                                            </div>
                                            <form action="" method="post">
                                                <div class="modal-body">
                                                    <input type="hidden" name="idtarget" value="<?= $data['idtarget'] ?>" class="form-control" required>
                                                    <div class="form-group">
                                                        <label>Bagian</label>
                                                        <textarea name="namatarget" class="form-control" placeholder="Bagian" required><?= $data['namatarget'] ?></textarea>
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
    $namatarget = $_POST['namatarget'];
    $koneksi->query("INSERT INTO target (namatarget)
								VALUES('$namatarget')") or die(mysqli_error($koneksi));
    echo "<script>alert('Data berhasil disimpan')</script>";
    echo "<script> location ='index.php?halaman=bagiandaftar';</script>";
}
if (isset($_POST['edit'])) {
    $koneksi->query("UPDATE target SET namatarget='$_POST[namatarget]' WHERE idtarget='$_POST[idtarget]'");
    echo "<script>alert('Data berhasil disimpan')</script>";
    echo "<script> location ='index.php?halaman=bagiandaftar';</script>";
}
?>