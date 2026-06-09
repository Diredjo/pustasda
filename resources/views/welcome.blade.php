<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pustasda Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="bg-white flex h-screen overflow-hidden antialiased text-gray-800">

    <aside class="w-[260px] border-r border-gray-200 flex flex-col justify-between shrink-0 bg-white relative">
        <div>
            <div class="h-[72px] flex items-center px-6">
                <div class="flex items-center gap-2">
                    <svg class="w-6 h-6 text-gray-600" fill="currentColor" viewBox="0 0 24 24"><path d="M19 3H5v4.11l4.83 4.46V21h4.34v-9.43L19 7.11V3zm-2 3H7V5h10v1z"/></svg>
                    <span class="text-xl font-bold tracking-tight">Pustasda</span>
                </div>
            </div>

       <div class="px-4 mt-2">
    <div class="mb-6">
        <p class="px-3 text-[11px] font-semibold text-gray-400 mb-2">Halaman</p>
        
        <a href="{{ url('/') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-md font-medium text-sm mb-1 {{ request()->is('/') ? 'bg-gray-100 text-gray-800' : 'text-gray-400 hover:text-gray-700' }}">
            <svg class="w-5 h-5 {{ request()->is('/') ? 'text-gray-500' : '' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
            Beranda
        </a>

        <a href="{{ url('/pengaturan') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-md font-medium text-sm {{ request()->is('pengaturan') ? 'bg-gray-100 text-gray-800' : 'text-gray-400 hover:text-gray-700' }}">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
            Pengaturan
        </a>
    </div>

    <div>
        <p class="px-3 text-[11px] font-semibold text-gray-400 mb-2">Lomba</p>
        
        <a href="{{ url('/eksplor') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-md font-medium text-sm mb-1 {{ request()->is('eksplor') ? 'bg-gray-100 text-gray-800' : 'text-gray-400 hover:text-gray-700' }}">
            <svg class="w-5 h-5 {{ request()->is('eksplor') ? 'text-gray-500' : '' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 8v8m-4-5v5m-4-2v2m-2 4h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
            Eksplor
        </a>

        <a href="{{ url('/disimpan') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-md font-medium text-sm mb-1 {{ request()->is('disimpan') ? 'bg-gray-100 text-gray-800' : 'text-gray-400 hover:text-gray-700' }}">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"></path></svg>
            Disimpan
        </a>

        <a href="{{ url('/leaderboard') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-md font-medium text-sm {{ request()->is('leaderboard') ? 'bg-gray-100 text-gray-800' : 'text-gray-400 hover:text-gray-700' }}">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
            Leaderboard
        </a>
    </div>
