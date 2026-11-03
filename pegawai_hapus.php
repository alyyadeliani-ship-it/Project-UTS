<?php
require 'function.php';
$id = (int)($_GET['id'] ?? 0);

if (hapus_pegawai($id) > 0) {
    pesan("Data pegawai berhasil dihapus!", "pegawai.php");
} else {
    pesan("Data pegawai gagal dihapus!", "pegawai.php");
}
?>
