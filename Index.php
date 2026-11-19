<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi CRUD MBG</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-gradient-to-b from-blue-50 to-blue-100/60 flex items-center justify-center p-4 antialiased">
    <main class="w-full max-w-md bg-white rounded-3xl shadow-xl shadow-blue-900/10 ring-1 ring-blue-100 p-8 sm:p-10">

        <!-- Header -->
        <header class="text-center">
            <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-blue-50 ring-1 ring-blue-100">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 7c0-1.1 3.6-2 8-2s8 .9 8 2-3.6 2-8 2-8-.9-8-2zm0 0v5c0 1.1 3.6 2 8 2s8-.9 8-2V7m-16 5v5c0 1.1 3.6 2 8 2s8-.9 8-2v-5" />
                </svg>
            </div>
            <h1 class="mt-5 text-2xl sm:text-3xl font-extrabold tracking-tight text-blue-700">
                APLIKASI CRUD MBG
            </h1>
            <span class="mt-2 inline-block rounded-full bg-blue-50 px-3 py-1 text-xs font-semibold uppercase tracking-wider text-blue-600 ring-1 ring-blue-100">
                Sederhana
            </span>
            <p class="mt-4 text-sm sm:text-base leading-relaxed text-blue-900/70">
                Selamat datang di sistem manajemen pendataan MBG di kelas
            </p>
        </header>

        <div class="my-7 h-px bg-gradient-to-r from-transparent via-blue-100 to-transparent"></div>

        <!-- Menu -->
        <ul class="space-y-4">
            <li>
                <a href="tampilSiswa.php"
                   class="group flex items-center justify-between gap-3 rounded-xl bg-blue-600 px-5 py-3.5 font-semibold text-white shadow-md shadow-blue-600/25 transition duration-200 hover:-translate-y-0.5 hover:bg-blue-700 hover:shadow-lg hover:shadow-blue-600/30 focus:outline-none focus-visible:ring-4 focus-visible:ring-blue-300 active:translate-y-0">
                    <span class="flex items-center gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87m6-4.13a4 4 0 100-8 4 4 0 000 8zm6 0a3 3 0 100-6M3 10a3 3 0 106 0" />
                        </svg>
                        Kelola Data Siswa
                    </span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transition-transform duration-200 group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                    </svg>
                </a>
            </li>
            <li>
                <a href="tampilMbg.php"
                   class="group flex items-center justify-between gap-3 rounded-xl bg-blue-500 px-5 py-3.5 font-semibold text-white shadow-md shadow-blue-500/25 transition duration-200 hover:-translate-y-0.5 hover:bg-blue-600 hover:shadow-lg hover:shadow-blue-500/30 focus:outline-none focus-visible:ring-4 focus-visible:ring-blue-300 active:translate-y-0">
                    <span class="flex items-center gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                        </svg>
                        Kelola Data MBG
                    </span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transition-transform duration-200 group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                    </svg>
                </a>
            </li>
            <li>
               <a href="tampilMenuMbg.php"
               class="group flex items-center justify-between gap-3 rounded-xl bg-blue-400 px-5 py-3.5 font-semibold text-white shadow-md shadow-blue-400/25 transition duration-200 hover:-translate-y-0.5 hover:bg-blue-500 hover:shadow-lg hover:shadow-blue-400/30 focus:outline-none focus-visible:ring-4 focus-visible:ring-blue-300 active:translate-y-0">
               <span class="flex items-center gap-3">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M3 2v7c0 1.1.9 2 2 2h4a2 2 0 0 0 2-2V2" />
                <path d="M7 2v20" />
                <path d="M21 15V2a5 5 0 0 0-5 5v6c0 1.1.9 2 2 2h3Zm0 0v7" />
            </svg>
            Kelola Menu MBG
        </span>
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transition-transform duration-200 group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
           </svg>
          </a>
         </li>
        </ul>
    </main>
</body>
</html>