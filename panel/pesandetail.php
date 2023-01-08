<?php
$idmessage = $_GET['id'];
if (!empty($_GET['idnotifuser'])) {
    $ambilsebelum = $koneksi->query("SELECT * FROM notifuser left join pengguna on notifuser.idpengguna = pengguna.idpengguna where idnotifuser='$_GET[idnotifuser]'") or die(mysqli_error($koneksi));
    $cek = $ambilsebelum->fetch_assoc();
    if ($cek['baca'] == "") {
        $koneksi->query("UPDATE notifuser SET baca='Sudah' WHERE idnotifuser='$_GET[idnotifuser]'") or die(mysqli_error($koneksi));
        echo "<script> location ='index.php?halaman=pesandetail&id=$_GET[id]';</script>";
    }
}
if ($_SESSION['pengguna']['level'] == 'Admin') {
    $ambilsebelumupline = $koneksi->query("SELECT * FROM notifuser left join pengguna on notifuser.idpengguna = pengguna.idpengguna where jenis='Balasan Downline' and idtujuan='$idmessage' and baca=''") or die(mysqli_error($koneksi));
    $cekupline = $ambilsebelumupline->fetch_assoc();
    if (!empty($cekupline)) {
        $koneksi->query("UPDATE notifuser SET baca='Sudah' where jenis='Balasan Downline' and idtujuan='$idmessage' and baca=''") or die(mysqli_error($koneksi));
        echo "<script> location ='index.php?halaman=pesandetail&id=$_GET[id]';</script>";
    }
} else {
    $ambilsebelumdownline = $koneksi->query("SELECT * FROM notifuser left join pengguna on notifuser.idpengguna = pengguna.idpengguna where jenis='Balasan Upline' and idtujuan='$idmessage' and baca=''") or die(mysqli_error($koneksi));
    $cekdownline = $ambilsebelumdownline->fetch_assoc();
    if (!empty($cekdownline)) {
        $koneksi->query("UPDATE notifuser SET baca='Sudah' where jenis='Balasan Upline' and idtujuan='$idmessage' and baca=''") or die(mysqli_error($koneksi));
        echo "<script> location ='index.php?halaman=pesandetail&id=$_GET[id]';</script>";
    }
}

$ambilsebelum = $koneksi->query("SELECT * FROM message left join pengguna on message.idpengguna = pengguna.idpengguna left join target on message.idtarget = target.idtarget where idmessage='$_GET[id]'") or die(mysqli_error($koneksi));
$cek = $ambilsebelum->fetch_assoc();
$ambilpesan = $koneksi->query("SELECT * FROM message left join pengguna on message.idpengguna = pengguna.idpengguna left join target on message.idtarget = target.idtarget where idmessage='$_GET[id]'") or die(mysqli_error($koneksi));
$pesan = $ambilpesan->fetch_assoc();

if (empty($pesan)) {
    echo "<script>alert('Data sudah tidak ada');</script>";
    echo "<script> location ='index.php?halaman=beranda';</script>";
}
?>
<h1 class="section-header">
    <div>Detail Pesan</div>
