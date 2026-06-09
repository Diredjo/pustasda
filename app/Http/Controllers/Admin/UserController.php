    <?php

    namespace App\Http\Controllers\Admin;

    use App\Http\Controllers\Controller;
    use App\Models\StudentProfile;
    use App\Models\TeacherProfile;
    use App\Models\User;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Hash;
    use Illuminate\Support\Facades\DB;

    class UserController extends Controller
    {
        public function index(Request $request)
        {
            $role = $request->get('role', 'student');
            $query = User::where('role', $role);

            if ($request->search) {
                $query->where(function ($q) use ($request) {
                    $q->where('name', 'like', '%' . $request->search . '%')
                        ->orWhere('email', 'like', '%' . $request->search . '%');
                });
            }

            if ($request->status !== null && $request->status !== '') {
                $query->where('is_active', $request->status);
            }

            if ($role === 'student') {
                $query->with('studentProfile');
            } else {
                $query->with('teacherProfile');
            }

            $users = $query->latest()->paginate(15)->withQueryString();

            return view('admin.users.index', compact('users', 'role'));
        }

        public function create(Request $request)
        {
            $role = $request->get('role', 'student');
            return view('admin.users.create', compact('role'));
        }

        public function store(Request $request)
        {
            $request->validate([
                'name' => 'required|string|max:100',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:6',
                'role' => 'required|in:student,teacher',
                'wa_number' => 'nullable|string|max:20',
                'nis' => 'nullable|string|max:20',
                'kelas' => 'nullable|string|max:20',
                'jurusan' => 'nullable|string|max:100',
                'angkatan' => 'nullable|integer|min:2000|max:2099',
                'nip' => 'nullable|string|max:30',
                'bidang_keahlian' => 'nullable|string|max:100',
                'jabatan' => 'nullable|string|max:100',
            ]);

            return DB::transaction(function () use ($request) {
                $user = User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'role' => $request->role,
                    'wa_number' => $request->wa_number,
                    'is_active' => true,
                ]);

                if ($request->role === 'student') {
                    StudentProfile::create([
                        'user_id' => $user->id,
                        'nis' => $request->nis,
                        'kelas' => $request->kelas,
                        'jurusan' => $request->jurusan,
                        'angkatan' => $request->angkatan ?? date('Y'),
                    ]);
                } else {
                    TeacherProfile::create([
                        'user_id' => $user->id,
                        'nip' => $request->nip,
                        'bidang_keahlian' => $request->bidang_keahlian,
                        'jabatan' => $request->jabatan,
                    ]);
                }

                return redirect()->route('admin.users.index', ['role' => $request->role])
                    ->with('success', 'User "' . $user->name . '" berhasil ditambahkan.');
        });
        }

        public function edit(User $user)
        {
            if ($user->role === 'student') {
                $user->load('studentProfile');
            } else {
                $user->load('teacherProfile');
            }
            return view('admin.users.edit', compact('user'));
        }

        public function update(Request $request, User $user)
        {
            $request->validate([
                'name' => 'required|string|max:100',
                'email' => 'required|email|unique:users,email,' . $user->id,
                'wa_number' => 'nullable|string|max:20',
                'password' => 'nullable|min:6',
                'nis' => 'nullable|string|max:20',
                'kelas' => 'nullable|string|max:20',
                'jurusan' => 'nullable|string|max:100',
                'angkatan' => 'nullable|integer',
                'nip' => 'nullable|string|max:30',
                'bidang_keahlian' => 'nullable|string|max:100',
                'jabatan' => 'nullable|string|max:100',
            ]);

            return DB::transaction(function () use ($request, $user) {
                $user->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'wa_number' => $request->wa_number,
                    'is_active' => $request->boolean('is_active', true),
                ]);

                if ($request->filled('password')) {
                    $user->update(['password' => Hash::make($request->password)]);
                }

                if ($user->role === 'student') {
                    StudentProfile::updateOrCreate(
                        ['user_id' => $user->id],
                        [
                            'nis' => $request->nis,
                            'kelas' => $request->kelas,
                            'jurusan' => $request->jurusan,
                            'angkatan' => $request->angkatan ?? date('Y'),
                        ]
                    );
                } else {
                    TeacherProfile::updateOrCreate(
                        ['user_id' => $user->id],
                        [
                            'nip' => $request->nip,
                            'bidang_keahlian' => $request->bidang_keahlian,
                            'jabatan' => $request->jabatan,
                        ]
                    );
                }

                return redirect()->route('admin.users.index', ['role' => $user->role])
                    ->with('success', 'Data user berhasil diperbarui.');
        });
        }

        public function destroy(User $user)
        {
            $name = $user->name;
            $role = $user->role;
            $user->delete();
            return redirect()->route('admin.users.index', ['role' => $role])
                ->with('success', 'User "' . $name . '" berhasil dihapus.');
        }

        public function toggleActive(User $user)
        {
            $user->update(['is_active' => !$user->is_active]);
            $status = $user->is_active ? 'diaktifkan' : 'dinonaktifkan';
            return back()->with('success', 'User "' . $user->name . '" berhasil ' . $status . '.');
        }

        // =====================
        // BULK BURST (mass create)
        // =====================

        private function parseBurstRows(Request $request): array
        {
            $role = $request->get('role');
            $rowsRaw = (string) $request->get('rows', '');

            $lines = preg_split('/\r\n|\r|\n/', trim($rowsRaw));
            $lines = array_values(array_filter($lines, fn($l) => trim($l) !== ''));

            $parsed = [];

            foreach ($lines as $lineIndex => $line) {
                $parts = preg_split('/,|\t/', $line);
                $parts = array_map(fn($v) => trim((string)$v), $parts);

                $item = [
                    'line' => $lineIndex + 1,
                    'errors' => [],
                ];

                if ($role === 'student') {
                    if (count($parts) < 7) {
                        $item['errors'][] = 'Kolom tidak lengkap untuk siswa. Min 7 kolom (Format: Nama, Email, Password, WA, Kelas, Jurusan, NIS).';
                    } else {
                        [$name, $email, $password, $wa_number, $kelas, $jurusan, $nis] = array_slice($parts, 0, 7);

                        $item['name'] = $name;
                        $item['email'] = $email;
                        $item['password'] = $password;
                        $item['wa_number'] = $wa_number;
                        $item['kelas'] = $kelas;
                        $item['jurusan'] = $jurusan;
                        $item['nis'] = $nis;
                        $item['angkatan'] = date('Y');

                        if ($name === '') $item['errors'][] = 'Nama wajib diisi.';
                        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $item['errors'][] = 'Format email tidak valid.';
                        if ($password === '' || strlen($password) < 6) $item['errors'][] = 'Password minimal 6 karakter.';
                    }
                } else {
                    if (count($parts) < 7) {
                        $item['errors'][] = 'Kolom tidak lengkap untuk guru. Min 7 kolom.';
                    } else {
                        [$name, $email, $password, $wa_number, $nip, $bidang_keahlian, $jabatan] = array_slice($parts, 0, 7);

                        $item['name'] = $name;
                        $item['email'] = $email;
                        $item['password'] = $password;
                        $item['wa_number'] = $wa_number;
                        $item['nip'] = $nip;
                        $item['bidang_keahlian'] = $bidang_keahlian;
                        $item['jabatan'] = $jabatan;

                        if ($name === '') $item['errors'][] = 'Nama wajib diisi.';
                        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $item['errors'][] = 'Format email tidak valid.';
                        if ($password === '' || strlen($password) < 6) $item['errors'][] = 'Password minimal 6 karakter.';
                    }
                }

                if (empty($item['errors']) && isset($item['email'])) {
                    if (User::where('email', $item['email'])->exists()) {
                        $item['errors'][] = 'Email sudah terdaftar di sistem.';
                    }
                }

                $parsed[] = $item;
            }

            return ['parsed' => $parsed, 'rowsRaw' => $rowsRaw];
        }

        public function burstCreate(Request $request)
        {
            $role = $request->get('role', 'student');
            abort_unless(in_array($role, ['student', 'teacher'], true), 404);
            return view('admin.users.bulk-create', compact('role'));
        }

        public function burstPreview(Request $request)
        {
            $request->validate([
                'role' => 'required|in:student,teacher',
                'rows' => 'required|string',
            ]);

            $data = $this->parseBurstRows($request);
            return view('admin.users.bulk-preview', [
                'role' => $request->role,
                'parsed' => $data['parsed'],
                'rowsRaw' => $data['rowsRaw'],
            ]);
        }

        public function burstStore(Request $request)
        {
            $request->validate([
                'role' => 'required|in:student,teacher',
                'rows' => 'required|string',
            ]);

            $data = $this->parseBurstRows($request);
            $parsed = $data['parsed'];

            $created = 0;
            $skipped = 0;

            foreach ($parsed as $item) {
                if (!empty($item['errors'])) {
                    $skipped++;
                    continue;
                }

                DB::transaction(function () use ($item, $request, &$created) {
                    $user = User::create([
                        'name' => $item['name'],
                        'email' => $item['email'],
                        'password' => Hash::make($item['password']),
                        'role' => $request->role,
                        'wa_number' => $item['wa_number'] ?? null,
                        'is_active' => true,
                    ]);

                    if ($request->role === 'student') {
                        StudentProfile::create([
                            'user_id' => $user->id,
                            'nis' => $item['nis'] ?? null,
                            'kelas' => $item['kelas'] ?? null,
                            'jurusan' => $item['jurusan'] ?? null,
                            'angkatan' => $item['angkatan'] ?? date('Y'),
                        ]);
                    } else {
                        TeacherProfile::create([
                            'user_id' => $user->id,
                            'nip' => $item['nip'] ?? null,
                            'bidang_keahlian' => $item['bidang_keahlian'] ?? null,
                            'jabatan' => $item['jabatan'] ?? null,
                        ]);
                    }

                    $created++;
            });
            }

            return redirect()->route('admin.users.index', ['role' => $request->role])
                ->with('success', "Burst selesai. Berhasil dibuat: {$created}, dilewati (gagal): {$skipped}.");
        }
    }