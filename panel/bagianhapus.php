<?php
$koneksi->query("DELETE FROM target WHERE idtarget='$_GET[id]'");
$koneksi->query("DELETE FROM question WHERE idtarget='$_GET[id]'");
$koneksi->query("DELETE FROM peserta WHERE idtarget='$_GET[id]'");
echo "<script>alert('Data telah dihapus');</script>";
echo "<script>location='index.php?halaman=bagiandaftar';</script>";
