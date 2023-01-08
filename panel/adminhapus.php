<?php
$koneksi->query("DELETE FROM pengguna WHERE idpengguna='$_GET[id]'");
echo "<script>alert('Data telah dihapus');</script>";
echo "<script>location='index.php?halaman=admindaftar';</script>";
