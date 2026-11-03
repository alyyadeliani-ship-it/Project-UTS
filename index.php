<?php
require 'function.php';
$total   = query_db("SELECT COUNT(*) n FROM tamu")[0]['n'];
$hariini = query_db("SELECT COUNT(*) n FROM tamu WHERE tanggal = CURDATE()")[0]['n'];
$didalam = query_db("SELECT COUNT(*) n FROM tamu WHERE status = 'Di Dalam'")[0]['n'];
$jmlpeg  = query_db("SELECT COUNT(*) n FROM pegawai")[0]['n'];
$terbaru = array_slice(daftar_tamu(), 0, 5);

$judul = "Dashboard"; $aktif = "index";
include 'layout_atas.php';
$kotak = [['info','fa-users',$total,'Total Tamu'],['success','fa-calendar-day',$hariini,'Tamu Hari Ini'],
          ['warning','fa-door-open',$didalam,'Masih Di Dalam'], ['danger','fa-user-tie',$jmlpeg,'Total Pegawai']];
?>
<div class="row">
<?php foreach ($kotak as $k): ?>
  <div class="col-md-3 col-6"><div class="small-box bg-<?php echo $k[0]; ?>">
    <div class="inner"><h3><?php echo $k[2]; ?></h3><p><?php echo $k[3]; ?></p></div>
    <div class="icon"><i class="fas <?php echo $k[1]; ?>"></i></div></div></div>
<?php endforeach; ?>
</div>

<div class="card">
  <div class="card-header"><h3 class="card-title">Tamu Terbaru</h3></div>
  <div class="card-body table-responsive p-0">
    <table class="table table-hover">
      <thead><tr><th>Nama</th><th>Instansi</th><th>Bertemu</th><th>Tanggal</th><th>Status</th></tr></thead>
      <tbody>
      <?php foreach ($terbaru as $t): ?>
        <tr><td><?php echo e($t['nama']); ?></td><td><?php echo e($t['instansi']); ?></td>
            <td><?php echo e($t['nama_pegawai'] ?? '-'); ?></td><td><?php echo e($t['tanggal']); ?></td>
            <td><span class="badge badge-<?php echo $t['status']=='Di Dalam'?'warning':'success'; ?>"><?php echo e($t['status']); ?></span></td></tr>
      <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>