<?php
$ambilsebelum = $koneksi->query("SELECT * FROM notifuser left join pengguna on notifuser.idpengguna = pengguna.idpengguna where idnotifuser='$_GET[id]'") or die(mysqli_error($koneksi));
$cek = $ambilsebelum->fetch_assoc();
if ($cek['baca'] == "") {
    $koneksi->query("UPDATE notifuser SET baca='Sudah' WHERE idnotifuser='$_GET[id]'") or die(mysqli_error($koneksi));
    echo "<script> location ='index.php?halaman=notifuserdetail&id=$_GET[id]';</script>";
}

$ambilpesan = $koneksi->query("SELECT * FROM notifuser where idnotifuser='$_GET[id]'") or die(mysqli_error($koneksi));
$pesan = $ambilpesan->fetch_assoc();
?>
<h1 class="section-header">
    <div>Detail Notifikasi Pengguna</div>
</h1>
<div class="row">
    <div class="col-xl-12 col-md-12">
        <div class="card border-left-primary shadow py-2">
            <div class="card-body">
                <form method="post">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Dari</label>
                                <input type="text" name="nama" value="Admin / Upline" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Pesan</label>
                                <textarea name="message" class="form-control" readonly><?= $pesan['message'] ?></textarea>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>