<?php
// Satu file untuk TAMBAH (tanpa ?id) dan EDIT (dengan ?id=...)
require 'function.php';
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$t = ['nama'=>'','instansi'=>'','no_hp'=>'','keperluan'=>'','pegawai_id'=>'','tanggal'=>date('Y-m-d'),'status'=>'Di Dalam'];

if ($id) {
    $r = query_db("SELECT * FROM tamu WHERE id = ?", "i", [$id]);
    if (!$r) { header("Location: tamu.php"); exit; }
    $t = $r[0];
}

if (isset($_POST['submit'])) {
    $_POST['id'] = $id;
    if ($id) {
        $hasil = edit_tamu($_POST);
        if ($hasil >= 0) { pesan("Data tamu berhasil diubah!", "tamu.php"); exit; }
    } else {
        $hasil = tambah_tamu($_POST);
        if ($hasil > 0) { pesan("Data tamu berhasil ditambahkan!", "tamu.php"); exit; }
    }
    pesan("Data gagal disimpan!");
    $t = array_merge($t, $_POST);   // pertahankan isian
}

$pegawai = daftar_pegawai();
$judul = $id ? "Edit Tamu" : "Tambah Tamu"; $aktif = "tamu";
include 'layout_atas.php';
?>
<div class="card card-primary" style="max-width:600px">
  <form method="post">
    <div class="card-body">
      <div class="form-group"><label>Nama</label><input type="text" name="nama" class="form-control" value="<?php echo e($t['nama']); ?>" required></div>
      <div class="form-group"><label>Instansi</label><input type="text" name="instansi" class="form-control" value="<?php echo e($t['instansi']); ?>"></div>
      <div class="form-group"><label>No. HP</label><input type="text" name="no_hp" class="form-control" value="<?php echo e($t['no_hp']); ?>"></div>
      <div class="form-group"><label>Keperluan</label><textarea name="keperluan" class="form-control" rows="2" required><?php echo e($t['keperluan']); ?></textarea></div>
      <div class="form-group"><label>Bertemu dengan</label>
        <select name="pegawai_id" class="form-control">
          <option value="">- Pilih pegawai -</option>
          <?php foreach ($pegawai as $p): ?>
            <option value="<?php echo $p['id']; ?>" <?php echo $p['id']==$t['pegawai_id']?'selected':''; ?>><?php echo e($p['nama']); ?></option>
          <?php endforeach; ?>
        </select></div>
      <div class="form-row">
        <div class="form-group col-6"><label>Tanggal</label><input type="date" name="tanggal" class="form-control" value="<?php echo e($t['tanggal']); ?>" required></div>
        <div class="form-group col-6"><label>Status</label>
          <select name="status" class="form-control">
            <?php foreach (['Di Dalam', 'Selesai'] as $s): ?>
              <option <?php echo $t['status']==$s?'selected':''; ?>><?php echo $s; ?></option>
            <?php endforeach; ?>
          </select></div>
      </div>
    </div>
    <div class="card-footer">
      <button type="submit" name="submit" class="btn btn-primary"><?php echo $id ? 'Simpan Perubahan' : 'Tambah Data'; ?></button>
      <a href="tamu.php" class="btn btn-secondary">Kembali</a>
    </div>
  </form>
</div>