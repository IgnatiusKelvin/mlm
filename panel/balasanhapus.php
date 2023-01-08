<?php
$koneksi->query("DELETE FROM messagedetail WHERE idmessagedetail ='$_GET[idmessagedetail]'");
echo "<script>alert('Balasan Berhasil Di Hapus');</script>";
echo "<script>location='index.php?halaman=pesandetail&id=$_GET[id]&skrol=ya';</script>";
