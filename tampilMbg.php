<?php
include 'koneksi.php';

// Proses hapus (pakai POST + prepared statement)
if (isset($_POST['hapus'])) {
    $id_hapus = (int)$_POST['id_mbg'];
    $stmt_hapus = mysqli_prepare($koneksi, "DELETE FROM tb_mbg WHERE id_mbg = ?");
    mysqli_stmt_bind_param($stmt_hapus, 'i', $id_hapus);
    mysqli_stmt_execute($stmt_hapus);
    header("Location: tampilMbg.php");
    exit();
}

// Ambil data MBG + nama siswa
$query = "SELECT m.id_mbg, m.tanggal, m.status_terima, s.nis, s.nama, s.kelas
          FROM tb_mbg m
          JOIN tb_siswa s ON m.id_siswa = s.id_siswa
          ORDER BY m.tanggal DESC, m.id_mbg DESC";
$result = mysqli_query($koneksi, $query);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data MBG</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-blue-50 p-4">
    <div class="max-w-5xl mx-auto bg-white rounded-2xl shadow-lg p-6">

        <div class="flex flex-wrap items-center justify-between gap-3 mb-6">
            <h1 class="text-2xl font-bold text-blue-700">Data MBG</h1>
            <div class="flex gap-2">
                <a href="Index.php"
                   class="bg-blue-100 hover:bg-blue-200 text-blue-700 font-semibold px-4 py-2 rounded-lg transition">
                    Kembali
                </a>
                <a href="tambahMbg.php"
                   class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded-lg transition">
                    + Tambah Data
                </a>
            </div>
        </div>

        <div class="overflow-x-auto rounded-lg border border-blue-100">
            <table class="min-w-full text-sm text-left">
                <thead class="bg-blue-600 text-white">
                    <tr>
                        <th class="px-4 py-3">No</th>
                        <th class="px-4 py-3">NIS</th>
                        <th class="px-4 py-3">Nama Siswa</th>
                        <th class="px-4 py-3">Kelas</th>
                        <th class="px-4 py-3">Tanggal</th>
                        <th class="px-4 py-3">Status</th>
                        <th class="px-4 py-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-blue-100">
                    <?php if (mysqli_num_rows($result) > 0): ?>
                        <?php $no = 1; while ($row = mysqli_fetch_assoc($result)): ?>
                            <tr class="hover:bg-blue-50">
                                <td class="px-4 py-3"><?= $no++ ?></td>
                                <td class="px-4 py-3"><?= htmlspecialchars($row['nis']) ?></td>
                                <td class="px-4 py-3"><?= htmlspecialchars($row['nama']) ?></td>
                                <td class="px-4 py-3"><?= htmlspecialchars($row['kelas']) ?></td>
                                <td class="px-4 py-3"><?= date('d-m-Y', strtotime($row['tanggal'])) ?></td>
                                <td class="px-4 py-3">
                                    <?php if ($row['status_terima'] === 'diterima'): ?>
                                        <span class="inline-block rounded-full bg-blue-100 text-blue-700 px-3 py-1 text-xs font-semibold">Diterima</span>
                                    <?php else: ?>
                                        <span class="inline-block rounded-full bg-red-100 text-red-700 px-3 py-1 text-xs font-semibold">Tidak Diterima</span>
                                    <?php endif; ?>
                                </td>
                                <td class="px-4 py-3">
                                    <div class="flex justify-center gap-2">
                                        <a href="editMbg.php?id=<?= $row['id_mbg'] ?>"
                                           class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1.5 rounded-lg text-xs font-semibold transition">
                                            Edit
                                        </a>
                                        <form method="POST" onsubmit="return confirm('Yakin hapus data ini?')">
                                            <input type="hidden" name="id_mbg" value="<?= $row['id_mbg'] ?>">
                                            <button type="submit" name="hapus"
                                                class="bg-red-500 hover:bg-red-600 text-white px-3 py-1.5 rounded-lg text-xs font-semibold transition">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" class="px-4 py-8 text-center text-blue-900/60">
                                Belum ada data MBG.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>