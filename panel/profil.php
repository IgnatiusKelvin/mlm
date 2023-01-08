<?php
$idpengguna = $_SESSION["pengguna"]['idpengguna'];
$ambilpengguna = $koneksi->query("SELECT *FROM pengguna WHERE idpengguna='$idpengguna'");
$data = $ambilpengguna->fetch_assoc();
if (!empty($_POST['passwordbaru'])) {
    $passwordbaru = $_POST['passwordbaru'];
    $passwordkonfirmasi = $_POST['passwordkonfirmasi'];
} else {
    $passwordbaru = "";
    $passwordkonfirmasi = "";
}
?>
<h1 class="section-header">
    <div>Ubah Profil</div>
</h1>
<div class="row">
    <div class="col-xl-12 col-md-12">
        <div class="card border-left-primary shadow py-2">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="alert alert-danger mb-3">
                            <a>Perbarui Profil Anda</a>
                        </div>
                        <form method="post" enctype="multipart/form-data">
                            <center>
                                <?php
                                if ($data['foto'] == '') { ?>
                                    <img alt="image" src="../foto/user.jpg" width="100px" style="border-radius:10px">
                                <?php } else { ?>
                                    <img alt="image" src="../foto/<?= $data['foto'] ?>" width="100px" style="border-radius:10px">
                                <?php } ?>
                            </center>
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
                                <input type="number" name="idsponsor" value="<?= $data['idsponsor'] ?>" class="form-control" placeholder="ID Sponsor" required>
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" name="email" value="<?= $data['email'] ?>" class="form-control" placeholder="Email" required>
                            </div>
                            <div class="form-group">
                                <label>No. Whatsapp</label>
                                <input type="number" name="nowa" value="<?= $data['nowa'] ?>" class="form-control" placeholder="No. Whatsapp" required>
                            </div>
                            <div class="form-group">
                                <label>Foto</label>
                                <input type="file" name="foto" class="form-control">
                            </div>
                            <div class="form-group">
                                <center>
                                    <button type="submit" name="edit" value="edit" class="btn btn-danger">Simpan</button>
                                </center>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-6">
                        <div class="alert alert-danger mb-3">
                            <a>Ganti Kata Sandi</a>
                        </div>
                        <p class="text-justify">Gunakan kata sandi yang panjang. Panjang kata sandi minimal harus 6 digit, meskipun bisa lebih panjang untuk keamanan ekstra. Jangan gunakan kata sandi yang sama untuk semua akun Anda*</p>
                        <form method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label class="form-label">Kata Sandi Baru*</label>
                                <div class="input-group">
                                    <input class="form-control password" id="password" class="block mt-1 w-full" type="text" minlength="8" maxlength="14" name="passwordbaru" value="<?= $passwordbaru ?>" placeholder="Kata Sandi Baru" required />
                                    <span class="input-group-text togglePassword">
                                        <i data-feather="eye" class="fa fa-eye" style="cursor: pointer;padding-top:5px"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Konfirmasi Kata Sandi</label>
                                <div class="input-group">
                                    <input class="form-control password" id="password" class="block mt-1 w-full" type="text" name="passwordkonfirmasi" value="<?= $passwordkonfirmasi ?>" placeholder="Konfirmasi Kata Sandi" required />
                                    <span class="input-group-text togglePassword">
                                        <i data-feather="eye" class="fa fa-eye" style="cursor: pointer;padding-top:5px"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <center>
                                    <button type="submit" name="editpassword" value="editpassword" class="btn btn-danger">Ubah Kata Sandi</button>
                                </center>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
if (isset($_POST['edit'])) {
    $namafoto = $_FILES['foto']['name'];
    $lokasifoto = $_FILES['foto']['tmp_name'];
    if (!empty($lokasifoto)) {
        move_uploaded_file($lokasifoto, "../foto/$namafoto");
        $foto = $namafoto;
    } else {
        $foto = $data['foto'];
    }
    $koneksi->query("UPDATE pengguna SET nama='$_POST[nama]',email='$_POST[email]',idsponsor='$_POST[idsponsor]',nowa='$_POST[nowa]',foto='$foto' WHERE idpengguna='$_POST[idpengguna]'");
    echo "<script>alert('Data berhasil disimpan');</script>";
    echo "<script> location ='index.php?halaman=profil';</script>";
}
if (isset($_POST['editpassword'])) {
    if ($_POST['passwordbaru'] == $_POST['passwordkonfirmasi']) {
        $koneksi->query("UPDATE pengguna SET password='$_POST[passwordbaru]' WHERE idpengguna='$idpengguna'");
        echo "<script>alert('Kata sandi telah diganti');</script>";
        echo "<script> location ='index.php?halaman=profil';</script>";
    } else {
        echo "<script>alert('Konfirmasi kata sandi baru tidak sesuai');</script>";
    }
}
?>