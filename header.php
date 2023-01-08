<?php error_reporting(0);
ini_set('display_errors', 0);

session_start();
include 'koneksi.php';
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
<html lang="en">

<head>
  <title>HDI - Portal Bisnis Perusahaan</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Amatic+SC:400,700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="css/open-iconic-bootstrap.min.css">
  <link rel="stylesheet" href="css/animate.css">
  <link rel="stylesheet" href="css/owl.carousel.min.css">
  <link rel="stylesheet" href="css/owl.theme.default.min.css">
  <link rel="stylesheet" href="css/magnific-popup.css">
  <link rel="stylesheet" href="css/aos.css">
  <link rel="stylesheet" href="css/ionicons.min.css">
  <link rel="stylesheet" href="css/bootstrap-datepicker.css">
  <link rel="stylesheet" href="css/jquery.timepicker.css">
  <link rel="stylesheet" href="css/flaticon.css">
  <link rel="stylesheet" href="css/icomoon.css">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/gaya.css">
  <link rel="icon" type="image/x-icon" href="foto/logo.png">
  <link href="admin/css/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js"></script>
  <script src="admin/assets/ckeditor/ckeditor.js"></script>
  <style>
    .outer {
      font-size: x-small;
    }

    .cornered {
      width: 100%;
      box-sizing: border-box;
      border-top: 50px solid #dc3545;
      border-left: 25px solid transparent;
      border-right: 25px solid transparent;
    }

    .main {
      background-color: red;
      height: 150px;
      padding: 0 2em;
    }

    @media screen and (max-width:600px) {
      .jarakbawah {
        padding-bottom: 250px
      }
    }
  </style>
</head>

<body class="goto-here">
  <nav class="navbar navbar-expand-lg ftco_navbar bg-danger" id="ftco-navbar" style="background-color: red">
    <div class="container">
      <a class="navbar-brand text-danger" href="index.php"><img width="75px" src="foto/logo.png"></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="oi oi-menu"></span> Menu
      </button>

      <div class="collapse navbar-collapse" id="ftco-nav">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active"><a href="aboutus.php" class="nav-link text-white">Tentang Kami</a></li>
          <li class="nav-item active"><a href="daftar.php" class="nav-link text-white">Daftar</a></li>
          <li class="nav-item active"><a href="login.php" class="nav-link text-white">Masuk</a></li>
        </ul>
      </div>
    </div>
  </nav>