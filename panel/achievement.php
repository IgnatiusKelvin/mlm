<?php
$idpengguna = $_SESSION['pengguna']['idpengguna'];
$ambilachievement = $koneksi->query("SELECT * FROM achievement WHERE idpengguna='$idpengguna'") or die(mysqli_error($koneksi));
$achievement = $ambilachievement->fetch_assoc();
?>
<h1 class="section-header">
    <div>Target Pencapaian</div>
</h1>
<div class="row">
    <div class="col-md-6">
        <div class="card border-left-primary shadow py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col-auto">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            <p>Poin Teknikal :</p>
                            <b><?= $achievement['technicalpoints'] ?></b>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card border-left-info shadow py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col-auto">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            <p>Poin Posisi :</p>
                            <b><?= $achievement['positionpoints'] ?></b>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="card border-left-info shadow py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col-auto">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            <p>Daftar Pencapaian :</p>
                            <?= $achievement['achievement'] ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="card border-left-danger shadow py-2">
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <h4>Apa target Anda untuk bulan ini?</h4>
                    </div>
                </div>
                <div class="row">
                    <?php
                    $ambiltarget = $koneksi->query("SELECT * FROM target");
                    while ($target = $ambiltarget->fetch_assoc()) {
                    ?>
                        <div class="col-md-4 mb-3">
                            <a class="btn btn-danger btn-block" href="index.php?halaman=questionjawab&id=<?= $target['idtarget'] ?>"><?= $target['namatarget'] ?></a>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>