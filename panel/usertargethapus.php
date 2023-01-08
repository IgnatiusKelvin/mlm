<?php
$koneksi->query("DELETE FROM peserta WHERE idpeserta='$_GET[id]'");
echo "<script>alert('Data berhasil dihapus');</script>";
echo "<script>location='index.php?halaman=usertargetdaftar';</script>";
