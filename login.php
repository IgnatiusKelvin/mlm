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
							<input type="text" name="identerprise" value="" class="form-control" placeholder="ID Enterprise" required>
						</div>
						<!-- <div class="form-group">
							<input type="password" name="password" value="" class="form-control" placeholder="Password" required>
						</div> -->
						<div class="form-group">
							<div class="input-group">
								<input class="form-control password" id="password" class="block mt-1 w-full" type="password"  placeholder="Kata Sandi" name="password" value="" autocomplete="off" required />
								<span class="input-group-text togglePassword">
									<i data-feather="eye" class="fa fa-eye" style="cursor: pointer;padding-top:5px"></i>
								</span>
							</div>
						</div>
						<center>
							<div class="form-group">
								<button class="btn btn-outline-danger btn-sm" name="login" value="login" type="submit">Masuk</button>
							</div>
						</center>
					</form>
				</div>
				<br>
				<center>
					<p>Belum memiliki akun?<a href="daftar.php" class="text-primary">Daftar</a></p>
				</center>
			</div>
		</div>
	</div>
</div>
<div style="padding-top:250px"></div>
<?php
if (isset($_POST["login"])) {
	$identerprise = $_POST["identerprise"];
	$password = $_POST["password"];
	$ambil = $koneksi->query("SELECT * FROM pengguna
		WHERE identerprise='$identerprise' AND password='$password' limit 1") or die(mysqli_error($koneksi));
	$akunyangcocok = $ambil->num_rows;
	if ($akunyangcocok >= 1) {
		$akun = $ambil->fetch_assoc();
		if ($akun['level'] == 'Admin') {
			$_SESSION["pengguna"] = $akun;
			echo "<script> alert('Berhasil masuk');</script>";
			echo "<script> location ='panel/index.php';</script>";
		} else {
			// echo "<script> alert('Belum Di Buat');</script>";
			// echo "<script> location ='login.php';</script>";
			$_SESSION["pengguna"] = $akun;
			echo "<script> alert('Berhasil masuk');</script>";
			echo "<script> location ='panel/index.php';</script>";
		}
	} else {
		echo "<script> alert('ID Enterprise atau Kata Sandi salah');</script>";
		echo "<script> location ='login.php';</script>";
	}
}
?>
<?php
include 'footer.php';
?>