</div>

        <div class="px-4 pb-6">
            <button class="w-full flex items-center justify-center gap-2 px-4 py-2.5 bg-[#FFE4E6] text-[#E11D48] rounded-md font-semibold text-sm hover:bg-rose-200 transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                Logout
            </button>
        </div>

        <div class="absolute -right-3 bottom-32 w-6 h-6 bg-white border border-gray-200 rounded flex items-center justify-center text-gray-400">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
        </div>
    </aside>

    <main class="flex-1 flex flex-col h-screen overflow-hidden relative">
        
        <header class="h-[72px] flex items-center justify-between px-8 border-b border-gray-200 shrink-0">
            <div class="flex h-full">
                <a href="#" class="flex items-center px-4 font-semibold text-sm text-[#E11D48] border-b-2 border-[#E11D48]">
                    Dashboard
                </a>
                <a href="#" class="flex items-center px-4 font-semibold text-sm text-gray-400 hover:text-gray-700">
                    Tentang
                </a>
            </div>
            
            <div class="flex items-center gap-6">
                <div class="w-40 h-8 bg-gray-200 rounded-sm"></div>
                <div class="font-semibold text-sm text-gray-800">
                    Profile
                </div>
            </div>
        </header>

        <div class="flex-1 overflow-y-auto px-10 py-8">
            
            <div class="max-w-[900px] w-full">
                <div class="relative w-full mb-8">
                    <div class="w-2/3 pr-8 relative z-10">
                        <p class="text-sm text-gray-400 mb-3">Pusat Prestasi SMK Telkom Sidoarjo</p>
                        <h1 class="text-[44px] font-extrabold text-gray-900 leading-[1.1] mb-5 tracking-tight">
                            Track Your <br>
                            <span class="text-[#E11D48]">Competitions.</span><br>
                            Build Your <br>
                            <span class="text-[#E11D48]">Achievements.</span>
                        </h1>
                        <p class="text-[13px] text-gray-600 mb-6 leading-relaxed max-w-sm">
                            Platform untuk mengelola lomba, prestasi, dan perkembangan siswa dalam satu sistem yang terintegrasi.
                        </p>
                        <button class="bg-[#E11D48] text-white px-5 py-2.5 rounded-md font-semibold text-sm hover:bg-rose-700 transition">
                            Eksplor Lomba &rarr;
                        </button>
                    </div>

                    <div class="absolute right-0 top-0 w-[300px] h-[300px] bg-[#E11D48] rounded-tl-[150px] rounded-bl-[150px] flex items-center justify-center -z-0">
                        <div class="text-white/50 text-sm font-medium">Aset Piala 3D</div>
                    </div>
                </div>

                <div class="relative flex gap-4 mb-4">
                    
                    <div class="w-1/2 bg-gradient-to-br from-[#FFD13B] to-[#FFC000] rounded-[14px] p-6 text-white relative overflow-hidden flex flex-col justify-between h-[180px]">
                        <h2 class="text-2xl font-bold leading-tight z-10 w-1/2">Lomba<br>Tingkat<br>Nasional</h2>
                        <button class="bg-white text-yellow-500 text-[13px] font-bold px-4 py-2 rounded-md w-max z-10 mt-2">
                            Jelajahi &rarr;
                        </button>
                        <div class="absolute right-0 bottom-0 w-32 h-32 bg-yellow-300/30 rounded-full flex items-center justify-center">
                            <span class="text-xs">Aset Bendera</span>
                        </div>
                    </div>

                    <div class="w-1/2 flex flex-col gap-4">
                        <div class="flex-1 bg-gradient-to-r from-[#14B8A6] to-[#06B6D4] rounded-[14px] p-5 text-white flex items-center justify-between relative overflow-hidden">
                            <h3 class="text-lg font-bold">Lomba Terbaru</h3>
                            <div class="w-12 h-12 bg-white/20 rounded-full flex items-center justify-center">
                                <span class="text-[10px]">Aset Jam</span>
                            </div>
                        </div>
                        <div class="flex-1 bg-gradient-to-r from-[#4ADE80] to-[#22C55E] rounded-[14px] p-5 text-white flex items-center justify-between relative overflow-hidden">
                            <h3 class="text-lg font-bold">Lomba Disekitar</h3>
                            <div class="w-12 h-12 bg-white/20 rounded-full flex items-center justify-center">
                                <span class="text-[10px]">Aset Jam</span>
                            </div>
                        </div>
                    </div>

                    <div class="absolute -right-6 -top-4 w-14 h-14 bg-[#DC2626] border-[3px] border-white rounded-full shadow-md flex items-center justify-center z-20 cursor-pointer">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>

                </div>

                <div class="w-full bg-gradient-to-r from-[#F43F5E] to-[#EF4444] rounded-[14px] p-5 mb-4 flex justify-between items-center text-white relative overflow-hidden">
                    <h3 class="text-xl font-bold">Sedang Ramai Diikuti</h3>
                    <div class="w-12 h-12 bg-white/20 rounded-full flex items-center justify-center">
                        <span class="text-[10px]">Aset Api</span>
                    </div>
                </div>

                <div class="w-full border border-gray-200 rounded-[14px] p-6 mb-4">
                    <h3 class="text-[16px] font-bold text-gray-900 mb-5 text-center">Prestasi Terbaru</h3>
                    <div class="space-y-4">
                        <div class="flex items-center gap-4 border border-gray-100 p-3 rounded-full shadow-sm">
                            <div class="w-8 h-8 bg-gray-200 rounded-full shrink-0"></div>
                            <p class="text-sm text-gray-500">lorem</p>
                        </div>
                        <div class="flex items-center gap-4 border border-gray-100 p-3 rounded-full shadow-sm">
                            <div class="w-8 h-8 bg-gray-200 rounded-full shrink-0"></div>
                            <p class="text-sm text-gray-500">lorem</p>
                        </div>
                    </div>
                </div>

                <div class="w-full border border-gray-200 rounded-[14px] p-6 flex justify-between items-center mb-10">
                    <div class="flex gap-4 items-center">
                        <div class="w-14 h-14 bg-[#6366F1] rounded-t-lg rounded-bl-lg relative shrink-0">
                             <div class="absolute bottom-0 w-full h-1/2 bg-[#4F46E5] rounded-bl-lg"></div>
                        </div>
                        <div>
                            <h3 class="text-[17px] font-bold text-gray-900 leading-none mb-1.5">Leaderboard Siswa Berprestasi</h3>
                            <p class="text-[13px] text-gray-500">Dihitung berdasarkan prestasi yang diraih</p>
                        </div>
                    </div>

                    <div class="relative min-w-[220px]">
                        <select class="block w-full bg-white border border-gray-200 text-gray-700 py-2.5 px-4 pr-8 rounded-md leading-tight focus:outline-none focus:ring-1 focus:ring-[#6366F1] focus:border-[#6366F1] text-[13px] font-medium appearance-none cursor-pointer shadow-sm hover:bg-gray-50 transition">
                            <option value="aktif_prestasi">Siswa Aktif & Berprestasi</option>
                            <option value="aktif">Siswa paling Aktif</option>
                            <option value="prestasi">Siswa paling berprestasi</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-gray-400">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/>
                            </svg>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </main>

</body>
</html>