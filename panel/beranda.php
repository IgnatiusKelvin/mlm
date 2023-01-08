<h1 class="section-header">
    <div>Beranda</div>
</h1>
<?php
if ($_SESSION['pengguna']['level'] == "Admin") { ?>
    <div class="row">
        <div class="col-md-6">
            <div class="card border-left-primary shadow py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <i class="fas fa-share-alt fa-2x text-gray-300"></i>
                        </div>
                        <div class="col-auto">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Data Master
                            </div>
                        </div>
                    </div>
                    <a href="index.php?halaman=admindaftar" class="btn btn-danger mt-3 btn-sm btn-block">Selengkapnya</a>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card border-left-info shadow py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <i class="fas fa-chart-bar fa-2x text-gray-300"></i>
                        </div>
                        <div class="col-auto">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Laporan
                            </div>
                        </div>
                    </div>
                    <a href="index.php?halaman=reportdaftar" class="btn btn-danger mt-3 btn-sm btn-block">Selengkapnya</a>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card border-left-primary shadow py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <i class="fas fa-lightbulb fa-2x text-gray-300"></i>
                        </div>
                        <div class="col-auto">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Kelola Pencapaian
                            </div>
                        </div>
                    </div>
                    <a href="index.php?halaman=achievementdaftar" class="btn btn-danger mt-3 btn-sm btn-block">Selengkapnya</a>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card border-left-info shadow py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <i class="fas fa-laptop fa-2x text-gray-300"></i>
                        </div>
                        <div class="col-auto">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Data Presentasi
                            </div>
                        </div>
                    </div>
                    <a href="index.php?halaman=presentationdaftar" class="btn btn-danger mt-3 btn-sm btn-block">Selengkapnya</a>
                </div>
            </div>
        </div>
    </div>
<?php } else { ?>
    <div class="row">
        <div class="col-md-6">
            <div class="card border-left-primary shadow py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <i class="fas fa-user fa-2x text-gray-300"></i>
                        </div>
                        <div class="col-auto">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Profil
                            </div>
                        </div>
                    </div>
                    <a href="index.php?halaman=profil" class="btn btn-danger mt-3 btn-sm btn-block">Selengkapnya</a>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card border-left-info shadow py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <i class="fas fa-info fa-2x text-gray-300"></i>
                        </div>
                        <div class="col-auto">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Syarat dan Ketentuan
                            </div>
                        </div>
                    </div>
                    <a href="index.php?halaman=terms" class="btn btn-danger mt-3 btn-sm btn-block">Selengkapnya</a>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card border-left-primary shadow py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <i class="fas fa-lightbulb fa-2x text-gray-300"></i>
                        </div>
                        <div class="col-auto">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Target Pencapaian
                            </div>
                        </div>
                    </div>
                    <a href="index.php?halaman=achievement" class="btn btn-danger mt-3 btn-sm btn-block">Selengkapnya</a>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card border-left-info shadow py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <i class="fas fa-laptop fa-2x text-gray-300"></i>
                        </div>
                        <div class="col-auto">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Presentasi
                            </div>
                        </div>
                    </div>
                    <a href="index.php?halaman=presentationdaftar" class="btn btn-danger mt-3 btn-sm btn-block">Selengkapnya</a>
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
<?php } ?>