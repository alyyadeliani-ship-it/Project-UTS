<?php
require 'function.php';
$id = (int)($_GET['id'] ?? 0);

if (hapus_tamu($id) > 0) {
    pesan("Data tamu berhasil dihapus!", "tamu.php");
} else {
    pesan("Data tamu gagal dihapus!", "tamu.php");
}
?>
