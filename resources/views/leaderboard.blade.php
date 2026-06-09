<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leaderboard - Pustasda</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-[#F8FAFC] flex h-screen overflow-hidden antialiased text-gray-800">

    <aside class="w-[260px] border-r border-gray-200 flex flex-col justify-between shrink-0 bg-white relative">
        <div>
            <div class="h-[72px] flex items-center px-6">
                <div class="flex items-center gap-2.5">
                    <div class="w-7 h-7 bg-rose-600 rounded-lg flex items-center justify-center text-white shadow-sm shadow-rose-500/20">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M19 3H5v4.11l4.83 4.46V21h4.34v-9.43L19 7.11V3zm-2 3H7V5h10v1z"/></svg>
                    </div>
                    <span class="text-xl font-bold tracking-tight text-gray-900">Pustasda</span>
                </div>
            </div>

            <div class="px-4 mt-4">
                <div class="mb-5">
                    <p class="px-3 text-[11px] font-semibold text-gray-400 uppercase tracking-wider mb-2">Halaman</p>
                    <a href="/" class="flex items-center gap-3 px-3 py-2.5 rounded-xl font-medium text-sm mb-1 text-gray-400 hover:text-gray-700 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                        Beranda
                    </a>
                    <a href="/pengaturan" class="flex items-center gap-3 px-3 py-2.5 rounded-xl font-medium text-sm text-gray-400 hover:text-gray-700 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        Pengaturan
                    </a>
                </div>

                <div class="mb-5">
                    <p class="px-3 text-[11px] font-semibold text-gray-400 uppercase tracking-wider mb-2">Lomba</p>
                    <a href="/eksplor" class="flex items-center gap-3 px-3 py-2.5 rounded-xl font-medium text-sm mb-1 text-gray-400 hover:text-gray-700 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h12M4 18h12"></path></svg>
                        Eksplor
                    </a>
                    <a href="/disimpan" class="flex items-center gap-3 px-3 py-2.5 rounded-xl font-medium text-sm mb-1 text-gray-400 hover:text-gray-700 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"></path></svg>
                        Disimpan
                    </a>
                    <a href="/leaderboard" class="flex items-center gap-3 px-3 py-2.5 rounded-xl font-semibold text-sm mb-1 bg-rose-50 text-rose-600 transition">
                        <svg class="w-5 h-5 text-rose-600" fill="currentColor" viewBox="0 0 20 20"><path d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM16 3a1 1 0 011-1h2a1 1 0 011 1v13a1 1 0 01-1 1h-2a1 1 0 01-1-1V3z"></path></svg>
                        Leaderboard
                    </a>
                </div>

                <div>
                    <p class="px-3 text-[11px] font-semibold text-gray-400 uppercase tracking-wider mb-2">Lainnya</p>
                    <a href="/kelola-user" class="flex items-center gap-3 px-3 py-2.5 rounded-xl font-medium text-sm text-gray-400 hover:text-gray-700 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                        Kelola User
                    </a>
                </div>
            </div>
        </div>

        <div class="px-4 pb-6">
            <button class="w-full flex items-center justify-center gap-2 px-4 py-2.5 bg-rose-50 text-rose-600 rounded-xl font-semibold text-sm hover:bg-rose-100 transition duration-200">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                Logout
            </button>
        </div>
    </aside>

    <main class="flex-1 flex flex-col h-screen overflow-hidden relative">
        
        <header class="h-[72px] flex items-center justify-between px-8 border-b border-gray-200 shrink-0 bg-white">
            <div class="flex h-full gap-1">
                <a href="/" class="flex items-center px-4 font-medium text-sm text-gray-400 hover:text-gray-600 transition">
                    Beranda
                </a>
                <a href="/tentang" class="flex items-center px-4 font-medium text-sm text-gray-400 hover:text-gray-600 transition">
                    Tentang
                </a>
            </div>
            
            <div class="flex items-center gap-6">
                <div class="relative w-48 sm:w-60">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </span>
                    <input type="text" placeholder="Cari sesuatu..." class="w-full pl-9 pr-4 py-1.5 bg-gray-100/80 border border-transparent rounded-lg text-xs font-medium text-gray-700 placeholder-gray-400 focus:outline-none focus:bg-white focus:border-gray-200 transition">
                </div>
                
                <div class="flex items-center gap-3 border-l border-gray-200 pl-6">
                    <div class="text-right">
                        <h4 class="font-bold text-sm text-gray-900 leading-tight">Brahma Alfaris</h4>
                        <p class="text-[11px] font-semibold text-rose-600 tracking-wider uppercase">Admin</p>
                    </div>
                    <div class="w-9 h-9 bg-gray-200 rounded-full overflow-hidden border border-gray-200 shadow-sm">
                        <svg class="w-full h-full text-gray-400 p-1" fill="currentColor" viewBox="0 0 24 24"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
                    </div>
                </div>
            </div>
        </header>

        <div class="flex-1 overflow-y-auto px-8 py-8">
            <div class="max-w-[1060px] mx-auto w-full">
                
                <div class="mb-6">
                    <h1 class="text-2xl font-extrabold text-gray-900 tracking-tight">Leaderboard</h1>
                </div>

                <div class="bg-white border border-gray-200 rounded-2xl p-5 mb-6 shadow-sm flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 bg-indigo-600 rounded-xl flex items-center justify-center text-white shrink-0 shadow-md shadow-indigo-500/10">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"><path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89l-.06-1.3C3 10.703 3.11 9.99 3.31 9.397zM6.93 11.3a11.393 11.393 0 011.986-.132c.55 0 1.08.039 1.584.114l-2.007.86a1 1 0 00-.787 0l-1.32-.566zM12 14.222c0 .242-.012.48-.034.716A8.91 8.91 0 0110 15.303c-1.13 0-2.207-.208-3.2-.582a1.1 1.1 0 01-.8-.94l-.06-1.3A1 1 0 017 11.41a10.36 10.36 0 013-.41c1.11 0 2.143.174 3 .483V14.22z"></path></svg>
                        </div>
                        <div>
                            <h3 class="font-bold text-gray-900 text-[17px] tracking-tight">Leaderboard Siswa Berprestasi</h3>
                            <p class="text-xs text-gray-400 mt-0.5">Dihitung berdasarkan prestasi yang diraih</p>
                        </div>
                    </div>
                    
                    <div class="relative min-w-[210px]">
                        <select class="block w-full bg-white border border-gray-200 text-gray-700 py-2.5 pl-4 pr-10 rounded-xl leading-tight focus:outline-none focus:ring-2 focus:ring-rose-500/10 focus:border-rose-500 text-xs font-semibold appearance-none cursor-pointer shadow-sm hover:bg-gray-50 transition">
                            <option value="aktif_prestasi">Siswa Aktif & Berprestasi</option>
                            <option value="aktif">Siswa paling Aktif</option>
                            <option value="prestasi">Siswa paling berprestasi</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-gray-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-gray-50/70 border-b border-gray-200 text-[11px] font-bold text-gray-400 uppercase tracking-wider">
                                    <th class="py-4 px-6 text-center w-20">Rank</th>
                                    <th class="py-4 px-6">Nama</th>
                                    <th class="py-4 px-6">Sekolah</th>
                                    <th class="py-4 px-6 text-center">Kontes Selesai</th>
                                    <th class="py-4 px-6 text-right w-44">Total Poin</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100 text-sm font-medium text-gray-700">
                                
                                <tr class="hover:bg-gray-50/50 transition">
                                    <td class="py-4 px-6 text-center">
                                        <div class="w-7 h-7 bg-amber-100 text-amber-600 rounded-full flex items-center justify-center mx-auto shadow-sm">
                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M5 4a2 2 0 012-2h6a2 2 0 012 2v14a2 2 0 01-2 2H7a2 2 0 01-2-2V4zm2-2a1 1 0 00-1 1v1h8V3a1 1 0 00-1-1H7zm0 4v1h6V6H7zm0 3v1h6V9H7zm0 3v1h6v-1H7z"></path></svg>
                                        </div>
                                    </td>
                                    <td class="py-4 px-6">
                                        <div class="flex items-center gap-3">
                                            <div class="w-8 h-8 bg-gray-200 rounded-full overflow-hidden border border-gray-100 shrink-0">
                                                <svg class="w-full h-full text-gray-400 p-0.5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
                                            </div>
                                            <span class="font-bold text-gray-900">Brahma Alfaris</span>
                                        </div>
                                    </td>
                                    <td class="py-4 px-6 text-gray-500">SMK Telkom Sidoarjo</td>
                                    <td class="py-4 px-6 text-center font-semibold">18</td>
                                    <td class="py-4 px-6">
                                        <div class="flex items-center justify-end gap-3">
                                            <div class="flex items-center gap-1.5 font-bold text-amber-600 bg-amber-50 px-2.5 py-1 rounded-lg text-xs border border-amber-200/50">
                                                <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path d="M5 4a2 2 0 012-2h6a2 2 0 012 2v14a2 2 0 01-2 2H7a2 2 0 01-2-2V4zm2-2a1 1 0 00-1 1v1h8V3a1 1 0 00-1-1H7z"></path></svg>
                                                5000
                                            </div>
                                            <svg class="w-4 h-4 text-gray-400 cursor-pointer hover:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                        </div>
                                    </td>
                                </tr>

                                <tr class="hover:bg-gray-50/50 transition">
                                    <td class="py-4 px-6 text-center">
                                        <div class="w-7 h-7 bg-slate-100 text-slate-500 rounded-full flex items-center justify-center mx-auto shadow-sm">
                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M5 4a2 2 0 012-2h6a2 2 0 012 2v14a2 2 0 01-2 2H7a2 2 0 01-2-2V4zm2-2a1 1 0 00-1 1v1h8V3a1 1 0 00-1-1H7z"></path></svg>
                                        </div>
                                    </td>
                                    <td class="py-4 px-6">
                                        <div class="flex items-center gap-3">
                                            <div class="w-8 h-8 bg-gray-200 rounded-full overflow-hidden border border-gray-100 shrink-0">
                                                <svg class="w-full h-full text-gray-400 p-0.5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
                                            </div>
                                            <span class="font-bold text-gray-900">Ahmad Fauzi</span>
                                        </div>
                                    </td>
                                    <td class="py-4 px-6 text-gray-500">SMK Telkom Sidoarjo</td>
                                    <td class="py-4 px-6 text-center font-semibold">10</td>
                                    <td class="py-4 px-6">
                                        <div class="flex items-center justify-end gap-3">
                                            <div class="flex items-center gap-1.5 font-bold text-slate-600 bg-slate-50 px-2.5 py-1 rounded-lg text-xs border border-slate-200/50">
                                                <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path d="M5 4a2 2 0 012-2h6a2 2 0 012 2v14a2 2 0 01-2 2H7a2 2 0 01-2-2V4zm2-2a1 1 0 00-1 1v1h8V3a1 1 0 00-1-1H7z"></path></svg>
                                                3450
                                            </div>
                                            <svg class="w-4 h-4 text-gray-400 cursor-pointer hover:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                        </div>
                                    </td>
                                </tr>

                                <tr class="hover:bg-gray-50/50 transition">
                                    <td class="py-4 px-6 text-center">
                                        <div class="w-7 h-7 bg-amber-500/10 text-amber-700 rounded-full flex items-center justify-center mx-auto shadow-sm">
                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M5 4a2 2 0 012-2h6a2 2 0 012 2v14a2 2 0 01-2 2H7a2 2 0 01-2-2V4zm2-2a1 1 0 00-1 1v1h8V3a1 1 0 00-1-1H7z"></path></svg>
                                        </div>
                                    </td>
                                    <td class="py-4 px-6">
                                        <div class="flex items-center gap-3">
                                            <div class="w-8 h-8 bg-gray-200 rounded-full overflow-hidden border border-gray-100 shrink-0">
                                                <svg class="w-full h-full text-gray-400 p-0.5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
                                            </div>
                                            <span class="font-bold text-gray-900">Siti Aminah</span>
                                        </div>
                                    </td>
                                    <td class="py-4 px-6 text-gray-500">SMK Telkom Sidoarjo</td>
                                    <td class="py-4 px-6 text-center font-semibold">10</td>
                                    <td class="py-4 px-6">
                                        <div class="flex items-center justify-end gap-3">
                                            <div class="flex items-center gap-1.5 font-bold text-amber-800 bg-amber-500/5 px-2.5 py-1 rounded-lg text-xs border border-amber-600/10">
                                                <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path d="M5 4a2 2 0 012-2h6a2 2 0 012 2v14a2 2 0 01-2 2H7a2 2 0 01-2-2V4zm2-2a1 1 0 00-1 1v1h8V3a1 1 0 00-1-1H7z"></path></svg>
                                                2000
                                            </div>
                                            <svg class="w-4 h-4 text-gray-400 cursor-pointer hover:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                        </div>
                                    </td>
                                </tr>

                                <tr class="hover:bg-gray-50/50 transition">
                                    <td class="py-4 px-6 text-center text-xs font-bold text-gray-400">4</td>
                                    <td class="py-4 px-6">
                                        <div class="flex items-center gap-3">
                                            <div class="w-8 h-8 bg-gray-200 rounded-full overflow-hidden border border-gray-100 shrink-0">
                                                <svg class="w-full h-full text-gray-400 p-0.5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
                                            </div>
                                            <span class="font-semibold text-gray-900">Rizky Ramadhan</span>
                                        </div>
                                    </td>
                                    <td class="py-4 px-6 text-gray-500">SMK Telkom Sidoarjo</td>
                                    <td class="py-4 px-6 text-center font-semibold">9</td>
                                    <td class="py-4 px-6">
                                        <div class="flex items-center justify-end gap-3">
                                            <div class="flex items-center gap-1.5 font-semibold text-gray-600 bg-gray-50 px-2.5 py-1 rounded-lg text-xs border border-gray-200/50">
                                                <svg class="w-3.5 h-3.5 text-gray-400" fill="currentColor" viewBox="0 0 20 20"><path d="M5 4a2 2 0 012-2h6a2 2 0 012 2v14a2 2 0 01-2 2H7a2 2 0 01-2-2V4zm2-2a1 1 0 00-1 1v1h8V3a1 1 0 00-1-1H7z"></path></svg>
                                                2000
                                            </div>
                                            <svg class="w-4 h-4 text-gray-400 cursor-pointer hover:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                        </div>
                                    </td>
                                </tr>

                                <tr class="hover:bg-gray-50/50 transition">
                                    <td class="py-4 px-6 text-center text-xs font-bold text-gray-400">5</td>
                                    <td class="py-4 px-6">
                                        <div class="flex items-center gap-3">
                                            <div class="w-8 h-8 bg-gray-200 rounded-full overflow-hidden border border-gray-100 shrink-0">
                                                <svg class="w-full h-full text-gray-400 p-0.5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
                                            </div>
                                            <span class="font-semibold text-gray-900">Dewi Lestari</span>
                                        </div>
                                    </td>
                                    <td class="py-4 px-6 text-gray-500">SMK Telkom Sidoarjo</td>
                                    <td class="py-4 px-6 text-center font-semibold">3</td>
                                    <td class="py-4 px-6">
                                        <div class="flex items-center justify-end gap-3">
                                            <div class="flex items-center gap-1.5 font-semibold text-gray-600 bg-gray-50 px-2.5 py-1 rounded-lg text-xs border border-gray-200/50">
                                                <svg class="w-3.5 h-3.5 text-gray-400" fill="currentColor" viewBox="0 0 20 20"><path d="M5 4a2 2 0 012-2h6a2 2 0 012 2v14a2 2 0 01-2 2H7a2 2 0 01-2-2V4zm2-2a1 1 0 00-1 1v1h8V3a1 1 0 00-1-1H7z"></path></svg>
                                                2000
                                            </div>
                                            <svg class="w-4 h-4 text-gray-400 cursor-pointer hover:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                        </div>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </main>

</body>
</html>