<?php
include 'koneksi.php';
 
//Ambil ID dari URL dengan aman
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

//Ambil data siswa berdasarkan ID menggunakan Prepared Statement
$stmt = mysqli_prepare($koneksi, "SELECT * FROM tb_siswa WHERE id_siswa = ?");
mysqli_stmt_bind_param($stmt, 'i', $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$siswa = mysqli_fetch_assoc($result);

//Jika data tidak di temukan
if (!$siswa) {
    die("Data siswa tidak ditemukan.");
}

$error = "";

//Proses update saat tombil Simpan perubahan ditekan
if (isset($_POST['ubah'])) {
    $nis   = trim($_POST['nis']);
    $nama  = trim($_POST['nama']);
    $kelas = trim($_POST['kelas']);
  
    //Validasi sederhana
    if (empty($nis) || empty($nama) || empty($kelas)) {
        $error = "Semua kolom wajib diisi!";
    } else {
        //Query Update menggunakan Prepared Statement
        $stmt_update = mysqli_prepare($koneksi, "UPDATE tb_siswa SET nis = ?, nama = ?, kelas = ? WHERE id_siswa = ?");
        mysqli_stmt_bind_param($stmt_update, 'sssi', $nis, $nama, $kelas, $id);

        if (mysqli_stmt_execute($stmt_update)) {
            header("Location: tampilSiswa.php");
            exit();
        } else {
            $error = "Gagal memperbarui data siswa!";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Siswa</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-blue-50 flex items-center justify-center p-4">
    <div class="w-full max-w-md bg-white rounded-2xl shadow-lg p-8">
        <h1 class="text-2xl font-bold text-blue-700 text-center mb-6">Edit Data Siswa</h1>

        <?php if ($error): ?>
            <div class="mb-4 rounded-lg bg-red-100 text-red-700 px-4 py-3 text-sm">
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>

        <form method="POST" class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-blue-900 mb-1">NIS</label>
                <input type="text" name="nis" value="<?= htmlspecialchars($siswa['nis']) ?>"
                    class="w-full rounded-lg border border-blue-200 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-blue-900 mb-1">Nama</label>
                <input type="text" name="nama" value="<?= htmlspecialchars($siswa['nama']) ?>"
                    class="w-full rounded-lg border border-blue-200 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-blue-900 mb-1">Kelas</label>
                <input type="text" name="kelas" value="<?= htmlspecialchars($siswa['kelas']) ?>"
                    class="w-full rounded-lg border border-blue-200 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div class="flex gap-3 pt-2">
                <button type="submit" name="ubah"
                    class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2.5 rounded-lg transition">
                    Simpan Perubahan
                </button>
                <a href="tampilSiswa.php"
                    class="flex-1 text-center bg-blue-100 hover:bg-blue-200 text-blue-700 font-semibold py-2.5 rounded-lg transition">
                    Batal
                </a>
            </div>
        </form>
    </div>
</body>
</html>