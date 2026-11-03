<?php
// Satu file untuk TAMBAH (tanpa ?id) dan EDIT (dengan ?id=...)
require 'function.php';
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$p = ['nama'=>'','jabatan'=>'','divisi'=>'','email'=>''];

if ($id) {
    $r = query_db("SELECT * FROM pegawai WHERE id = ?", "i", [$id]);
    if (!$r) { header("Location: pegawai.php"); exit; }
    $p = $r[0];
}

if (isset($_POST['submit'])) {
    $_POST['id'] = $id;
    if ($id) {
        if (edit_pegawai($_POST) >= 0) { pesan("Data pegawai berhasil diubah!", "pegawai.php"); exit; }
    } else {
        if (tambah_pegawai($_POST) > 0) { pesan("Data pegawai berhasil ditambahkan!", "pegawai.php"); exit; }
    }
    pesan("Data gagal disimpan!");
    $p = array_merge($p, $_POST);
}

$judul = $id ? "Edit Pegawai" : "Tambah Pegawai"; $aktif = "pegawai";
include 'layout_atas.php';
?>
<div class="card card-primary" style="max-width:600px">
  <form method="post">
    <div class="card-body">
      <div class="form-group"><label>Nama</label><input type="text" name="nama" class="form-control" value="<?php echo e($p['nama']); ?>" required></div>
      <div class="form-group"><label>Jabatan</label><input type="text" name="jabatan" class="form-control" value="<?php echo e($p['jabatan']); ?>"></div>
      <div class="form-group"><label>Email</label><input type="email" name="email" class="form-control" value="<?php echo e($p['email']); ?>"></div>
    </div>
    <div class="card-footer">
      <button type="submit" name="submit" class="btn btn-primary"><?php echo $id ? 'Simpan Perubahan' : 'Tambah Data'; ?></button>
      <a href="pegawai.php" class="btn btn-secondary">Kembali</a>
    </div>
  </form>
</div>