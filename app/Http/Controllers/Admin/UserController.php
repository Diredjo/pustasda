<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\StudentProfile;
use App\Models\TeacherProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
            // Student fields
            'nis' => 'nullable|string|max:20',
            'kelas' => 'nullable|string|max:20',
            'jurusan' => 'nullable|string|max:100',
            'angkatan' => 'nullable|integer|min:2000|max:2099',
            // Teacher fields
            'nip' => 'nullable|string|max:30',
            'bidang_keahlian' => 'nullable|string|max:100',
            'jabatan' => 'nullable|string|max:100',
        ]);

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
                'angkatan' => $request->angkatan,
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
                    'angkatan' => $request->angkatan,
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
}