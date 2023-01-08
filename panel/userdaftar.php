<h1 class="section-header">
    <div>Data Master - Pengguna</div>
</h1>
<div class="row">
    <div class="col-xl-12 col-md-12">
        <div class="card border-left-primary shadow py-2">
            <div class="card-body">
                <a class="btn btn-danger btn-sm mb-3" href="#" data-toggle="modal" data-target="#tambah">Tambah Pengguna</a>
                <div class="modal fade" id="tambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Tambah Pengguna</h5>

                            </div>
                            <form action="" method="post">
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label>Nama Lengkap</label>
                                        <input type="text" name="nama" value="" class="form-control" placeholder="Nama Lengkap" required>
                                    </div>
                                    <div class="form-group">
                                        <label>ID Enterprise</label>
                                        <input type="text" name="identerprise" value="" class="form-control" placeholder="ID Enterprise" required>
                                    </div>
                                    <div class="form-group">
                                        <label>ID Sponsor</label>
                                        <input type="number" name="idsponsor" value="" class="form-control" placeholder="ID Sponsor" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" name="email" value="" class="form-control" placeholder="Email" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Kata Sandi</label>
                                        <input type="password" name="password" value="" class="form-control" placeholder="Kata Sandi" required>
                                    </div>
                                    <div class="form-group">
                                        <label>No. Whatsapp</label>
                                        <input type="number" name="nowa" value="" class="form-control" placeholder="No. Whatsapp" required>
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
                                <th style="color: white">Nama</th>
                                <th style="color: white">ID Enterprise</th>
                                <th style="color: white">Kata Sandi</th>
                                <th style="color: white">Email</th>
                                <th style="color: white">WhatsApp</th>
                                <th style="color: white">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $nomor = 1;
                            $idpengguna = $_SESSION['pengguna']['idpengguna'];
                            $ambil = $koneksi->query("SELECT * FROM pengguna where level='User'");
                            while ($data = $ambil->fetch_assoc()) { ?>
                                <tr>
                                    <td><?php echo $nomor ?></td>
                                    <td><?php echo $data["nama"] ?></td>
                                    <td><?php echo $data["identerprise"] ?></td>
                                    <td><?php echo $data["password"] ?></td>
                                    <td><?php echo $data["email"] ?></td>
                                    <td><?php echo $data["nowa"] ?></td>
                                    <td>
                                        <a href="#" data-toggle="modal" data-target="#edit<?= $nomor ?>" class="btn btn-warning btn-sm m-1">Ubah</a>
                                        <?php if ($data['idpengguna'] != $idpengguna) { ?>
                                            <a href="index.php?halaman=userhapus&id=<?php echo $data['idpengguna']; ?>" class="btn btn-danger btn-sm m-1" onclick="return confirm('Apakah Anda yakin akan menghapus data ini?')">Hapus</a>
                                        <?php } ?>
                                    </td>
                                </tr>
                                <div class="modal fade" id="edit<?= $nomor ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Ubah Pengguna</h5>

                                            </div>
                                            <form action="" method="post">
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label>Nama Lengkap</label>
                                                        <input type="hidden" name="idpengguna" value="<?= $data['idpengguna'] ?>" class="form-control" required>
                                                        <input type="text" name="nama" value="<?= $data['nama'] ?>" class="form-control" placeholder="Nama Lengkap" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>ID Enterprise</label>
                                                        <input type="text" name="identerprise" value="<?= $data['identerprise'] ?>" class="form-control" placeholder="ID Enterprise" readonly>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>ID Sponsor</label>
                                                        <input type="number" name="idsponsor" value="<?= $data['idsponsor'] ?>" class="form-control" placeholder="ID Sponsor" readonly>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Email</label>
                                                        <input type="email" name="email" value="<?= $data['email'] ?>" class="form-control" placeholder="Email" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Kata Sandi</label>
                                                        <input type="password" name="password" value="<?= $data['password'] ?>" class="form-control" placeholder="Kata Sandi" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>No. Whatsapp</label>
                                                        <input type="number" name="nowa" value="<?= $data['nowa'] ?>" class="form-control" placeholder="No. Whatsapp" required>
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
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $idsponsor = $_POST['idsponsor'];
    $nowa = $_POST['nowa'];
    $identerprise = $_POST['identerprise'];
    $koneksi->query("INSERT INTO pengguna (nama, email, password, idsponsor, level, identerprise, nowa)
								VALUES('$nama','$email','$password','$idsponsor','User','$identerprise','$nowa')") or die(mysqli_error($koneksi));
    echo "<script>alert('Data berhasil disimpan')</script>";
    echo "<script> location ='index.php?halaman=userdaftar';</script>";
}
if (isset($_POST['edit'])) {
    $koneksi->query("UPDATE pengguna SET nama='$_POST[nama]',email='$_POST[email]',password='$_POST[password]',idsponsor='$_POST[idsponsor]',identerprise='$_POST[identerprise]',nowa='$_POST[nowa]' WHERE idpengguna='$_POST[idpengguna]'");
    echo "<script>alert('Data berhasil disimpan')</script>";
    echo "<script> location ='index.php?halaman=userdaftar';</script>";
}
?>