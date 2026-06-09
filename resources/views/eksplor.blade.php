<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pustasda - Eksplor Lomba</title>
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
    </aside>

    <main class="flex-1 flex flex-col h-screen overflow-hidden relative bg-[#F8FAFC]">
        
        <header class="h-[72px] flex items-center justify-between px-8 border-b border-gray-200 shrink-0 bg-white">
            <div class="flex h-full">
                <a href="#" class="flex items-center px-4 font-semibold text-sm text-gray-400 hover:text-gray-700">
                    Dashboard
                </a>
                <a href="#" class="flex items-center px-4 font-semibold text-sm text-[#E11D48] border-b-2 border-[#E11D48]">
                    Eksplor
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
            <div class="max-w-[1000px] w-full mx-auto">
                
                <div class="mb-8">
                    <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight mb-2">Temukan Kompetisimu.</h1>
                    <p class="text-sm text-gray-500">Jelajahi ratusan perlombaan akademik dan non-akademik di seluruh Indonesia.</p>
                </div>

                <div class="flex flex-col md:flex-row gap-4 mb-8">
                    <div class="relative flex-1">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </div>
                        <input type="text" class="block w-full pl-10 pr-3 py-3 border border-gray-200 rounded-lg text-sm placeholder-gray-400 focus:outline-none focus:border-[#E11D48] focus:ring-1 focus:ring-[#E11D48] shadow-sm bg-white" placeholder="Cari nama lomba, penyelenggara, atau kata kunci...">
                    </div>
                    
                    <div class="flex gap-4">
                        <select class="border border-gray-200 text-gray-600 text-sm rounded-lg block p-3 bg-white focus:outline-none focus:border-[#E11D48] cursor-pointer shadow-sm min-w-[140px]">
                            <option selected>Tingkat</option>
                            <option value="nasional">Nasional</option>
                            <option value="provinsi">Provinsi</option>
                            <option value="kabupaten">Kabupaten/Kota</option>
                        </select>
                        <select class="border border-gray-200 text-gray-600 text-sm rounded-lg block p-3 bg-white focus:outline-none focus:border-[#E11D48] cursor-pointer shadow-sm min-w-[140px]">
                            <option selected>Status</option>
                            <option value="buka">Pendaftaran Buka</option>
                            <option value="segera_tutup">Segera Tutup</option>
                        </select>
                    </div>
                </div>

                <div class="flex gap-2 mb-8 overflow-x-auto pb-2 scrollbar-hide">
                    <button class="px-5 py-2 rounded-full bg-[#E11D48] text-white text-sm font-medium whitespace-nowrap shadow-sm">Semua Lomba</button>
                    <button class="px-5 py-2 rounded-full bg-white border border-gray-200 text-gray-600 hover:bg-gray-50 text-sm font-medium whitespace-nowrap shadow-sm transition">Data Science</button>
                    <button class="px-5 py-2 rounded-full bg-white border border-gray-200 text-gray-600 hover:bg-gray-50 text-sm font-medium whitespace-nowrap shadow-sm transition">Web Development</button>
                    <button class="px-5 py-2 rounded-full bg-white border border-gray-200 text-gray-600 hover:bg-gray-50 text-sm font-medium whitespace-nowrap shadow-sm transition">Sastra & Esai</button>
                    <button class="px-5 py-2 rounded-full bg-white border border-gray-200 text-gray-600 hover:bg-gray-50 text-sm font-medium whitespace-nowrap shadow-sm transition">Desain UI/UX</button>
                    <button class="px-5 py-2 rounded-full bg-white border border-gray-200 text-gray-600 hover:bg-gray-50 text-sm font-medium whitespace-nowrap shadow-sm transition">Olahraga</button>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-10">
                    
                    <div class="bg-white rounded-[14px] border border-gray-200 overflow-hidden shadow-sm hover:shadow-md transition-shadow group flex flex-col h-full">
                        <div class="h-32 bg-gradient-to-r from-blue-500 to-cyan-400 relative">
                            <div class="absolute inset-0 flex items-center justify-center text-white/50 text-xs font-medium">Banner Kompetisi</div>
                            <div class="absolute top-3 left-3 bg-white/90 backdrop-blur-sm text-gray-800 text-[10px] font-bold px-2.5 py-1 rounded-md uppercase tracking-wide">Nasional</div>
                        </div>
                        <div class="p-5 flex flex-col flex-1">
                            <div class="flex gap-2 mb-3">
                                <span class="bg-blue-50 text-blue-600 text-[11px] font-semibold px-2 py-0.5 rounded">Machine Learning</span>
                            </div>
                            <h3 class="text-[16px] font-bold text-gray-900 mb-1 leading-snug group-hover:text-blue-600 transition-colors">Titanic Dataset Analysis Challenge</h3>
                            <p class="text-[13px] text-gray-500 mb-4 line-clamp-2">Kompetisi klasifikasi dataset untuk memprediksi probabilitas keselamatan berbasis model prediktif.</p>
                            
                            <div class="mt-auto flex items-center justify-between border-t border-gray-100 pt-4">
                                <div class="flex items-center text-gray-400 text-xs gap-1.5">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    <span>Tutup: 24 Nov</span>
                                </div>
                                <button class="text-[#E11D48] text-[13px] font-semibold hover:text-rose-700">Detail &rarr;</button>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-[14px] border border-gray-200 overflow-hidden shadow-sm hover:shadow-md transition-shadow group flex flex-col h-full">
                        <div class="h-32 bg-gradient-to-r from-purple-500 to-indigo-500 relative">
                            <div class="absolute inset-0 flex items-center justify-center text-white/50 text-xs font-medium">Banner Kompetisi</div>
                            <div class="absolute top-3 left-3 bg-white/90 backdrop-blur-sm text-gray-800 text-[10px] font-bold px-2.5 py-1 rounded-md uppercase tracking-wide">Provinsi</div>
                        </div>
                        <div class="p-5 flex flex-col flex-1">
                            <div class="flex gap-2 mb-3">
                                <span class="bg-purple-50 text-purple-600 text-[11px] font-semibold px-2 py-0.5 rounded">Web App</span>
                                <span class="bg-gray-100 text-gray-600 text-[11px] font-semibold px-2 py-0.5 rounded">Next.js</span>
                            </div>
                            <h3 class="text-[16px] font-bold text-gray-900 mb-1 leading-snug group-hover:text-purple-600 transition-colors">Hackathon Front-End Jawa Timur</h3>
                            <p class="text-[13px] text-gray-500 mb-4 line-clamp-2">Bangun antarmuka aplikasi publik yang interaktif dan responsif menggunakan framework modern.</p>
                            
                            <div class="mt-auto flex items-center justify-between border-t border-gray-100 pt-4">
                                <div class="flex items-center text-gray-400 text-xs gap-1.5">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    <span>Tutup: 12 Des</span>
                                </div>
                                <button class="text-[#E11D48] text-[13px] font-semibold hover:text-rose-700">Detail &rarr;</button>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-[14px] border border-gray-200 overflow-hidden shadow-sm hover:shadow-md transition-shadow group flex flex-col h-full">
                        <div class="h-32 bg-gradient-to-r from-amber-400 to-orange-500 relative">
                            <div class="absolute inset-0 flex items-center justify-center text-white/50 text-xs font-medium">Banner Kompetisi</div>
                            <div class="absolute top-3 left-3 bg-[#E11D48] text-white text-[10px] font-bold px-2.5 py-1 rounded-md uppercase tracking-wide">Hot</div>
                            <div class="absolute top-3 left-14 bg-white/90 backdrop-blur-sm text-gray-800 text-[10px] font-bold px-2.5 py-1 rounded-md uppercase tracking-wide">Nasional</div>
                        </div>
                        <div class="p-5 flex flex-col flex-1">
                            <div class="flex gap-2 mb-3">
                                <span class="bg-orange-50 text-orange-600 text-[11px] font-semibold px-2 py-0.5 rounded">Karya Tulis</span>
                            </div>
                            <h3 class="text-[16px] font-bold text-gray-900 mb-1 leading-snug group-hover:text-orange-600 transition-colors">Kompetisi Esai Nasional Mahasiswa & Pelajar</h3>
                            <p class="text-[13px] text-gray-500 mb-4 line-clamp-2">Lomba karya tulis bertema peran teknologi dalam dunia edukasi pasca pandemi.</p>
                            
                            <div class="mt-auto flex items-center justify-between border-t border-gray-100 pt-4">
                                <div class="flex items-center text-red-500 font-medium text-xs gap-1.5">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    <span>Tutup Besok</span>
                                </div>
                                <button class="text-[#E11D48] text-[13px] font-semibold hover:text-rose-700">Detail &rarr;</button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </main>

</body>
</html>