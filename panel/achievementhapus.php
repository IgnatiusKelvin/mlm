<?php
$koneksi->query("DELETE FROM achievement WHERE idachievement='$_GET[id]'");
echo "<script>alert('Data telah dihapus');</script>";
echo "<script>location='index.php?halaman=achievementdaftar';</script>";
