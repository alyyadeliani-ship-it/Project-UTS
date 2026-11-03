<?php
// koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "buku_tamu");
if (!$conn) { die("Koneksi gagal: " . mysqli_connect_error()); }
mysqli_set_charset($conn, "utf8mb4");

// escape output agar aman dari XSS
function e($s) { return htmlspecialchars((string)$s, ENT_QUOTES, 'UTF-8'); }

// SELECT dengan prepared statement -> array
function query_db($sql, $types = "", $params = []) {
    global $conn;
    $stmt = mysqli_prepare($conn, $sql);
    if ($types) mysqli_stmt_bind_param($stmt, $types, ...$params);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);
    return $res ? mysqli_fetch_all($res, MYSQLI_ASSOC) : [];
}

// INSERT / UPDATE / DELETE dengan prepared statement -> jumlah baris terpengaruh (-1 jika error)
function exec_db($sql, $types = "", $params = []) {
    global $conn;
    $stmt = mysqli_prepare($conn, $sql);
    if ($types) mysqli_stmt_bind_param($stmt, $types, ...$params);
    mysqli_stmt_execute($stmt);
    return mysqli_stmt_affected_rows($stmt);
}

// ================= TAMU =================
// READ + SEARCH (keyword kosong = tampilkan semua)
function daftar_tamu($keyword = "") {
    $k = "%$keyword%";
    return query_db(
        "SELECT t.*, p.nama AS nama_pegawai FROM tamu t
         LEFT JOIN pegawai p ON t.pegawai_id = p.id
         WHERE t.nama LIKE ? OR t.instansi LIKE ? OR t.keperluan LIKE ? OR p.nama LIKE ?
         ORDER BY t.id DESC", "ssss", [$k, $k, $k, $k]);
}

function tambah_tamu($d) {
    $pid = $d['pegawai_id'] !== '' ? (int)$d['pegawai_id'] : null;
    return exec_db(
        "INSERT INTO tamu (nama, instansi, no_hp, keperluan, pegawai_id, tanggal, status)
         VALUES (?,?,?,?,?,?,?)", "ssssiss",
        [trim($d['nama']), trim($d['instansi']), trim($d['no_hp']), trim($d['keperluan']),
         $pid, $d['tanggal'], $d['status']]);
}

function edit_tamu($d) {
    $pid = $d['pegawai_id'] !== '' ? (int)$d['pegawai_id'] : null;
    return exec_db(
        "UPDATE tamu SET nama=?, instansi=?, no_hp=?, keperluan=?, pegawai_id=?, tanggal=?, status=?
         WHERE id=?", "ssssissi",
        [trim($d['nama']), trim($d['instansi']), trim($d['no_hp']), trim($d['keperluan']),
         $pid, $d['tanggal'], $d['status'], (int)$d['id']]);
}

function hapus_tamu($id) {
    return exec_db("DELETE FROM tamu WHERE id=?", "i", [(int)$id]);
}

/* ================= PEGAWAI ================= */
function daftar_pegawai($keyword = "") {
    $k = "%$keyword%";
    return query_db(
        "SELECT * FROM pegawai WHERE nama LIKE ? OR jabatan LIKE ? OR divisi LIKE ? OR email LIKE ?
         ORDER BY id DESC", "ssss", [$k, $k, $k, $k]);
}

function tambah_pegawai($d) {
    return exec_db("INSERT INTO pegawai (nama, jabatan, divisi, email) VALUES (?,?,?,?)", "ssss",
        [trim($d['nama']), trim($d['jabatan']), trim($d['divisi']), trim($d['email'])]);
}

function edit_pegawai($d) {
    return exec_db("UPDATE pegawai SET nama=?, jabatan=?, divisi=?, email=? WHERE id=?", "ssssi",
        [trim($d['nama']), trim($d['jabatan']), trim($d['divisi']), trim($d['email']), (int)$d['id']]);
}

function hapus_pegawai($id) {
    return exec_db("DELETE FROM pegawai WHERE id=?", "i", [(int)$id]);
}

// helper: alert lalu pindah halaman
function pesan($teks, $tujuan = "") {
    $js = "alert(" . json_encode($teks) . ");";
    if ($tujuan) $js .= "document.location.href=" . json_encode($tujuan) . ";";
    echo "<script>$js</script>";
}
?>
