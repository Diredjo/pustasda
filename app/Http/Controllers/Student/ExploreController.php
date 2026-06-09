<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Competition;
use App\Models\Category;
use App\Models\Field;
use App\Models\CompetitionSave;
use App\Models\SaveFolder;
use Illuminate\Http\Request;

class ExploreController extends Controller
{
    /**
     * Menampilkan daftar eksplorasi lomba dengan filter, pencarian,
     * dan fitur auto-select detail panel kanan.
     */
    public function index(Request $request)
    {
        // 1. Inisialisasi query dasar beserta relasi utama (Eager Loading)
        $query = Competition::with(['category', 'field', 'creator'])
            ->where('is_active', true)
            ->whereDate('deadline', '>=', now());

        // 2. Jalankan filter pencarian teks
        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        // 3. Jalankan filter dropdown spesifik
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }
        if ($request->filled('field')) {
            $query->where('field_id', $request->field);
        }
        if ($request->filled('level')) {
            $query->where('level', $request->level);
        }
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        // 4. Kondisional sorting berdasarkan tab filter aktif
        switch ($request->filter) {
            case 'trending':
                $query->where('is_trending', true)->orderByDesc('view_count');
                break;
            case 'nasional':
                $query->where('level', 'nasional')->latest();
                break;
            case 'deadline':
                $query->whereDate('deadline', '<=', now()->addDays(7))
                    ->orderBy('deadline', 'asc');
                break;
            case 'terbaru':
                $query->latest();
                break;
            default:
                $query->orderByDesc('view_count')->latest();
                break;
        }

        // Ambil data hasil filter untuk list kiri
        $competitions = $query->get();

        // 5. Menentukan item lomba yang aktif di panel detail kanan
        $firstComp = $competitions->first();

        // JIKA ADA PARAMETER ?selected=ID DARI DASHBOARD ATAU LINK LAIN
        if ($request->filled('selected')) {
            $selectedComp = Competition::with(['category', 'field', 'stages', 'creator'])
                ->find($request->selected);

            // Pastikan data lomba yang dipilih itu valid
            if ($selectedComp && $selectedComp->is_active) {
                $firstComp = $selectedComp;

                // Tambah view_count secara halus saat diakses via direct link / dashboard
                $selectedComp->increment('view_count');
            }
        } elseif ($firstComp) {
            // Jika tidak ada parameter selected, load stages lomba urutan pertama untuk panel kanan
            $firstComp->load(['stages']);
        }

        // 6. Mengambil data master pelengkap komponen view
        $categories = Category::all();
        $fields = Field::all();
        $saveFolders = SaveFolder::where('user_id', auth()->id())->get();
        $savedIds = CompetitionSave::where('user_id', auth()->id())
            ->pluck('competition_id')
            ->toArray();

        return view('student.explore', compact(
            'competitions',
            'firstComp',
            'categories',
            'fields',
            'saveFolders',
            'savedIds'
        ));
    }

    /**
     * API JSON Endpoint untuk memuat detail satu lomba secara asinkron (AJAX panel kanan).
     */
    public function show(Competition $competition)
    {
        // Naikkan hitungan view ketika user mengklik list kartu di halaman explore
        $competition->increment('view_count');

        // Muat semua relasi detail yang dibutuhkan oleh javascript/blade panel kanan
        $competition->load(['category', 'field', 'stages', 'creator']);

        return response()->json($competition);
    }

    /**
     * Menyimpan atau membatalkan simpanan lomba (Toggle Bookmark).
     */
    public function save(Request $request, Competition $competition)
    {
        $userId = auth()->id();

        $existing = CompetitionSave::where('user_id', $userId)
            ->where('competition_id', $competition->id)
            ->first();

        if ($existing) {
            $existing->delete();
            return response()->json([
                'saved' => false,
                'message' => 'Lomba berhasil dihapus dari daftar simpanan.'
            ]);
        }

        CompetitionSave::create([
            'user_id' => $userId,
            'competition_id' => $competition->id,
            'folder_id' => $request->folder_id ?? null,
        ]);

        return response()->json([
            'saved' => true,
            'message' => 'Lomba berhasil disimpan ke dalam bookmark.'
        ]);
    }
}