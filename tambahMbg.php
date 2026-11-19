<?php
include 'koneksi.php';

$error = "";

// Ambil daftar siswa untuk dropdown
$siswa_list = mysqli_query($koneksi, "SELECT id_siswa, nis, nama, kelas FROM tb_siswa ORDER BY nama ASC");

if (isset($_POST['simpan'])) {
    $id_siswa = (int)$_POST['id_siswa'];
    $tanggal  = trim($_POST['tanggal']);
    $status   = trim($_POST['status_terima']);

    if ($id_siswa <= 0 || empty($tanggal) || empty($status)) {
        $error = "Semua kolom wajib diisi!";
    } elseif (!in_array($status, ['diterima', 'tidak diterima'])) {
        $error = "Status tidak valid!";
    } else {
        $stmt = mysqli_prepare($koneksi, "INSERT INTO tb_mbg (id_siswa, tanggal, status_terima) VALUES (?, ?, ?)");
        mysqli_stmt_bind_param($stmt, 'iss', $id_siswa, $tanggal, $status);

        if (mysqli_stmt_execute($stmt)) {
            header("Location: tampilMbg.php");
            exit();
        } else {
            $error = "Gagal menyimpan data MBG!";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data MBG</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-blue-50 flex items-center justify-center p-4">
    <div class="w-full max-w-md bg-white rounded-2xl shadow-lg p-8">
        <h1 class="text-2xl font-bold text-blue-700 text-center mb-6">Tambah Data MBG</h1>

        <?php if ($error): ?>
            <div class="mb-4 rounded-lg bg-red-100 text-red-700 px-4 py-3 text-sm">
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>

        <form method="POST" class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-blue-900 mb-1">Siswa</label>
                <select name="id_siswa"
                    class="w-full rounded-lg border border-blue-200 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">-- Pilih Siswa --</option>
                    <?php while ($s = mysqli_fetch_assoc($siswa_list)): ?>
                        <option value="<?= $s['id_siswa'] ?>">
                            <?= htmlspecialchars($s['nis'] . ' - ' . $s['nama'] . ' (' . $s['kelas'] . ')') ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-blue-900 mb-1">Tanggal</label>
                <input type="date" name="tanggal" value="<?= date('Y-m-d') ?>"
                    class="w-full rounded-lg border border-blue-200 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-blue-900 mb-1">Status</label>
                <select name="status_terima"
                    class="w-full rounded-lg border border-blue-200 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="diterima">Diterima</option>
                    <option value="tidak diterima">Tidak Diterima</option>
                </select>
            </div>
            <div class="flex gap-3 pt-2">
                <button type="submit" name="simpan"
                    class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2.5 rounded-lg transition">
                    Simpan
                </button>
                <a href="tampilMbg.php"
                    class="flex-1 text-center bg-blue-100 hover:bg-blue-200 text-blue-700 font-semibold py-2.5 rounded-lg transition">
                    Batal
                </a>
            </div>
        </form>
    </div>
</body>
</html>