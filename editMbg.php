<?php
include 'koneksi.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

$stmt = mysqli_prepare($koneksi, "SELECT * FROM tb_mbg WHERE id_mbg = ?");
mysqli_stmt_bind_param($stmt, 'i', $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$mbg = mysqli_fetch_assoc($result);

if (!$mbg) {
    die("Data MBG tidak ditemukan.");
}

$error = "";

$siswa_list = mysqli_query($koneksi, "SELECT id_siswa, nis, nama, kelas FROM tb_siswa ORDER BY nama ASC");

if (isset($_POST['ubah'])) {
    $id_siswa = (int)$_POST['id_siswa'];
    $tanggal  = trim($_POST['tanggal']);
    $status   = trim($_POST['status_terima']);

    if ($id_siswa <= 0 || empty($tanggal) || empty($status)) {
        $error = "Semua kolom wajib diisi!";
    } elseif (!in_array($status, ['diterima', 'tidak diterima'])) {
        $error = "Status tidak valid!";
    } else {
        $stmt_update = mysqli_prepare($koneksi, "UPDATE tb_mbg SET id_siswa = ?, tanggal = ?, status_terima = ? WHERE id_mbg = ?");
        mysqli_stmt_bind_param($stmt_update, 'issi', $id_siswa, $tanggal, $status, $id);

        if (mysqli_stmt_execute($stmt_update)) {
            header("Location: tampilMbg.php");
            exit();
        } else {
            $error = "Gagal memperbarui data MBG!";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data MBG</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-blue-50 flex items-center justify-center p-4">
    <div class="w-full max-w-md bg-white rounded-2xl shadow-lg p-8">
        <h1 class="text-2xl font-bold text-blue-700 text-center mb-6">Edit Data MBG</h1>

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
                    <?php while ($s = mysqli_fetch_assoc($siswa_list)): ?>
                        <option value="<?= $s['id_siswa'] ?>" <?= $s['id_siswa'] == $mbg['id_siswa'] ? 'selected' : '' ?>>
                            <?= htmlspecialchars($s['nis'] . ' - ' . $s['nama'] . ' (' . $s['kelas'] . ')') ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-blue-900 mb-1">Tanggal</label>
                <input type="date" name="tanggal" value="<?= htmlspecialchars($mbg['tanggal']) ?>"
                    class="w-full rounded-lg border border-blue-200 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-blue-900 mb-1">Status</label>
                <select name="status_terima"
                    class="w-full rounded-lg border border-blue-200 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="diterima" <?= $mbg['status_terima'] === 'diterima' ? 'selected' : '' ?>>Diterima</option>
                    <option value="tidak diterima" <?= $mbg['status_terima'] === 'tidak diterima' ? 'selected' : '' ?>>Tidak Diterima</option>
                </select>
            </div>
            <div class="flex gap-3 pt-2">
                <button type="submit" name="ubah"
                    class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2.5 rounded-lg transition">
                    Simpan Perubahan
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