<?php
$koneksi->query("DELETE FROM presentation WHERE idpresentation='$_GET[id]'");
echo "<script>alert('Data telah dihapus');</script>";
echo "<script>location='index.php?halaman=presentationdaftar';</script>";
