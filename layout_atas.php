<?php /* variabel dari halaman: $judul, $aktif (index|tamu|pegawai) */ ?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo e($judul); ?> - Kunjungan Tamu</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.2.0/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav"><li class="nav-item"><a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a></li></ul>
    <span class="navbar-text ml-2 font-weight-bold">Sistem Informasi Kunjungan Tamu</span>
  </nav>
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="index.php" class="brand-link"><i class="fas fa-book-open ml-3 mr-2"></i><span class="brand-text font-weight-light">Buku Tamu</span></a>
    <div class="sidebar"><nav class="mt-3"><ul class="nav nav-pills nav-sidebar flex-column">
      <li class="nav-item"><a href="index.php" class="nav-link <?php echo $aktif=='index'?'active':''; ?>"><i class="nav-icon fas fa-tachometer-alt"></i><p>Dashboard</p></a></li>
      <li class="nav-item"><a href="tamu.php" class="nav-link <?php echo $aktif=='tamu'?'active':''; ?>"><i class="nav-icon fas fa-users"></i><p>Manajemen Tamu</p></a></li>
      <li class="nav-item"><a href="pegawai.php" class="nav-link <?php echo $aktif=='pegawai'?'active':''; ?>"><i class="nav-icon fas fa-user-tie"></i><p>Manajemen Pegawai</p></a></li>
    </ul></nav></div>
  </aside>
  <div class="content-wrapper">
    <section class="content-header"><div class="container-fluid"><h1><?php echo e($judul); ?></h1></div></section>
    <section class="content"><div class="container-fluid">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.2/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.2.0/js/adminlte.min.js"></script>
</body>
</html>