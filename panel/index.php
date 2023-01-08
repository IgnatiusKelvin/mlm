<?php error_reporting(0);
ini_set('display_errors', 0);

session_start();
include '../koneksi.php';
if (!isset($_SESSION['pengguna'])) {
    echo "<script>alert('Anda Harus Login');</script>";
    echo "<script>location='login.php';</script>";
    header('location:../login.php');
    exit();
}
$idpengguna = $_SESSION["pengguna"]['idpengguna'];
$ambilpengguna = $koneksi->query("SELECT *FROM pengguna WHERE idpengguna='$idpengguna'");
$pengguna = $ambilpengguna->fetch_assoc();
function tanggal($tgl)
{
    $tanggal = substr($tgl, 8, 2);
    $bulan = getBulan(substr($tgl, 5, 2));
    $tahun = substr($tgl, 0, 4);
    return $tanggal . ' ' . $bulan . ' ' . $tahun;
}
function getBulan($bln)
{
    switch ($bln) {
        case 1:
            return "Januari";
            break;
        case 2:
            return "Februari";
            break;
        case 3:
            return "Maret";
            break;
        case 4:
            return "April";
            break;
        case 5:
            return "Mei";
            break;
        case 6:
            return "Juni";
            break;
        case 7:
            return "Juli";
            break;
        case 8:
            return "Agustus";
            break;
        case 9:
            return "September";
            break;
        case 10:
            return "Oktober";
            break;
        case 11:
            return "November";
            break;
        case 12:
            return "Desember";
            break;
    }
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>HDI - Portal Bisnis Perusahaan</title>
    <link rel="stylesheet" href="../assets/home/modules/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/home/modules/ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="../assets/home/modules/fontawesome/web-fonts-with-css/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="../assets/home/modules/summernote/summernote-lite.css">
    <link rel="stylesheet" href="../assets/home/modules/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="../assets/home/css/demo.css">
    <link rel="stylesheet" href="../assets/home/css/style.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.2/css/buttons.dataTables.min.css">
    <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js"></script>
    <script src="assets/ckeditor/ckeditor.js"></script>
    <link rel="icon" type="image/x-icon" href="../foto/logo.png">
    <style>
        .modal-backdrop {
            display: none;
        }
    </style>
</head>

<body>
    <div id="app">
        <div class="main-wrapper">
            <div class="navbar-bg bg-danger"></div>
            <nav class="navbar navbar-expand-lg main-navbar">
                <form class="form-inline mr-auto">
                    <ul class="navbar-nav mr-3">
                        <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="ion ion-navicon-round"></i></a></li>
                    </ul>
                </form>
                <ul class="navbar-nav navbar-right">
                    <?php if ($_SESSION['pengguna']['level'] == 'Admin') { ?>
                        <?php
                        $ambilnotif = $koneksi->query("SELECT * FROM notifuser left join pengguna on notifuser.idpengguna = pengguna.idpengguna where notifuser.jenis = 'Balasan Downline' order by idnotifuser desc limit 10") or die(mysqli_error($koneksi));
                        $ambilbelum = $koneksi->query("SELECT * FROM notifuser left join pengguna on notifuser.idpengguna = pengguna.idpengguna where notifuser.jenis = 'Balasan Downline' and baca='' order by idnotifuser desc limit 10") or die(mysqli_error($koneksi));
                        $jumlahnotif = $ambilbelum->num_rows;
                        ?>
                        <li class="dropdown dropdown-list-toggle">
                            <?php if ($jumlahnotif >= 1) { ?>
                                <a href="#" data-toggle="dropdown" class="nav-link notification-toggle nav-link-lg beep"><i class="ion ion-ios-bell-outline"></i></a>
                            <?php } else { ?>
                                <a href="#" data-toggle="dropdown" class="nav-link notification-toggle nav-link-lg"><i class="ion ion-ios-bell-outline"></i></a>
                            <?php } ?>
                            <div class="dropdown-menu dropdown-list dropdown-menu-right">
                                <div class="dropdown-header">Notifikasi
                                </div>

                                <div class="dropdown-list-content">
                                    <?php
                                    while ($notif = $ambilnotif->fetch_assoc()) {
                                        if ($notif['jenis'] != 'Balasan Downline') {
                                    ?>
                                            <a href="index.php?halaman=notifuserdetail&id=<?= $notif['idnotifuser'] ?>" class="dropdown-item dropdown-item-unread">
                                                <div class="dropdown-item-desc">
                                                    <b><?= $notif['nama'] ?></b> <span class="float-right float-end pull-right"><?= tanggal(date("Y-m-d", strtotime($notif['waktu']))) . ' ' . date("H:i", strtotime($notif['waktu'])); ?></span>
                                                    <br>
                                                    <br>
                                                    <p><?= $notif['message'] ?></p>
                                                </div>
                                            </a>
                                        <?php } else { ?>
                                            <a href="index.php?halaman=pesandetail&id=<?= $notif['idtujuan'] ?>&idnotifuser=<?= $notif['idnotifuser'] ?>" class="dropdown-item dropdown-item-unread">
                                                <div class="dropdown-item-desc">
                                                    <b><?= $notif['nama'] ?></b> <span class="float-right float-end pull-right"><?= tanggal(date("Y-m-d", strtotime($notif['waktu']))) . ' ' . date("H:i", strtotime($notif['waktu'])); ?></span>
                                                    <br>
                                                    <br>
                                                    <p><?= $notif['message'] ?></p>
                                                </div>
                                            </a>
                                    <?php }
                                    } ?>
                                </div>
                            </div>
                        </li>
                    <?php } else { ?>
                        <?php
                        $ambilnotif = $koneksi->query("SELECT * FROM notifuser left join pengguna on notifuser.idpengguna = pengguna.idpengguna where notifuser.idpengguna = '$idpengguna' and notifuser.jenis IN ('Balasan Upline', 'Presentation') order by idnotifuser desc limit 10") or die(mysqli_error($koneksi));
                        $ambilbelum = $koneksi->query("SELECT * FROM notifuser left join pengguna on notifuser.idpengguna = pengguna.idpengguna where notifuser.idpengguna = '$idpengguna' and notifuser.jenis IN ('Balasan Upline', 'Presentation') and baca='' order by idnotifuser desc limit 10") or die(mysqli_error($koneksi));
                        $jumlahnotif = $ambilbelum->num_rows;
                        ?>
                        <li class="dropdown dropdown-list-toggle">
                            <?php if ($jumlahnotif >= 1) { ?>
                                <a href="#" data-toggle="dropdown" class="nav-link notification-toggle nav-link-lg beep"><i class="ion ion-ios-bell-outline"></i></a>
                            <?php } else { ?>
                                <a href="#" data-toggle="dropdown" class="nav-link notification-toggle nav-link-lg"><i class="ion ion-ios-bell-outline"></i></a>
                            <?php } ?>
                            <div class="dropdown-menu dropdown-list dropdown-menu-right">
                                <div class="dropdown-header">Notifikasi
                                </div>

                                <div class="dropdown-list-content">
                                    <?php
                                    while ($notif = $ambilnotif->fetch_assoc()) {
                                        if ($notif['idtujuan'] == '0') {
                                    ?>
                                            <a href="index.php?halaman=notifuserdetail&id=<?= $notif['idnotifuser'] ?>" class="dropdown-item dropdown-item-unread">
                                                <div class="dropdown-item-desc">
                                                    <b><?= $notif['nama'] ?></b> <span class="float-right float-end pull-right"><?= tanggal(date("Y-m-d", strtotime($notif['waktu']))) . ' ' . date("H:i", strtotime($notif['waktu'])); ?></span>
                                                    <br>
                                                    <br>
                                                    <p><?= $notif['message'] ?></p>
                                                </div>
                                            </a>
                                        <?php } else { ?>
                                            <a href="index.php?halaman=pesandetail&id=<?= $notif['idtujuan'] ?>&idnotifuser=<?= $notif['idnotifuser'] ?>" class="dropdown-item dropdown-item-unread">
                                                <div class="dropdown-item-desc">
                                                    <b><?= $notif['nama'] ?></b> <span class="float-right float-end pull-right"><?= tanggal(date("Y-m-d", strtotime($notif['waktu']))) . ' ' . date("H:i", strtotime($notif['waktu'])); ?></span>
                                                    <br>
                                                    <br>
                                                    <p><?= $notif['message'] ?></p>
                                                </div>
                                            </a>
                                    <?php }
                                    } ?>
                                </div>
                            </div>
                        </li>
                    <?php } ?>
                    <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg">
                            <i class="ion ion-android-person d-lg-none"></i>
                            <div class="d-sm-none d-lg-inline-block"><?= $pengguna['nama'] ?></div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a href="index.php?halaman=profil" class="dropdown-item has-icon">
                                <i class="ion ion-android-person"></i> Profil
                            </a>
                            <a href="logout.php" onclick="return confirm('Apakah Anda Yakin Ingin Keluar ?')" class="dropdown-item has-icon">
                                <i class="ion ion-log-out"></i> Keluar
                            </a>
                        </div>
                    </li>
                </ul>
            </nav>
            <div class="main-sidebar">
                <aside id="sidebar-wrapper">
                    <div class="sidebar-brand">
                        <a href="index.php?halaman=beranda" style="font-size: 10px">HDI Manado - Indonesia</a>
                    </div>
                    <div class="sidebar-user">
                        <div class="sidebar-user-picture">
                            <?php
                            if ($pengguna['foto'] == '') { ?>
                                <img alt="image" src="../foto/user.jpg">
                            <?php } else { ?>
                                <img alt="image" src="../foto/<?= $pengguna['foto'] ?>">
                            <?php } ?>
                        </div>
                        <div class="sidebar-user-details">
                            <div class="user-name"><?= $pengguna['nama'] ?></div>
                            <div class="user-role">
                                <?= $pengguna['identerprise'] ?>
                            </div>
                        </div>
                    </div>
                    <?php if ($_SESSION['pengguna']['level'] == 'Admin') { ?>
                        <ul class="sidebar-menu">
                            <li class="menu-header">Utama</li>
                            <li class="">
                                <a href="index.php?halaman=beranda"><i class="ion ion-speedometer"></i><span>Beranda</span></a>
                            </li>
                            <li class="">
                                <a href="index.php?halaman=profil"><i class="ion ion-android-person"></i><span>Profil</span></a>
                            </li>

                            <li class="menu-header">Admin</li>
                            <li>
                                <a href="#" class="has-dropdown"><i class="ion ion-ios-albums-outline"></i><span>Kelola Pencapaian</span></a>
                                <ul class="menu-dropdown">
                                    <li><a href="index.php?halaman=usertargetdaftar"><i class="ion ion-ios-circle-outline"></i> Target Pengguna</a></li>
                                    <li><a href="index.php?halaman=questiondaftar"><i class="ion ion-ios-circle-outline"></i> Kelola Pertanyaan</a></li>
                                    <li><a href="index.php?halaman=achievementdaftar"><i class="ion ion-ios-circle-outline"></i> Daftar Pencapaian</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#" class="has-dropdown"><i class="ion ion-clipboard"></i><span>Data Master</span></a>
                                <ul class="menu-dropdown">
                                    <li><a href="index.php?halaman=admindaftar"><i class="ion ion-ios-circle-outline"></i> Admin</a></li>
                                    <li><a href="index.php?halaman=userdaftar"><i class="ion ion-ios-circle-outline"></i> Pengguna</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="index.php?halaman=presentationdaftar"><i class="ion ion-laptop"></i><span>Data Presentasi</span></a>
                            </li>
                            <li>
                                <a href="index.php?halaman=reportdaftar"><i class="ion ion-stats-bars"></i><span>Laporan</span></a>
                            </li>
                            <li>
                                <a href="index.php?halaman=bagiandaftar"><i class="ion ion-settings"></i> Bagian</a>
                            </li>
                            <li>
                                <a href="index.php?halaman=pesandaftar"><i class="ion ion-chatboxes"></i> Pesan</a>
                            </li>
                        </ul>
                    <?php } else { ?>
                        <ul class="sidebar-menu">
                            <li class="menu-header">Utama</li>
                            <li class="">
                                <a href="index.php?halaman=beranda"><i class="ion ion-speedometer"></i><span>Beranda</span></a>
                            </li>
                            <li class="">
                                <a href="index.php?halaman=profil"><i class="ion ion-android-person"></i><span>Profil</span></a>
                            </li>
                            <li class="menu-header">Pengguna</li>
                            <li>
                                <a href="index.php?halaman=achievement"><i class="ion ion-ios-location-outline"></i><span>Target Pencapaian</span></a>
                            </li>
                            <li>
                                <a href="index.php?halaman=presentationdaftar"><i class="ion ion-stats-bars"></i><span>Presentasi</span></a>
                            </li>
                            <li>
                                <a href="index.php?halaman=contacttoupline"><i class="ion ion-ios-telephone-outline"></i><span>Kontak Admin</span></a>
                            </li>
                            <li class="menu-header">Umum</li>
                            <li>
                                <a href="index.php?halaman=terms"><i class="ion ion-ios-information-outline"></i> Syarat dan Ketentuan</a>
                            </li>
                        </ul>
                    <?php } ?>
                </aside>
            </div>
            <div class="main-content">
                <section class="section">
                    <?php
                    if (isset($_GET['halaman'])) {
                        if ($_GET['halaman'] == "produk") {
                            include 'produk.php';
                        } elseif ($_GET['halaman'] == "admindaftar") {
                            include 'admindaftar.php';
                        } elseif ($_GET['halaman'] == "adminhapus") {
                            include 'adminhapus.php';
                        } elseif ($_GET['halaman'] == "profil") {
                            include 'profil.php';
                        } elseif ($_GET['halaman'] == "userdaftar") {
                            include 'userdaftar.php';
                        } elseif ($_GET['halaman'] == "userhapus") {
                            include 'userhapus.php';
                        } elseif ($_GET['halaman'] == "terms") {
                            include 'terms.php';
                        } elseif ($_GET['halaman'] == "contacttoupline") {
                            include 'contacttoupline.php';
                        } elseif ($_GET['halaman'] == "questiondaftar") {
                            include 'questiondaftar.php';
                        } elseif ($_GET['halaman'] == "achievementdaftar") {
                            include 'achievementdaftar.php';
                        } elseif ($_GET['halaman'] == "questionjawab") {
                            include 'questionjawab.php';
                        } elseif ($_GET['halaman'] == "achievementhapus") {
                            include 'achievementhapus.php';
                        } elseif ($_GET['halaman'] == "achievement") {
                            include 'achievement.php';
                        } elseif ($_GET['halaman'] == "usertargetdaftar") {
                            include 'usertargetdaftar.php';
                        } elseif ($_GET['halaman'] == "usertargetdetail") {
                            include 'usertargetdetail.php';
                        } elseif ($_GET['halaman'] == "usertargethapus") {
                            include 'usertargethapus.php';
                        } elseif ($_GET['halaman'] == "presentationdaftar") {
                            include 'presentationdaftar.php';
                        } elseif ($_GET['halaman'] == "presentationhapus") {
                            include 'presentationhapus.php';
                        } elseif ($_GET['halaman'] == "reportdaftar") {
                            include 'reportdaftar.php';
                        } elseif ($_GET['halaman'] == "logout") {
                            include 'logout.php';
                        } elseif ($_GET['halaman'] == "pesandetail") {
                            include 'pesandetail.php';
                        } elseif ($_GET['halaman'] == "notifuserdetail") {
                            include 'notifuserdetail.php';
                        } elseif ($_GET['halaman'] == "akuntambah") {
                            include 'akuntambah.php';
                        } elseif ($_GET['halaman'] == "akunubah") {
                            include 'akunubah.php';
                        } elseif ($_GET['halaman'] == "akunhapus") {
                            include 'akunhapus.php';
                        } elseif ($_GET['halaman'] == "akundaftar") {
                            include 'akundaftar.php';
                        } elseif ($_GET['halaman'] == "beranda") {
                            include 'beranda.php';
                        } elseif ($_GET['halaman'] == "bagiandaftar") {
                            include 'bagiandaftar.php';
                        } elseif ($_GET['halaman'] == "bagianhapus") {
                            include 'bagianhapus.php';
                        } elseif ($_GET['halaman'] == "questionhapus") {
                            include 'questionhapus.php';
                        } elseif ($_GET['halaman'] == "pesandaftar") {
                            include 'pesandaftar.php';
                        } elseif ($_GET['halaman'] == "pesanhapus") {
                            include 'pesanhapus.php';
                        } elseif ($_GET['halaman'] == "balasanhapus") {
                            include 'balasanhapus.php';
                        }
                    } else {
                        include 'beranda.php';
                    }
                    ?>
            </div>
        </div>
    </div>
    <script src="../assets/home/modules/jquery.min.js"></script>
    <script src="../assets/home/modules/popper.js"></script>
    <script src="../assets/home/modules/tooltip.js"></script>
    <script src="../assets/home/modules/bootstrap/js/bootstrap.min.js"></script>
    <script src="../assets/home/modules/nicescroll/jquery.nicescroll.min.js"></script>
    <script src="../assets/home/modules/scroll-up-bar/assets/home/scroll-up-bar.min.js"></script>
    <script src="../assets/home/js/sa-functions.js"></script>

    <script src="../assets/home/modules/chart.min.js"></script>
    <script src="../assets/home/modules/summernote/summernote-lite.js"></script>
    <script src="../assets/home/js/scripts.js"></script>
    <script src="../assets/home/js/custom.js"></script>
    <script src="assets/DataTables/DataTables-1.10.18/js/jquery.dataTables.min.js"></script>
    <script src="assets/DataTables/DataTables-1.10.18/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.print.min.js"></script>
    <script>
        feather.replace({
            'aria-hidden': 'true'
        });
        $(".togglePassword").click(function(e) {
            e.preventDefault();
            var type = $(this).parent().parent().find(".password").attr("type");
            console.log(type);
            if (type == "password") {
                // $("svg.feather.feather-eye").replaceWith(feather.icons["eye-off"].toSvg());
                $(this).parent().parent().find("svg.feather.feather-eye").replaceWith(feather.icons["eye-off"].toSvg());
                $(this).parent().parent().find(".password").attr("type", "text");
            } else if (type == "text") {
                // $("svg.feather.feather-eye-off").replaceWith(feather.icons["eye"].toSvg());
                $(this).parent().parent().find("svg.feather.feather-eye-off").replaceWith(feather.icons["eye"].toSvg());
                $(this).parent().parent().find(".password").attr("type", "password");
            }
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#tabel').DataTable({
                "language": {
                    "search": "Cari",
                    "sLengthMenu": "Tampil _MENU_ Data",
                    "info": "Menampikan _START_ sampai _END_ dari _TOTAL_ data",
                    "infoEmpty": "Menampikan 0 sampai 0 dari 0 data",
                    "zeroRecords": "Data tidak ditemukan",
                    "paginate": {
                        "first": "Pertama",
                        "last": "Terakhir",
                        "next": "Selanjutnya",
                        "previous": "Sebelumnya"
                    },
                },
            });
        });
        $(document).ready(function() {
            $('.laporanpresentation').DataTable({
                dom: 'Bfrtip',
                buttons: [{
                        extend: 'csvHtml5',
                        title: 'Presentation',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5]
                        }
                    },
                    {
                        extend: 'excelHtml5',
                        title: 'Presentation',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5]
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        title: 'Presentation',
                        orientation: 'landscape',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5]
                        },
                        customize: function(doc) {
                            doc.content[1].table.widths =
                                Array(doc.content[1].table.body[0].length + 1).join('*').split('');
                            doc.defaultStyle.alignment = 'center';
                            doc.styles.tableHeader.alignment = 'center';
                        }

                    },
                    'colvis'
                ],
                "language": {
                    "search": "Cari",
                    "sLengthMenu": "Tampil _MENU_ Data",
                    "info": "Menampikan _START_ sampai _END_ dari _TOTAL_ data",
                    "infoEmpty": "Menampikan 0 sampai 0 dari 0 data",
                    "zeroRecords": "Data tidak ditemukan",
                    "paginate": {
                        "first": "Pertama",
                        "last": "Terakhir",
                        "next": "Selanjutnya",
                        "previous": "Sebelumnya"
                    },
                },
            });
            $('.laporanusertarget').DataTable({
                dom: 'Bfrtip',
                buttons: [{
                        extend: 'csvHtml5',
                        title: 'User Target',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4]
                        }
                    },
                    {
                        extend: 'excelHtml5',
                        title: 'User Target',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4]
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        title: 'User Target',
                        orientation: 'landscape',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4]
                        },
                        customize: function(doc) {
                            doc.content[1].table.widths =
                                Array(doc.content[1].table.body[0].length + 1).join('*').split('');
                            doc.defaultStyle.alignment = 'center';
                            doc.styles.tableHeader.alignment = 'center';
                        }

                    },
                    'colvis'
                ],
                "language": {
                    "search": "Cari",
                    "sLengthMenu": "Tampil _MENU_ Data",
                    "info": "Menampikan _START_ sampai _END_ dari _TOTAL_ data",
                    "infoEmpty": "Menampikan 0 sampai 0 dari 0 data",
                    "zeroRecords": "Data tidak ditemukan",
                    "paginate": {
                        "first": "Pertama",
                        "last": "Terakhir",
                        "next": "Selanjutnya",
                        "previous": "Sebelumnya"
                    },
                },
            });
            $('.laporanachievement').DataTable({
                dom: 'Bfrtip',
                buttons: [{
                        extend: 'csvHtml5',
                        title: 'List Achievement Users',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5]
                        }
                    },
                    {
                        extend: 'excelHtml5',
                        title: 'List Achievement Users',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5]
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        title: 'List Achievement Users',
                        orientation: 'landscape',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5]
                        },
                        customize: function(doc) {
                            doc.content[1].table.widths =
                                Array(doc.content[1].table.body[0].length + 1).join('*').split('');
                            doc.defaultStyle.alignment = 'center';
                            doc.styles.tableHeader.alignment = 'center';
                        }

                    },
                    'colvis'
                ],
                "language": {
                    "search": "Cari",
                    "sLengthMenu": "Tampil _MENU_ Data",
                    "info": "Menampikan _START_ sampai _END_ dari _TOTAL_ data",
                    "infoEmpty": "Menampikan 0 sampai 0 dari 0 data",
                    "zeroRecords": "Data tidak ditemukan",
                    "paginate": {
                        "first": "Pertama",
                        "last": "Terakhir",
                        "next": "Selanjutnya",
                        "previous": "Sebelumnya"
                    },
                },
            });
        });
    </script>
    <script>
        $(function() {
            $(".tutup").on('click', function() {
                $('.modal').modal('hide');
            });
        });
    </script>
</body>

</html>