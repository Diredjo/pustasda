<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Disimpan - Pustasda</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
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
                    <a href="/" class="flex items-center gap-3 px-3 py-2.5 rounded-md font-medium text-sm mb-1 text-gray-400 hover:text-gray-700">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                        Beranda
                    </a>
                    <a href="/pengaturan" class="flex items-center gap-3 px-3 py-2.5 rounded-md font-medium text-sm text-gray-400 hover:text-gray-700">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        Pengaturan
                    </a>
                </div>

                <div>
                    <p class="px-3 text-[11px] font-semibold text-gray-400 mb-2">Lomba</p>
                    <a href="/eksplor" class="flex items-center gap-3 px-3 py-2.5 rounded-md font-medium text-sm mb-1 text-gray-400 hover:text-gray-700">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 8v8m-4-5v5m-4-2v2m-2 4h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        Eksplor
                    </a>
                    
                    <a href="/disimpan" class="flex items-center gap-3 px-3 py-2.5 rounded-md font-medium text-sm mb-1 bg-gray-100 text-gray-800">
                        <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"></path></svg>
                        Disimpan
                    </a>

                    <a href="/leaderboard" class="flex items-center gap-3 px-3 py-2.5 rounded-md font-medium text-sm text-gray-400 hover:text-gray-700">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                        Leaderboard
                    </a>
                </div>

            </div>
        </div>

        <div class="px-4 pb-6">
            <button class="w-full flex items-center justify-center gap-2 px-4 py-2.5 bg-[#FFE4E6] text-[#E11D48] rounded-md font-semibold text-sm hover:bg-rose-200 transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                Logout
            </button>
        </div>
    </aside>

    <main class="flex-1 flex flex-col h-screen overflow-hidden relative">
        
        <header class="h-[72px] flex items-center justify-between px-8 border-b border-gray-200 shrink-0">
            <div class="flex h-full">
                <a href="/disimpan" class="flex items-center px-4 font-semibold text-sm text-[#E11D48] border-b-2 border-[#E11D48]">
                    Lomba Tersimpan
                </a>
            </div>
            
            <div class="flex items-center gap-6">
                <div class="w-40 h-8 bg-gray-200 rounded-sm"></div>
                <div class="font-semibold text-sm text-gray-800">Profile</div>
            </div>
        </header>

        <div class="flex-1 overflow-y-auto px-10 py-8 bg-gray-50/50">
            <div class="max-w-[1000px] w-full">
                
                <div class="mb-8">
                    <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight mb-2">Disimpan</h1>
                    <p class="text-sm text-gray-500">Lomba dan kompetisi yang kamu tandai untuk diakses nanti.</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    
                    <div class="bg-white border border-gray-200 rounded-[14px] p-5 shadow-sm hover:shadow-md transition group">
                        <div class="flex justify-between items-start mb-4">
                            <div class="w-12 h-12 bg-blue-100 text-blue-600 rounded-xl flex items-center justify-center">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                            </div>
                            <button class="text-[#E11D48] hover:text-rose-700 transition">
                                <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24"><path d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"></path></svg>
                            </button>
                        </div>
                        <h3 class="font-bold text-gray-900 text-[17px] leading-tight mb-2 group-hover:text-[#E11D48] transition">Kompetisi Esai IUF</h3>
                        <p class="text-[13px] text-gray-500 mb-5 flex items-center gap-1.5">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            Pendaftaran ditutup 24 Nov
                        </p>
                        <button class="w-full py-2.5 bg-gray-50 hover:bg-gray-100 border border-gray-200 text-gray-700 font-semibold rounded-lg text-sm transition">Lihat Detail</button>
                    </div>

                    <div class="bg-white border border-gray-200 rounded-[14px] p-5 shadow-sm hover:shadow-md transition group">
                        <div class="flex justify-between items-start mb-4">
                            <div class="w-12 h-12 bg-purple-100 text-purple-600 rounded-xl flex items-center justify-center">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path></svg>
                            </div>
                            <button class="text-[#E11D48] hover:text-rose-700 transition">
                                <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24"><path d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"></path></svg>
                            </button>
                        </div>
                        <h3 class="font-bold text-gray-900 text-[17px] leading-tight mb-2 group-hover:text-[#E11D48] transition">BPC Genethic</h3>
                        <p class="text-[13px] text-gray-500 mb-5 flex items-center gap-1.5">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                            Tingkat Nasional
                        </p>
                        <button class="w-full py-2.5 bg-gray-50 hover:bg-gray-100 border border-gray-200 text-gray-700 font-semibold rounded-lg text-sm transition">Lihat Detail</button>
                    </div>

                    <div class="bg-white border border-gray-200 rounded-[14px] p-5 shadow-sm hover:shadow-md transition group">
                        <div class="flex justify-between items-start mb-4">
                            <div class="w-12 h-12 bg-green-100 text-green-600 rounded-xl flex items-center justify-center">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                            </div>
                            <button class="text-[#E11D48] hover:text-rose-700 transition">
                                <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24"><path d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"></path></svg>
                            </button>
                        </div>
                        <h3 class="font-bold text-gray-900 text-[17px] leading-tight mb-2 group-hover:text-[#E11D48] transition">Gebyar Istaz 2026</h3>
                        <p class="text-[13px] text-gray-500 mb-5 flex items-center gap-1.5">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                            Lomba Beregu
                        </p>
                        <button class="w-full py-2.5 bg-gray-50 hover:bg-gray-100 border border-gray-200 text-gray-700 font-semibold rounded-lg text-sm transition">Lihat Detail</button>
                    </div>

                </div>

            </div>
        </div>
    </main>

</body>
</html>