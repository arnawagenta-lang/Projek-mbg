<?php
include 'Koneksi.php';

$err_nis = "";
$err_nama = "";
$err_global = "";

$nis = "";
$nama = "";
$kelas = "";

if (isset($_POST['submit'])) {
    $nis     = trim($_POST['nis']);
    $nama    = trim($_POST['nama']);
    $kelas   = trim($_POST['kelas']);

    $valid = true;

    // 2. Validasi NIS dengan Regex (hanya angka)
    if (!preg_match("/^[0-9]+$/", $nis)) {
        $err_nis = "NIS hanya boleh berisi angka!";
        $valid = false;
    }

    // 3. Validasi Nama dengan Regex (huruf, spasi, titik, koma)
    if (!preg_match("/^[a-zA-Z\s.,]+$/", $nama)) {
        $err_nama = "Nama hanya boleh berisi huruf, spasi, titik (.), dan koma (,)!";
        $valid = false;
    } 

    // Jika semua validasi lolos, maka simpan ke database
    if ($valid) {
        $query = mysqli_query($koneksi, "INSERT INTO tb_siswa (nis, nama, kelas) VALUES ('$nis', '$nama', '$kelas' )");

        if ($query) {
            header("Location: tampilSiswa.php");
            exit();
        } else {
            $err_global = "Gagal menyimpan data ke database!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Tambah Data Siswa - MBG</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body class="min-h-screen bg-blue-50">

    <!-- Header -->
    <header class="bg-blue-700 text-white shadow-lg">
        <div class="max-w-5xl mx-auto px-5 py-5">
            <h1 class="text-2xl font-bold">
                Aplikasi CRUD MBG
            </h1>

            <p class="text-blue-100 text-sm mt-1">
                Sistem Pendataan Siswa di Kelas
            </p>
        </div>
    </header>

    <!-- Konten Utama -->
    <main class="max-w-xl mx-auto px-4 py-8">

        <div class="bg-white rounded-2xl shadow-lg overflow-hidden">

            <!-- Judul Form -->
            <div class="bg-blue-600 px-6 py-5 text-white">
                <h2 class="text-xl font-bold">
                    Tambah Data Siswa
                </h2>

                <p class="text-blue-100 text-sm mt-1">
                    Silakan isi data siswa dengan lengkap.
                </p>
            </div>

            <!-- Isi Form -->
            <div class="p-6">

                <!-- Pesan Error -->
                <?php if (!empty($err_global)) : ?>
                    <div class="bg-red-100 border border-red-300 text-red-700 px-4 py-3 rounded-lg mb-5 text-sm">
                        <?= htmlspecialchars($err_global); ?>
                    </div>
                <?php endif; ?>

                <form action="" method="POST" class="space-y-5">

                    <!-- NIS -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            NIS
                        </label>

                        <input
                            type="text"
                            name="nis"
                            value="<?= htmlspecialchars($nis); ?>"
                            placeholder="Masukkan NIS siswa"
                            required
                            class="w-full rounded-lg border <?= !empty($err_nis) ? 'border-red-500 bg-red-50' : 'border-gray-300'; ?> px-4 py-3 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200">

                        <?php if (!empty($err_nis)) : ?>
                            <p class="text-red-500 text-xs mt-2">
                                <?= htmlspecialchars($err_nis); ?>
                            </p>
                        <?php endif; ?>
                    </div>

                    <!-- Nama -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Nama Siswa
                        </label>

                        <input
                            type="text"
                            name="nama"
                            value="<?= htmlspecialchars($nama); ?>"
                            placeholder="Masukkan nama lengkap"
                            required
                            class="w-full rounded-lg border <?= !empty($err_nama) ? 'border-red-500 bg-red-50' : 'border-gray-300'; ?> px-4 py-3 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200">

                        <?php if (!empty($err_nama)) : ?>
                            <p class="text-red-500 text-xs mt-2">
                                <?= htmlspecialchars($err_nama); ?>
                            </p>
                        <?php endif; ?>
                    </div>

                    <!-- Kelas -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Kelas
                        </label>

                        <input
                            type="text"
                            name="kelas"
                            value="<?= htmlspecialchars($kelas); ?>"
                            placeholder="Contoh: XI RPL 2"
                            required
                            class="w-full rounded-lg border border-gray-300 px-4 py-3 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200">
                    </div>


                    <!-- Tombol -->
                    <div class="flex flex-col sm:flex-row gap-3 pt-2">

                        <button
                            type="submit"
                            name="submit"
                            class="flex-1 bg-blue-600 hover:bg-blue-700 active:bg-blue-800 text-white font-semibold py-3 px-5 rounded-lg transition duration-200">
                            Simpan Data
                        </button>

                        <a
                            href="tampilSiswa.php"
                            class="flex-1 text-center bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold py-3 px-5 rounded-lg transition duration-200">
                            Batal
                        </a>

                    </div>

                </form>

            </div>
        </div>

        <!-- Footer -->
        <p class="text-center text-gray-500 text-sm mt-6">
            &copy; 2026 Aplikasi Pendataan MBG
        </p>

    </main>

</body>
</html>