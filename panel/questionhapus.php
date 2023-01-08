<?php
$koneksi->query("DELETE FROM question WHERE idquestion='$_GET[id]'");
echo "<script>alert('Data telah dihapus');</script>";
echo "<script>location='index.php?halaman=questiondaftar';</script>";
