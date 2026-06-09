<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pustasda - Pengaturan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        [x-cloak] { display: none !important; }
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
                    Pengaturan
                </a>
            </div>
            
            <div class="flex items-center gap-6">
                <div class="w-40 h-8 bg-gray-200 rounded-sm"></div>
                <div class="font-semibold text-sm text-gray-800">
                    Profile
                </div>
            </div>
        </header>

        <div class="flex-1 overflow-y-auto px-10 py-8" x-data="{ activeTab: 'profil' }">
            <div class="max-w-[1000px] w-full mx-auto">
                
                <div class="mb-8">
                    <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight mb-2">Pengaturan Akun.</h1>
                    <p class="text-sm text-gray-500">Kelola informasi pribadi, preferensi, keamanan, dan integrasi akun Anda.</p>
                </div>

                <div class="flex flex-col lg:flex-row gap-8">
                    <!-- Navigasi Pengaturan Kiri (Tabs) -->
                    <div class="w-full lg:w-64 shrink-0">
                        <nav class="flex lg:flex-col gap-2 overflow-x-auto lg:overflow-visible pb-2 lg:pb-0 scrollbar-hide">
                            <button @click="activeTab = 'profil'" :class="activeTab === 'profil' ? 'bg-white border-gray-200 shadow-sm text-gray-900 font-semibold' : 'border-transparent text-gray-500 hover:bg-gray-100 font-medium'" class="flex items-center gap-3 px-4 py-3 rounded-lg border text-sm w-full text-left transition whitespace-nowrap">
                                <svg class="w-5 h-5" :class="activeTab === 'profil' ? 'text-[#E11D48]' : 'text-gray-400'" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                Profil Publik
                            </button>
                            <button @click="activeTab = 'notifikasi'" :class="activeTab === 'notifikasi' ? 'bg-white border-gray-200 shadow-sm text-gray-900 font-semibold' : 'border-transparent text-gray-500 hover:bg-gray-100 font-medium'" class="flex items-center gap-3 px-4 py-3 rounded-lg border text-sm w-full text-left transition whitespace-nowrap">
                                <svg class="w-5 h-5" :class="activeTab === 'notifikasi' ? 'text-[#E11D48]' : 'text-gray-400'" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                                Notifikasi
                            </button>
                            <button @click="activeTab = 'keamanan'" :class="activeTab === 'keamanan' ? 'bg-white border-gray-200 shadow-sm text-gray-900 font-semibold' : 'border-transparent text-gray-500 hover:bg-gray-100 font-medium'" class="flex items-center gap-3 px-4 py-3 rounded-lg border text-sm w-full text-left transition whitespace-nowrap">
                                <svg class="w-5 h-5" :class="activeTab === 'keamanan' ? 'text-[#E11D48]' : 'text-gray-400'" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                                Keamanan Akun
                            </button>
                            <button @click="activeTab = 'integrasi'" :class="activeTab === 'integrasi' ? 'bg-white border-gray-200 shadow-sm text-gray-900 font-semibold' : 'border-transparent text-gray-500 hover:bg-gray-100 font-medium'" class="flex items-center gap-3 px-4 py-3 rounded-lg border text-sm w-full text-left transition whitespace-nowrap">
                                <svg class="w-5 h-5" :class="activeTab === 'integrasi' ? 'text-[#E11D48]' : 'text-gray-400'" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                                Integrasi
                            </button>
                        </nav>
                    </div>

                    <!-- Area Konten -->
                    <div class="flex-1 pb-10">
                        
                        <!-- ========================= -->
                        <!-- TAB PROFIL PUBLIK -->
                        <!-- ========================= -->
                        <div x-show="activeTab === 'profil'" class="space-y-6 transition-all">
                            <!-- Card Foto & Info -->
                            <div class="bg-white rounded-[14px] border border-gray-200 shadow-sm overflow-hidden">
                                <div class="p-6">
                                    <h2 class="text-lg font-bold text-gray-900 mb-6">Informasi Dasar</h2>
                                    
                                    <div class="flex flex-col sm:flex-row items-start sm:items-center gap-6 mb-8">
                                        <div class="relative">
                                            <div class="w-24 h-24 rounded-full bg-gradient-to-tr from-rose-400 to-[#E11D48] flex items-center justify-center text-white text-3xl font-bold shadow-md">
                                                JD
                                            </div>
                                            <button class="absolute bottom-0 right-0 w-8 h-8 bg-white border border-gray-200 rounded-full flex items-center justify-center text-gray-600 hover:text-[#E11D48] shadow-sm transition">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                            </button>
                                        </div>
                                        <div>
                                            <div class="flex gap-3 mb-2">
                                                <button class="px-4 py-2 bg-white border border-gray-200 rounded-md text-sm font-semibold text-gray-700 hover:bg-gray-50 transition shadow-sm">Unggah Baru</button>
                                                <button class="px-4 py-2 bg-gray-50 border border-transparent rounded-md text-sm font-semibold text-gray-500 hover:text-red-600 hover:bg-red-50 transition">Hapus</button>
                                            </div>
                                            <p class="text-[13px] text-gray-500">Direkomendasikan foto persegi minimal 500x500px, maksimal 2MB (JPG atau PNG).</p>
                                        </div>
                                    </div>

                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                        <div>
                                            <label class="block text-[13px] font-semibold text-gray-700 mb-1.5">Nama Depan</label>
                                            <input type="text" value="John" class="w-full px-4 py-2.5 border border-gray-200 rounded-lg text-sm text-gray-800 bg-gray-50 focus:bg-white focus:outline-none focus:border-[#E11D48] focus:ring-1 focus:ring-[#E11D48] transition">
                                        </div>
                                        <div>
                                            <label class="block text-[13px] font-semibold text-gray-700 mb-1.5">Nama Belakang</label>
                                            <input type="text" value="Doe" class="w-full px-4 py-2.5 border border-gray-200 rounded-lg text-sm text-gray-800 bg-gray-50 focus:bg-white focus:outline-none focus:border-[#E11D48] focus:ring-1 focus:ring-[#E11D48] transition">
                                        </div>
                                        <div class="md:col-span-2">
                                            <label class="block text-[13px] font-semibold text-gray-700 mb-1.5">Alamat Email</label>
                                            <div class="relative">
                                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                    <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path></svg>
                                                </div>
                                                <input type="email" value="john.doe@example.com" class="w-full pl-9 pr-4 py-2.5 border border-gray-200 rounded-lg text-sm text-gray-800 bg-gray-50 focus:bg-white focus:outline-none focus:border-[#E11D48] focus:ring-1 focus:ring-[#E11D48] transition">
                                            </div>
                                        </div>
                                        <div class="md:col-span-2">
                                            <label class="block text-[13px] font-semibold text-gray-700 mb-1.5">Bio Singkat</label>
                                            <textarea rows="4" class="w-full px-4 py-2.5 border border-gray-200 rounded-lg text-sm text-gray-800 bg-gray-50 focus:bg-white focus:outline-none focus:border-[#E11D48] focus:ring-1 focus:ring-[#E11D48] transition" placeholder="Ceritakan sedikit tentang keahlian atau minat Anda pada perlombaan..."></textarea>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="bg-gray-50 px-6 py-4 border-t border-gray-200 flex justify-end gap-3">
                                    <button class="px-5 py-2.5 bg-[#E11D48] text-white rounded-lg text-sm font-semibold hover:bg-rose-700 transition shadow-sm">Simpan Profil</button>
                                </div>
                            </div>

                            <!-- Preferensi Visual Card -->
                            <div class="bg-white rounded-[14px] border border-gray-200 shadow-sm overflow-hidden">
                                <div class="p-6">
                                    <h2 class="text-lg font-bold text-gray-900 mb-1">Preferensi Tampilan</h2>
                                    <p class="text-sm text-gray-500 mb-6">Sesuaikan tampilan visual aplikasi Pustasda di perangkat ini.</p>
                                    
                                    <div class="flex gap-5">
                                        <label class="flex flex-col items-start gap-3 cursor-pointer group">
                                            <div class="w-36 h-24 rounded-xl border-2 border-[#E11D48] p-1.5 transition">
                                                <div class="w-full h-full bg-gray-50 rounded-lg shadow-sm border border-gray-200 flex flex-col gap-1.5 p-2 overflow-hidden">
                                                    <div class="flex gap-1.5">
                                                        <div class="w-4 h-full bg-gray-200 rounded-sm"></div>
                                                        <div class="flex-1 flex flex-col gap-1.5">
                                                            <div class="w-full h-2 bg-gray-200 rounded-sm"></div>
                                                            <div class="w-2/3 h-2 bg-gray-200 rounded-sm"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="flex items-center gap-2">
                                                <div class="w-4 h-4 rounded-full border-4 border-[#E11D48] bg-white"></div>
                                                <span class="text-sm font-semibold text-gray-900">Terang (Default)</span>
                                            </div>
                                        </label>
                                        
                                        <label class="flex flex-col items-start gap-3 cursor-pointer group">
                                            <div class="w-36 h-24 rounded-xl border-2 border-transparent group-hover:border-gray-300 p-1.5 transition">
                                                <div class="w-full h-full bg-gray-900 rounded-lg shadow-sm border border-gray-700 flex flex-col gap-1.5 p-2 overflow-hidden">
                                                    <div class="flex gap-1.5">
                                                        <div class="w-4 h-full bg-gray-700 rounded-sm"></div>
                                                        <div class="flex-1 flex flex-col gap-1.5">
                                                            <div class="w-full h-2 bg-gray-700 rounded-sm"></div>
                                                            <div class="w-2/3 h-2 bg-gray-700 rounded-sm"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="flex items-center gap-2">
                                                <div class="w-4 h-4 rounded-full border border-gray-300 bg-white"></div>
                                                <span class="text-sm font-medium text-gray-500">Gelap</span>
                                            </div>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- ========================= -->
                        <!-- TAB NOTIFIKASI -->
                        <!-- ========================= -->
                        <div x-show="activeTab === 'notifikasi'" x-cloak class="space-y-6 transition-all">
                            <div class="bg-white rounded-[14px] border border-gray-200 shadow-sm overflow-hidden">
                                <div class="p-6">
                                    <h2 class="text-lg font-bold text-gray-900 mb-1">Notifikasi Email</h2>
                                    <p class="text-sm text-gray-500 mb-6">Pilih email apa saja yang ingin Anda terima dari kami.</p>
                                    
                                    <div class="space-y-4">
                                        <!-- Item 1 -->
                                        <div class="flex items-center justify-between py-4 border-b border-gray-100">
                                            <div class="pr-6">
                                                <h3 class="text-[14px] font-semibold text-gray-900">Berita & Pengumuman</h3>
                                                <p class="text-[13px] text-gray-500 mt-1">Dapatkan pembaruan terbaru terkait fitur aplikasi dan pengumuman platform.</p>
                                            </div>
                                            <label class="relative inline-flex items-center cursor-pointer shrink-0">
                                                <input type="checkbox" value="" class="sr-only peer" checked>
                                                <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-[#E11D48]"></div>
                                            </label>
                                        </div>
                                        <!-- Item 2 -->
                                        <div class="flex items-center justify-between py-4 border-b border-gray-100">
                                            <div class="pr-6">
                                                <h3 class="text-[14px] font-semibold text-gray-900">Rekomendasi Lomba Baru</h3>
                                                <p class="text-[13px] text-gray-500 mt-1">Kami akan memberi tahu Anda jika ada lomba baru yang sesuai dengan minat Anda.</p>
                                            </div>
                                            <label class="relative inline-flex items-center cursor-pointer shrink-0">
                                                <input type="checkbox" value="" class="sr-only peer" checked>
                                                <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-[#E11D48]"></div>
                                            </label>
                                        </div>
                                        <!-- Item 3 -->
                                        <div class="flex items-center justify-between py-4">
                                            <div class="pr-6">
                                                <h3 class="text-[14px] font-semibold text-gray-900">Peringatan Deadline</h3>
                                            <p class="text-[13px] text-gray-500 mt-1">Dapatkan pengingat H-3 sebelum penutupan lomba yang Anda simpan.</p>
                                            </div>
                                            <label class="relative inline-flex items-center cursor-pointer shrink-0">
                                                <input type="checkbox" value="" class="sr-only peer">
                                                <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-[#E11D48]"></div>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- ========================= -->
                        <!-- TAB KEAMANAN AKUN -->
                        <!-- ========================= -->
                        <div x-show="activeTab === 'keamanan'" x-cloak class="space-y-6 transition-all">
                            <!-- Ganti Kata Sandi -->
                            <div class="bg-white rounded-[14px] border border-gray-200 shadow-sm overflow-hidden">
                                <div class="p-6">
                                    <h2 class="text-lg font-bold text-gray-900 mb-1">Ganti Kata Sandi</h2>
                                    <p class="text-sm text-gray-500 mb-6">Pastikan akun Anda menggunakan kata sandi yang panjang dan acak untuk tetap aman.</p>
                                    
                                    <div class="space-y-4 max-w-lg">
                                        <div>
                                            <label class="block text-[13px] font-semibold text-gray-700 mb-1.5">Kata Sandi Saat Ini</label>
                                            <input type="password" class="w-full px-4 py-2.5 border border-gray-200 rounded-lg text-sm text-gray-800 bg-gray-50 focus:bg-white focus:outline-none focus:border-[#E11D48] focus:ring-1 focus:ring-[#E11D48] transition">
                                        </div>
                                        <div>
                                            <label class="block text-[13px] font-semibold text-gray-700 mb-1.5">Kata Sandi Baru</label>
                                            <input type="password" class="w-full px-4 py-2.5 border border-gray-200 rounded-lg text-sm text-gray-800 bg-gray-50 focus:bg-white focus:outline-none focus:border-[#E11D48] focus:ring-1 focus:ring-[#E11D48] transition">
                                        </div>
                                        <div>
                                            <label class="block text-[13px] font-semibold text-gray-700 mb-1.5">Konfirmasi Kata Sandi Baru</label>
                                            <input type="password" class="w-full px-4 py-2.5 border border-gray-200 rounded-lg text-sm text-gray-800 bg-gray-50 focus:bg-white focus:outline-none focus:border-[#E11D48] focus:ring-1 focus:ring-[#E11D48] transition">
                                        </div>
                                        <div class="pt-2">
                                            <button class="px-5 py-2.5 bg-gray-900 text-white rounded-lg text-sm font-semibold hover:bg-gray-800 transition shadow-sm">Perbarui Kata Sandi</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Autentikasi Dua Langkah -->
                            <div class="bg-white rounded-[14px] border border-gray-200 shadow-sm overflow-hidden">
                                <div class="p-6">
                                    <div class="flex items-start justify-between">
                                        <div>
                                            <h2 class="text-lg font-bold text-gray-900 mb-1">Autentikasi Dua Langkah (2FA)</h2>
                                            <p class="text-sm text-gray-500 mb-4">Tambahkan lapisan keamanan ekstra ke akun Anda. Setelah diaktifkan, Anda akan diminta memasukkan kode unik dari aplikasi authenticator setiap kali login.</p>
                                        </div>
                                        <div class="bg-red-50 text-red-600 text-xs font-bold px-2.5 py-1 rounded-md uppercase tracking-wide">Mati</div>
                                    </div>
                                    <button class="px-5 py-2.5 bg-white border border-gray-300 text-gray-700 rounded-lg text-sm font-semibold hover:bg-gray-50 transition shadow-sm">Aktifkan 2FA</button>
                                </div>
                            </div>

                            <!-- Danger Zone -->
                            <div class="bg-white rounded-[14px] border border-red-200 shadow-sm overflow-hidden">
                                <div class="p-6">
                                    <h2 class="text-lg font-bold text-red-600 mb-1">Zona Berbahaya</h2>
                                    <p class="text-sm text-gray-500 mb-4">Aksi di bawah ini tidak dapat diurungkan. Pastikan Anda mengerti sebelum melanjutkan.</p>
                                    
                                    <div class="flex items-center justify-between border-t border-gray-100 pt-5">
                                        <div>
                                            <h3 class="text-sm font-bold text-gray-900">Hapus Akun Permanen</h3>
                                            <p class="text-xs text-gray-500 mt-0.5">Semua data profil, lomba yang disimpan, dan riwayat akan hilang selamanya.</p>
                                        </div>
                                        <button class="px-4 py-2 bg-white border border-red-200 text-red-600 rounded-lg text-sm font-semibold hover:bg-red-50 hover:border-red-300 transition shadow-sm whitespace-nowrap ml-4">Hapus Akun</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- ========================= -->
                        <!-- TAB INTEGRASI -->
                        <!-- ========================= -->
                        <div x-show="activeTab === 'integrasi'" x-cloak class="space-y-6 transition-all">
                            <div class="bg-white rounded-[14px] border border-gray-200 shadow-sm overflow-hidden">
                                <div class="p-6">
                                    <h2 class="text-lg font-bold text-gray-900 mb-1">Akun Terhubung</h2>
                                    <p class="text-sm text-gray-500 mb-6">Hubungkan akun Anda dengan layanan pihak ketiga untuk mempermudah login dan sinkronisasi.</p>
                                    
                                    <div class="space-y-4">
                                        <!-- Google -->
                                        <div class="flex items-center justify-between py-4 border-b border-gray-100">
                                            <div class="flex items-center gap-4">
                                                <div class="w-10 h-10 rounded-full bg-gray-50 border border-gray-200 flex items-center justify-center p-2">
                                                    <svg viewBox="0 0 24 24" class="w-full h-full"><path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/><path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/><path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/><path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/></svg>
                                                </div>
                                                <div>
                                                    <h3 class="text-[14px] font-semibold text-gray-900">Google</h3>
                                                    <p class="text-[13px] text-green-600 font-medium mt-0.5">Terhubung</p>
                                                </div>
                                            </div>
                                            <button class="text-sm font-semibold text-gray-500 hover:text-red-600 transition">Putuskan</button>
                                        </div>
                                        
                                        <!-- GitHub -->
                                        <div class="flex items-center justify-between py-4 border-b border-gray-100">
                                            <div class="flex items-center gap-4">
                                                <div class="w-10 h-10 rounded-full bg-gray-50 border border-gray-200 flex items-center justify-center p-2">
                                                    <svg viewBox="0 0 24 24" class="w-full h-full text-gray-900" fill="currentColor"><path d="M12 .297c-6.63 0-12 5.373-12 12 0 5.303 3.438 9.8 8.205 11.385.6.113.82-.258.82-.577 0-.285-.01-1.04-.015-2.04-3.338.724-4.042-1.61-4.042-1.61C4.422 18.07 3.633 17.7 3.633 17.7c-1.087-.744.084-.729.084-.729 1.205.084 1.838 1.236 1.838 1.236 1.07 1.835 2.809 1.305 3.495.998.108-.776.417-1.305.76-1.605-2.665-.3-5.466-1.332-5.466-5.93 0-1.31.465-2.38 1.235-3.22-.135-.303-.54-1.523.105-3.176 0 0 1.005-.322 3.3 1.23.96-.267 1.98-.399 3-.405 1.02.006 2.04.138 3 .405 2.28-1.552 3.285-1.23 3.285-1.23.645 1.653.24 2.873.12 3.176.765.84 1.23 1.91 1.23 3.22 0 4.61-2.805 5.625-5.475 5.92.42.36.81 1.096.81 2.22 0 1.606-.015 2.896-.015 3.286 0 .315.21.69.825.57C20.565 22.092 24 17.592 24 12.297c0-6.627-5.373-12-12-12"/></svg>
                                                </div>
                                                <div>
                                                    <h3 class="text-[14px] font-semibold text-gray-900">GitHub</h3>
                                                    <p class="text-[13px] text-gray-500 mt-0.5">Belum terhubung</p>
                                                </div>
                                            </div>
                                            <button class="px-4 py-1.5 bg-white border border-gray-300 text-gray-700 rounded-lg text-sm font-semibold hover:bg-gray-50 transition shadow-sm">Hubungkan</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                
            </div>
        </div>
    </main>

</body>
</html>
