<?php
include 'Koneksi.php';

$query = mysqli_query($koneksi, "SELECT * FROM tb_siswa");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Data Siswa - MBG</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen">

    <!-- Header -->
    <nav class="bg-blue-500 text-white p-4 shadow-md">
        <div class="max-w-6xl mx-auto">
            <h1 class="text-xl font-bold">
                Aplikasi Pendataan MBG
            </h1>

            <p class="text-sm text-blue-100">
                Sistem Pendataan Siswa di Kelas
            </p>
        </div>
    </nav>

    <!-- Konten -->
    <main class="max-w-6xl mx-auto p-4 sm:p-6">

        <div class="bg-white rounded-xl shadow-md p-5 sm:p-6">

            <!-- Judul -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">

                <div>
                    <h2 class="text-2xl font-bold text-gray-800">
                        Data Siswa
                    </h2>

                    <p class="text-gray-500 text-sm mt-1">
                        Daftar siswa yang terdata dalam sistem MBG.
                    </p>
                </div>

                <a
                    href="tambahSiswa.php"
                    class="bg-blue-600 hover:bg-blue-500 text-white font-semibold px-4 py-3 rounded-lg text-center"
                >
                    + Tambah Siswa
                </a>

            </div>

            <!-- Tabel -->
            <div class="overflow-x-auto">

                <table class="w-full border-collapse text-sm">

                    <thead>
                        <tr class="bg-blue-100 text-gray-700">
                            <th class="border p-3 text-center">No</th>
                            <th class="border p-3 text-left">NIS</th>
                            <th class="border p-3 text-left">Nama Siswa</th>
                            <th class="border p-3 text-left">Kelas</th>
                            <th class="border p-3 text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php
                        $no = 1;

                        if (mysqli_num_rows($query) > 0) {
                            while ($data = mysqli_fetch_assoc($query)) {
                        ?>

                        <tr class="hover:bg-gray-50">

                            <td class="border p-3 text-center">
                                <?= $no++; ?>
                            </td>

                            <td class="border p-3">
                                <?= htmlspecialchars($data['nis']); ?>
                            </td>

                            <td class="border p-3">
                                <?= htmlspecialchars($data['nama']); ?>
                            </td>

                            <td class="border p-3">
                                <?= htmlspecialchars($data['kelas']); ?>
                            </td>

                            <td class="border p-3">
                                <div class="flex flex-col sm:flex-row justify-center gap-2">

                                    <a
                                        href="editSiswa.php?id=<?= (int)$data['id_siswa']; ?>"
                                        class="bg-blue-500 hover:bg-blue-600 text-gray-900 px-3 py-2 rounded text-center"
                                    >
                                        Edit
                                    </a>

                                    <a
                                        href="hapusSiswa.php?id=<?= (int)$data['id_siswa']; ?>"
                                        onclick="return confirm('Yakin ingin menghapus data siswa ini?')"
                                        class="bg-red-600 hover:bg-red-700 text-white px-3 py-2 rounded text-center"
                                    >
                                        Hapus
                                    </a>

                                </div>
                            </td>

                        </tr>

                        <?php
                            }
                        } else {
                        ?>

                        <tr>
                            <td colspan="5" class="border p-6 text-center text-gray-500">
                                Belum ada data siswa.
                            </td>
                        </tr>

                        <?php } ?>

                    </tbody>

                </table>

            </div>

            <!-- Tombol Kembali -->
            <div class="mt-6">

                <a
                    href="Index.php"
                    class="inline-block bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold px-4 py-3 rounded-lg"
                >
                    ← Kembali ke Menu Utama
                </a>

            </div>

        </div>

        <!-- Footer -->
        <p class="text-center text-gray-500 text-sm mt-6">
            Aplikasi CRUD MBG Sederhana
        </p>

    </main>

</body>
</html>