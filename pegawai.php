<?php
require 'function.php';
$keyword = $_GET['keyword'] ?? '';
$pegawai = daftar_pegawai($keyword);   // READ + SEARCH

$judul = "Manajemen Pegawai"; $aktif = "pegawai";
include 'layout_atas.php';
?>
<div class="card">
  <div class="card-header">
    <a href="pegawai_form.php" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Tambah Pegawai</a>
    <form method="get" class="card-tools"><div class="input-group input-group-sm" style="width:280px">
      <input type="text" name="keyword" value="<?php echo e($keyword); ?>" class="form-control" placeholder="Cari nama / jabatan">
      <div class="input-group-append"><button class="btn btn-default"><i class="fas fa-search"></i></button></div>
    </div></form>
  </div>
  <div class="card-body table-responsive p-0">
    <table class="table table-hover text-nowrap">
      <thead><tr><th>No.</th><th>Nama</th><th>Jabatan</th><th>Email</th><th>Aksi</th></tr></thead>
      <tbody>
      <?php $no = 1; foreach ($pegawai as $p): ?>
        <tr>
          <td><?php echo $no++; ?></td>
          <td><?php echo e($p['nama']); ?></td>
          <td><?php echo e($p['jabatan']); ?></td>
          <td><?php echo e($p['email']); ?></td>
          <td>
            <a href="pegawai_form.php?id=<?php echo $p['id']; ?>" class="btn btn-warning btn-xs">Edit</a>
            <a href="pegawai_hapus.php?id=<?php echo $p['id']; ?>" class="btn btn-danger btn-xs" onclick="return confirm('Hapus data pegawai ini?')">Hapus</a>
          </td>
        </tr>
      <?php endforeach; ?>
      <?php if (!$pegawai): ?><tr><td colspan="6" class="text-center text-muted">Data tidak ditemukan</td></tr><?php endif; ?>
      </tbody>
    </table>
  </div>
</div>