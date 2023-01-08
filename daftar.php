<?php
include 'header.php';
?>
<div class="container">
	<div class="row justify-content-center mb-3 pb-3">
		<div class="col-md-12">
			<center>
				<img src="foto/logo.png" width="300px">
			</center>
			<h3 class="mb-4 text-center">Portal Bisnis Perusahaan</h3>
			<div class="card">
				<div class="card-body">
					<form action="" method="post">
						<div class="form-group">
							<input type="text" name="nama" value="" class="form-control" placeholder="Nama Lengkap" required>
						</div>
						<div class="form-group">
							<input type="text" name="identerprise" value="" class="form-control" placeholder="ID Enterprise" required>
						</div>
						<div class="form-group">
							<input type="text" name="idsponsor" value="" class="form-control" placeholder="ID Sponsor" required>
						</div>
						<div class="form-group">
							<input type="email" name="email" value="" class="form-control" placeholder="Email" required>
						</div>
						<!-- <div class="form-group">
							<input type="password" name="password" value="" class="form-control" placeholder="Password" required>
						</div> -->
						<div class="form-group">
							<div class="input-group">
								<input class="form-control password" id="password" class="block mt-1 w-full" type="password" minlength="8" maxlength="14" placeholder="Kata Sandi" name="password" value="" autocomplete="off" required />
								<span class="input-group-text togglePassword">
									<i data-feather="eye" class="fa fa-eye" style="cursor: pointer;padding-top:5px"></i>
								</span>
							</div>
						</div>
						<div class="form-group">
							<input type="number" name="nowa" value="" class="form-control" placeholder="No. Whatsapp" required>
						</div>
						<center>
							<div class="form-group">
								<button class="btn btn-outline-danger btn-sm" name="daftar" value="daftar" type="submit">Daftar</button>
							</div>
						</center>
					</form>
				</div>
				<br>
				<center>
					<p>Sudah memiliki akun? <a href="login.php" class="text-primary">Masuk</a></p>
				</center>
			</div>
		</div>
	</div>
</div>
<?php
if (isset($_POST["daftar"])) {
	$nama = $_POST['nama'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$idsponsor = $_POST['idsponsor'];
	$nowa = $_POST['nowa'];
	$identerprise = $_POST['identerprise'];
    $ambil = $koneksi->query("SELECT*FROM pengguna 
							WHERE identerprise='$identerprise'");
    $yangcocok = $ambil->num_rows;
    if ($yangcocok >= 1) {
		echo "<script>alert('Pendaftaran gagal, id enterprise sudah terdaftar')</script>";
		echo "<script>location='daftar.php';</script>";
	} else {
		$koneksi->query("INSERT INTO pengguna	(nama, email, password, idsponsor, level, identerprise, nowa)
								VALUES('$nama','$email','$password','$idsponsor','User','$identerprise','$nowa')") or die(mysqli_error($koneksi));
		echo "<script>alert('Pendaftaran berhasil')</script>";
		echo "<script>location='login.php';</script>";
	}
}
?>
<?php
include 'footer.php';
?>