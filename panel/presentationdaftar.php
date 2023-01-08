<?php
if (!empty($_GET['id'])) {
    $koneksi->query("UPDATE message SET baca='Sudah' WHERE idmessage='$_GET[id]'") or die(mysqli_error($koneksi));
    echo "<script> location ='index.php?halaman=presentationdaftar';</script>";
}
if ($_SESSION['pengguna']['level'] == "Admin") { ?>
    <h1 class="section-header">
        <div>Presentasi</div>
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
                                    <th style="color: white">Tanggal</th>
                                    <th style="color: white">Nama</th>
                                    <th style="color: white">ID Enterprise</th>
                                    <th style="color: white;">Presentasi</th>
                                    <th style="color: white">Status</th>
                                    <th style="color: white">Foto</th>
                                    <th style="color: white">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $nomor = 1;
                                $ambil = $koneksi->query("SELECT * FROM presentation join pengguna on presentation.idpengguna = pengguna.idpengguna order by idpresentation desc");
                                while ($data = $ambil->fetch_assoc()) { ?>
                                    <tr>
                                        <td><?php echo $nomor ?></td>
                                        <td><?php echo tanggal($data["tanggal"]) ?></td>
                                        <td><?php echo $data["nama"] ?></td>
                                        <td><?php echo $data["identerprise"] ?></td>
                                        <td><?php echo $data["presentation"] ?></td>
                                        <td>
                                            <?php
                                            if ($data['keterangan'] != '') {
                                                echo '<b>' . $data["status"] . '</b><br>(' . $data['keterangan'] . ')';
                                            } else {
                                                echo '<b>' . $data["status"];
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <a class="btn btn-success btn-sm m-1" href="../foto/<?= $data['file'] ?>" target="_blank">Unduh</a>
                                        </td>
                                        <td>
                                            <a href="#" data-toggle="modal" data-target="#verifikasi<?= $nomor ?>" class="btn btn-info btn-sm m-1">Verifikasi</a>
                                            <?php if ($data['idpengguna'] != $idpengguna) { ?>
                                                <a href="index.php?halaman=presentationhapus&id=<?php echo $data['idpresentation']; ?>" class="btn btn-danger btn-sm m-1" onclick="return confirm('Apakah Anda yakin akan menghapus presentasi ini?')">Hapus</a>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                    <div class="modal fade" id="edit<?= $nomor ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Edit Data Presentasi</h5>
                                                </div>
                                                <form method="post" enctype="multipart/form-data">
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label>Nama Lengkap</label>
                                                            <input type="hidden" name="idpresentation" value="<?= $data['idpresentation'] ?>" class="form-control" required>
                                                            <input type="text" name="nama" value="<?= $data['nama'] ?>" class="form-control" placeholder="Nama Lengkap" readonly>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>ID Enterprise</label>
                                                            <input type="text" name="identerprise" value="<?= $data['identerprise'] ?>" class="form-control" placeholder="ID Enterprise" readonly>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Tanggal</label>
                                                            <input type="date" name="tanggal" value="<?= $data['tanggal'] ?>" class="form-control" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Presentasi</label>
                                                            <textarea name="presentation" class="form-control ckeditor" required><?= $data['presentation'] ?></textarea>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Unggah</label>
                                                            <input type="file" name="foto" class="form-control">
                                                            <input type="hidden" name="fotolama" value="<?= $data['file'] ?>" class="form-control">
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
                                    <div class="modal fade" id="verifikasi<?= $nomor ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Verifikasi</h5>
                                                </div>
                                                <form method="post" enctype="multipart/form-data">
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label>Status</label>
                                                            <input type="hidden" name="idpengguna" value="<?= $data['idpengguna'] ?>" class="form-control" required>
                                                            <input type="hidden" name="tanggal" value="<?= $data['tanggal'] ?>" class="form-control" required>
                                                            <input type="hidden" name="idpresentation" value="<?= $data['idpresentation'] ?>" class="form-control" required>
                                                            <select name="status" class="form-control" readonly>
                                                                <option value="Approved">Terima</option>
                                                                <option value="Rejected">Tolak</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Deskripsi</label>
                                                            <textarea name="keterangan" class="form-control" rows="5" required><?= $data['keterangan'] ?></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary tutup" data-dismiss="modal">Tutup</button>
                                                        <button type="submit" name="verifikasi" value="verifikasi" class="btn btn-primary">Simpan</button>
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
<?php } else { ?>
    <?php
    $idpengguna = $_SESSION['pengguna']['idpengguna'];
    $ambilprofil = $koneksi->query("SELECT *FROM pengguna WHERE idpengguna='$idpengguna'");
    $profil = $ambilprofil->fetch_assoc();
    ?>
    <h1 class="section-header">
        <div>Presentasi</div>
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
                                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Presentasi</h5>
                                </div>
                                <form method="post" enctype="multipart/form-data">
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label>Nama Lengkap</label>
                                            <input type="text" name="nama" value="<?= $profil['nama'] ?>" class="form-control" placeholder="Nama Lengkap" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label>ID Enterprise</label>
                                            <input type="text" name="identerprise" value="<?= $profil['identerprise'] ?>" class="form-control" placeholder="ID Enterprise" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label>Tanggal</label>
                                            <input type="date" name="tanggal" value="<?= date('Y-m-d') ?>" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Presentasi</label>
                                            <textarea name="presentation" class="form-control ckeditor" required></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Unggah</label>
                                            <input type="file" name="foto" class="form-control" required>
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
                                    <th style="color: white">Tanggal</th>
                                    <th style="color: white">Nama</th>
                                    <th style="color: white">ID Enterprise</th>
                                    <th style="color: white">Presentasi</th>
                                    <th style="color: white">Status</th>
                                    <th style="color: white">Foto</th>
                                    <th style="color: white">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $nomor = 1;
                                $ambil = $koneksi->query("SELECT * FROM presentation join pengguna on presentation.idpengguna = pengguna.idpengguna  where presentation.idpengguna='$idpengguna'");
                                while ($data = $ambil->fetch_assoc()) { ?>
                                    <tr>
                                        <td><?php echo $nomor ?></td>
                                        <td><?php echo tanggal($data["tanggal"]) ?></td>
                                        <td><?php echo $data["nama"] ?></td>
                                        <td><?php echo $data["identerprise"] ?></td>
                                        <td><?php echo $data["presentation"] ?></td>
                                        <td>
                                            <?php
                                            if ($data['keterangan'] != '') {
                                                echo '<b>' . $data["status"] . '</b><br>(' . $data['keterangan'] . ')';
                                            } else {
                                                echo '<b>' . $data["status"];
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <a class="btn btn-success btn-sm" href="../foto/<?= $data['file'] ?>" target="_blank">Unduh</a>
                                        </td>
                                        <td>
                                            <a href="#" data-toggle="modal" data-target="#edit<?= $nomor ?>" class="btn btn-warning btn-sm">Ubah</a>
                                            <a href="index.php?halaman=presentationhapus&id=<?php echo $data['idpresentation']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin akan menghapus presentasi ini?')">Hapus</a>
                                        </td>
                                    </tr>
                                    <div class="modal fade" id="edit<?= $nomor ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Ubah Data Presentasi</h5>
                                                </div>
                                                <form method="post" enctype="multipart/form-data">
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label>Nama Lengkap</label>
                                                            <input type="hidden" name="idpresentation" value="<?= $data['idpresentation'] ?>" class="form-control" required>
                                                            <input type="text" name="nama" value="<?= $data['nama'] ?>" class="form-control" placeholder="Nama Lengkap" readonly>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>ID Enterprise</label>
                                                            <input type="text" name="identerprise" value="<?= $data['identerprise'] ?>" class="form-control" placeholder="ID Enterprise" readonly>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Tanggal</label>
                                                            <input type="date" name="tanggal" value="<?= $data['tanggal'] ?>" class="form-control" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Presentasi</label>
                                                            <textarea name="presentation" class="form-control ckeditor" required><?= $data['presentation'] ?></textarea>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Unggah</label>
                                                            <input type="file" name="foto" class="form-control">
                                                            <input type="hidden" name="fotolama" value="<?= $data['file'] ?>" class="form-control">
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
<?php } ?>
<?php
if (isset($_POST["tambah"])) {
    $tanggal = $_POST['tanggal'];
    $presentation = $_POST['presentation'];
    $namafoto = $_FILES['foto']['name'];
    $lokasifoto = $_FILES['foto']['tmp_name'];
    move_uploaded_file($lokasifoto, "../foto/$namafoto");
    $koneksi->query("INSERT INTO presentation (idpengguna,tanggal,presentation, file, status)
								VALUES('$idpengguna','$tanggal','$presentation','$namafoto','Menunggu Validasi')") or die(mysqli_error($koneksi));
    echo "<script>alert('Data berhasil disimpan')</script>";
    echo "<script> location ='index.php?halaman=presentationdaftar';</script>";
}
if (isset($_POST['edit'])) {
    $namafoto = $_FILES['foto']['name'];
    $lokasifoto = $_FILES['foto']['tmp_name'];
    if (!empty($lokasifoto)) {
        move_uploaded_file($lokasifoto, "../foto/$namafoto");
        $foto = $namafoto;
    } else {
        $foto = $_POST['fotolama'];
    }
    $koneksi->query("UPDATE presentation SET tanggal='$_POST[tanggal]',presentation='$_POST[presentation]',file='$foto' WHERE idpresentation ='$_POST[idpresentation]'");
    echo "<script>alert('Data berhasil disimpan')</script>";
    echo "<script> location ='index.php?halaman=presentationdaftar';</script>";
}
if (isset($_POST['verifikasi'])) {
    $idpengguna = $_POST['idpengguna'];
    $status = $_POST['status'];
    $keterangan = $_POST['keterangan'];
    $tanggal = $_POST['tanggal'];
    $koneksi->query("UPDATE presentation SET status='$_POST[status]',keterangan='$_POST[keterangan]' WHERE idpresentation ='$_POST[idpresentation]'");
    if ($status == 'Approved') {
        $keterangan = 'Di Setujui';
    } else {
        $keterangan = 'Di Tolak';
    }
    $message = 'Presentasi anda pada tanggal ' . tanggal($tanggal) . ' ' . $keterangan . ' admin';
    $koneksi->query("INSERT INTO notifuser (idpengguna, message, jenis)
								VALUES('$idpengguna','$message','Presentation')") or die(mysqli_error($koneksi));
    echo "<script>alert('Berhasil diverifikasi')</script>";
    echo "<script> location ='index.php?halaman=presentationdaftar';</script>";
}
?>