</h1>
<div class="row">
    <div class="col-xl-12 col-md-12">
        <div class="card border-left-primary shadow py-2">
            <div class="card-body">
                <form method="post">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nama Lengkap</label>
                                <input type="text" name="nama" value="<?= $pesan['nama'] ?>" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>ID Enterprise</label>
                                <input type="text" name="identerprise" value="<?= $pesan['identerprise'] ?>" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nama Target</label>
                                <input type="target" name="identerprise" value="<?= $pesan['namatarget'] ?>" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>No. Whatsapp</label>
                                <input type="number" name="nowa" value="<?= $pesan['nowa'] ?>" class="form-control" readonly>
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
<div class="row" id="open_here">
    <div class="col-xl-12 col-md-12">
        <div class="card border-left-primary shadow py-2">
            <div class="card-body">
                <?php
                $ambilmessage = $koneksi->query("SELECT *FROM messagedetail where idmessage = '$idmessage' order by idmessagedetail  asc") or die(mysqli_error($koneksi));
                while ($message = $ambilmessage->fetch_assoc()) {
                    $ambilkomentarpengguna = $koneksi->query("SELECT*FROM pengguna WHERE idpengguna='$message[idpengguna]'") or die(mysqli_error($koneksi));
                    $komentarpengguna = $ambilkomentarpengguna->fetch_assoc();
                ?>
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <div class="card shadow-sm">
                                <div class="card-body">
                                    <div class="user justify-content-between">
                                        <div class="desc">
                                            <div class="d-flex justify-content-between">
                                                <h5>
                                                    <?= $komentarpengguna['nama'] ?>
                                                </h5>
                                                <p class="date"> <?= tanggal(date("Y-m-d", strtotime($message['waktu']))) . ' ' . date("H:i", strtotime($message['waktu'])); ?> WITA</p>
                                            </div>
                                            <div class="row align-items-end">
                                                <div class="col-md-9">
                                                    <p class="comment">
                                                        <?= $message['message'] ?>
                                                    </p>
                                                    <?php if ($message['fotokomentar'] != '') { ?>
                                                        <img src="../foto/<?= $message['fotokomentar'] ?>" style="border-radius: 10px" width="250px">
                                                    <?php } ?>
                                                </div>
                                                <?php if ($idpengguna == $message['idpengguna']) { ?>
                                                    <div class="col-md-3">
                                                        <a class="btn btn-danger float-right" href="index.php?halaman=balasanhapus&id=<?= $idmessage ?>&idmessagedetail=<?= $message['idmessagedetail'] ?>" onclick="return confirm('Apakah Anda Yakin Ingin Menghapus Komentar Ini ?')"><i class="fa fa-trash"></i></a>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                <div class="row mb-3">
                    <div class="col-md-12">
                        <form method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <textarea class="form-control w-100" name="message" id="message" cols="30" rows="3" placeholder="Tulis balasan anda disini" required></textarea>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <input type="file" class="form-control" name="foto" id="foto">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-success btn-lg float-right px-4" name="simpan" value="simpan">Kirim Komentar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
if (isset($_POST['simpan'])) {
    $lokasifoto = $_FILES['foto']['tmp_name'];
    if (!empty($lokasifoto)) {
        $foto = $_FILES['foto']['name'];
        move_uploaded_file($lokasifoto, "../foto/$foto");
    } else {
        $foto = '';
    }
    $koneksi->query("INSERT INTO messagedetail
    (idmessage,idpengguna,rolepengirim,message,fotokomentar)
    VALUES('$idmessage','$idpengguna','Admin','$_POST[message]','$foto')") or die(mysqli_error($koneksi));

    if ($_SESSION['pengguna']['level'] == 'Admin') {
        $jenis = 'Balasan Upline';
        $message = 'Admin telah menanggapi pesan anda (' . $pesan['message'] . ')';
        $koneksi->query("INSERT INTO notifuser (idpengguna, message, jenis, idtujuan)
                                VALUES('$pesan[idpengguna]','$message','$jenis','$idmessage')") or die(mysqli_error($koneksi));
    } else {
        $jenis = 'Balasan Downline';
        $message = $pesan['nama'] . ' dengan ID Enterprise (' . $pesan['identerprise'] . ') mengirim komentar lagi';
        $koneksi->query("INSERT INTO notifuser (idpengguna, message, jenis, idtujuan)
                                VALUES('$pesan[idpengguna]','$message','$jenis','$idmessage')") or die(mysqli_error($koneksi));
    }


    echo "<script> location ='index.php?halaman=pesandetail&id=$idmessage&skrol=ya';</script>";
} ?>
<script type='text/javascript'>
    <?php if (!empty($_GET['skrol'])) { ?>
        $('html, body').animate({
            scrollTop: $('#open_here').offset().top
        }, 'slow');
    <?php } ?>
</script>