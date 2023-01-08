<h1 class="section-header">
    <div>Riwayat Pesan</div>
</h1>
<div class="row mb-3">
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
                                <th style="color: white">Target yg dipilih pengguna</th>
                                <th style="color: white">Pesan</th>
                                <th style="color: white">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $nomor = 1;
                            $ambil = $koneksi->query("SELECT * FROM message left join pengguna on message.idpengguna = pengguna.idpengguna left join target on message.idtarget = target.idtarget order by idmessage desc");
                            while ($data = $ambil->fetch_assoc()) { ?>
                                <tr>
                                    <td><?php echo $nomor ?></td>
                                    <td><?php echo $data["nama"] ?></td>
                                    <td><?php echo $data["identerprise"] ?></td>
                                    <td><?php echo $data["namatarget"] ?></td>
                                    <td><?php echo $data["message"] ?></td>
                                    <td>
                                        <a href="index.php?halaman=pesandetail&id=<?php echo $data['idmessage']; ?>" class="btn btn-warning btn-sm m-1">Lihat Pesan</a>
                                        <a href="index.php?halaman=pesanhapus&id=<?php echo $data['idmessage']; ?>" class="btn btn-danger btn-sm m-1" onclick="return confirm('Apakah Anda yakin untuk menghapus bagian ini')">Hapus</a>
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