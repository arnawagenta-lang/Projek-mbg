<?php
include 'koneksi.php';

// Proses hapus (pakai POST + prepared statement)
if (isset($_POST['hapus'])) {
    $id_hapus = (int)$_POST['id_menu'];
    $stmt_hapus = mysqli_prepare($koneksi, "DELETE FROM tb_menu_mbg WHERE id_menu = ?");
    mysqli_stmt_bind_param($stmt_hapus, 'i', $id_hapus);
    mysqli_stmt_execute($stmt_hapus);
    header("Location: tampilMenuMbg.php");
    exit();
}

// Ambil data menu MBG
$query = "SELECT id_menu, tanggal, nama_menu
          FROM tb_menu_mbg
          ORDER BY tanggal DESC, id_menu DESC";
$result = mysqli_query($koneksi, $query);
$total = mysqli_num_rows($result);
$hari_ini = date('Y-m-d');
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu MBG</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-gradient-to-b from-blue-50 to-blue-100/60 p-4 sm:p-6 antialiased">
    <main class="max-w-3xl mx-auto bg-white rounded-3xl shadow-xl shadow-blue-900/10 ring-1 ring-blue-100 p-6 sm:p-8">

        <!-- Header -->
        <div class="flex flex-wrap items-center justify-between gap-4 mb-6">
            <div>
                <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight text-blue-700">Menu MBG</h1>
                <p class="mt-1 text-sm text-blue-900/70">
                    Total <span class="font-semibold text-blue-700"><?= $total ?></span> menu tercatat
                </p>
            </div>
            <div class="flex gap-2">
                <a href="Index.php"
                   class="inline-flex items-center gap-1.5 bg-blue-100 hover:bg-blue-200 text-blue-700 font-semibold px-4 py-2.5 rounded-xl transition duration-200 focus:outline-none focus-visible:ring-4 focus-visible:ring-blue-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                    </svg>
                    Kembali
                </a>
                <a href="tambahMenuMbg.php"
                   class="inline-flex items-center gap-1.5 bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2.5 rounded-xl shadow-md shadow-blue-600/25 transition duration-200 hover:-translate-y-0.5 hover:shadow-lg active:translate-y-0 focus:outline-none focus-visible:ring-4 focus-visible:ring-blue-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                    </svg>
                    Tambah Menu
                </a>
            </div>
        </div>

        <!-- Tabel -->
        <div class="overflow-x-auto rounded-2xl ring-1 ring-blue-100">
            <table class="min-w-full text-sm text-left">
                <thead class="bg-blue-600 text-white">
                    <tr>
                        <th class="px-4 py-3.5 font-semibold uppercase tracking-wider text-xs">No</th>
                        <th class="px-4 py-3.5 font-semibold uppercase tracking-wider text-xs">Tanggal</th>
                        <th class="px-4 py-3.5 font-semibold uppercase tracking-wider text-xs">Nama Menu</th>
                        <th class="px-4 py-3.5 font-semibold uppercase tracking-wider text-xs text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-blue-100 text-blue-900">
                    <?php if ($total > 0): ?>
                        <?php $no = 1; while ($row = mysqli_fetch_assoc($result)): ?>
                            <tr class="odd:bg-white even:bg-blue-50/40 hover:bg-blue-50 transition-colors">
                                <td class="px-4 py-3.5 text-blue-900/70"><?= $no++ ?></td>
                                <td class="px-4 py-3.5 whitespace-nowrap">
                                    <?= date('d-m-Y', strtotime($row['tanggal'])) ?>
                                    <?php if ($row['tanggal'] === $hari_ini): ?>
                                        <span class="ml-2 inline-block rounded-full bg-blue-100 text-blue-700 px-2.5 py-0.5 text-[10px] font-semibold uppercase tracking-wider ring-1 ring-blue-200">Hari ini</span>
                                    <?php endif; ?>
                                </td>
                                <td class="px-4 py-3.5 font-semibold"><?= htmlspecialchars($row['nama_menu']) ?></td>
                                <td class="px-4 py-3.5">
                                    <div class="flex justify-center gap-2">
                                        <a href="editMenuMbg.php?id=<?= $row['id_menu'] ?>"
                                           class="bg-blue-500 hover:bg-blue-600 text-white px-3.5 py-1.5 rounded-lg text-xs font-semibold shadow-sm transition duration-200 hover:-translate-y-0.5 focus:outline-none focus-visible:ring-4 focus-visible:ring-blue-300">
                                            Edit
                                        </a>
                                        <form method="POST" onsubmit="return confirm('Yakin hapus menu ini?')">
                                            <input type="hidden" name="id_menu" value="<?= $row['id_menu'] ?>">
                                            <button type="submit" name="hapus"
                                                class="bg-red-500 hover:bg-red-600 text-white px-3.5 py-1.5 rounded-lg text-xs font-semibold shadow-sm transition duration-200 hover:-translate-y-0.5 focus:outline-none focus-visible:ring-4 focus-visible:ring-red-300">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4" class="px-4 py-12 text-center">
                                <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-2xl bg-blue-50 ring-1 ring-blue-100">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                                    </svg>
                                </div>
                                <p class="mt-3 font-semibold text-blue-900/70">Belum ada menu MBG.</p>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </main>
</body>
</html>