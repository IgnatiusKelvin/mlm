<h1 class="section-header">
    <div>Kontak Admin</div>
</h1>
<div class="row">
    <div class="col-xl-12 col-md-12">
        <div class="card border-left-primary shadow py-2">
            <div class="card-body">
                <h4>Hubungi Admin Anda</h4>
                <form method="post">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nama Lengkap</label>
                                <input type="hidden" name="idpengguna" value="<?= $pengguna['idpengguna'] ?>" class="form-control" readonly>
                                <input type="text" name="nama" value="<?= $pengguna['nama'] ?>" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>ID Enterprise</label>
                                <input type="text" name="identerprise" value="<?= $pengguna['identerprise'] ?>" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Pilih Target</label>
                                <select name="idtarget" class="form-control" required>
                                    <option>Pilih Target</option>
                                    <?php
                                    $ambiltarget = $koneksi->query("SELECT * FROM target");
                                    while ($target = $ambiltarget->fetch_assoc()) { ?>
                                        <option value="<?= $target['idtarget'] ?>"><?= $target['namatarget'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>No. Whatsapp</label>
                                <input type="number" name="nowa" value="<?= $pengguna['nowa'] ?>" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Pesan</label>
                                <textarea name="message" class="form-control" required></textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <button type="submit" name="simpan" value="simpan" class="btn btn-danger float-right">Kirim</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xl-12 col-md-12">
        <div class="card border-left-primary shadow py-2">
            <div class="card-body">
                <h4>Riwayat Pesan Anda</h4>
                <div class="table-responsive">
                    <table class="table table-bordered" id="tabel">
                        <thead class="bg-danger">
                            <tr>
                                <th style="color: white">No</th>
                                <th style="color: white">Nama</th>
                                <th style="color: white">ID Enterprise</th>
                                <th style="color: white">Target yang Dipilih Pengguna</th>
                                <th style="color: white">Pesan</th>
                                <th style="color: white">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $nomor = 1;
                            $ambil = $koneksi->query("SELECT * FROM message left join pengguna on message.idpengguna = pengguna.idpengguna left join target on message.idtarget = target.idtarget where message.idpengguna = $idpengguna order by idmessage desc");
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
if (isset($_POST["simpan"])) {
    $idpengguna = $_POST['idpengguna'];
    $idtarget = $_POST['idtarget'];
    $message = $_POST['message'];
    $koneksi->query("INSERT INTO message (idpengguna, idtarget, message)
								VALUES('$idpengguna','$idtarget','$message')") or die(mysqli_error($koneksi));
    $idmessage = $koneksi->insert_id;
    $message = $pengguna['nama'] . ' dengan ID Enterprise (' . $pengguna['identerprise'] . ') telah mengirimkan pesan kepada Anda';
    $jenis = 'Balasan Downline';
    $koneksi->query("INSERT INTO notifuser (idpengguna, message, jenis, idtujuan)
                        VALUES('$idpengguna','$message','$jenis','$idmessage')") or die(mysqli_error($koneksi));


    echo "<script>alert('Pesan berhasil dikirim')</script>";
    echo "<script> location ='index.php?halaman=contacttoupline';</script>";
}
?>