<?php
$koneksi->query("DELETE FROM message WHERE idmessage='$_GET[id]'");
$koneksi->query("DELETE FROM messagedetail WHERE idmessage='$_GET[id]'");
echo "<script>alert('Data telah dihapus');</script>";
echo "<script>location='index.php?halaman=pesandaftar';</script>";
