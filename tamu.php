<?php
require 'function.php';
$keyword = $_GET['keyword'] ?? '';
$tamu = daftar_tamu($keyword);   // READ + SEARCH

$judul = "Manajemen Tamu"; $aktif = "tamu";
include 'layout_atas.php';
?>
<div class="card">
  <div class="card-header">
    <a href="tamu_form.php" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Tambah Tamu</a>
    <form method="get" class="card-tools"><div class="input-group input-group-sm" style="width:280px">
      <input type="text" name="keyword" value="<?php echo e($keyword); ?>" class="form-control" placeholder="Cari nama / instansi / keperluan">
      <div class="input-group-append"><button class="btn btn-default"><i class="fas fa-search"></i></button></div>
    </div></form>
  </div>
  <div class="card-body table-responsive p-0">
    <table class="table table-hover text-nowrap">
      <thead><tr><th>No.</th><th>Nama</th><th>Instansi</th><th>No. HP</th><th>Keperluan</th><th>Bertemu</th><th>Tanggal</th><th>Status</th><th>Aksi</th></tr></thead>
      <tbody>
      <?php $no = 1; foreach ($tamu as $data): ?>
        <tr>
          <td><?php echo $no++; ?></td>
          <td><?php echo e($data['nama']); ?></td>
          <td><?php echo e($data['instansi']); ?></td>
          <td><?php echo e($data['no_hp']); ?></td>
          <td><?php echo e($data['keperluan']); ?></td>
          <td><?php echo e($data['nama_pegawai'] ?? '-'); ?></td>
          <td><?php echo e($data['tanggal']); ?></td>
          <td><span class="badge badge-<?php echo $data['status']=='Di Dalam'?'warning':'success'; ?>"><?php echo e($data['status']); ?></span></td>
          <td>
            <a href="tamu_form.php?id=<?php echo $data['id']; ?>" class="btn btn-warning btn-xs">Edit</a>
            <a href="tamu_hapus.php?id=<?php echo $data['id']; ?>" class="btn btn-danger btn-xs" onclick="return confirm('Hapus data tamu ini?')">Hapus</a>
          </td>
        </tr>
      <?php endforeach; ?>
      <?php if (!$tamu): ?><tr><td colspan="9" class="text-center text-muted">Data tidak ditemukan</td></tr><?php endif; ?>
      </tbody>
    </table>
  </div>
</div>