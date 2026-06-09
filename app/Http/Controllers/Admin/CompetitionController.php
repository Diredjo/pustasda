<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Competition;
use App\Models\CompetitionStage;
use App\Models\Category;
use App\Models\Field;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CompetitionController extends Controller
{
    public function index(Request $request)
    {
        $query = Competition::with(['category', 'field', 'creator']);

        if ($request->search) {
            $query->where('title', 'like', '%' . $request->search . '%')
                ->orWhere('organizer', 'like', '%' . $request->search . '%');
        }
        if ($request->level)
            $query->where('level', $request->level);
        if ($request->type)
            $query->where('type', $request->type);
        if ($request->status === 'active')
            $query->where('is_active', true);
        if ($request->status === 'inactive')
            $query->where('is_active', false);

        $competitions = $query->latest()->paginate(15)->withQueryString();

        return view('admin.competitions.index', compact('competitions'));
    }

    public function create()
    {
        $categories = Category::all();
        $fields = Field::all();
        return view('admin.competitions.create', compact('categories', 'fields'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'organizer' => 'required|string|max:200',
            'category_id' => 'required|exists:categories,id',
            'field_id' => 'required|exists:fields,id',
            'level' => 'required|in:sekolah,kota,provinsi,nasional,internasional',
            'type' => 'required|in:solo,team',
            'min_members' => 'required|integer|min:1',
            'max_members' => 'required|integer|min:1',
            'deadline' => 'required|date',
            'register_deadline' => 'nullable|date',
            'announcement_date' => 'nullable|date',
            'description' => 'nullable|string',
            'requirements' => 'nullable|string',
            'link_registration' => 'nullable|url',
            'poster' => 'nullable|image|max:2048',
            'cover' => 'nullable|image|max:2048',
            'total_stages' => 'required|integer|min:1|max:10',
            'is_trending' => 'nullable|boolean',
        ]);

        $data = $request->except(['poster', 'cover', 'stage_name', 'stage_deadline', 'stage_desc', '_token']);
        $data['created_by'] = auth()->id();
        $data['is_trending'] = $request->boolean('is_trending');
        $data['is_active'] = true;

        if ($request->hasFile('poster')) {
            $data['poster'] = $request->file('poster')->store('competitions', 'public');
        }
        if ($request->hasFile('cover')) {
            $data['cover'] = $request->file('cover')->store('covers', 'public');
        }

        $competition = Competition::create($data);

        // Simpan stages kalau total_stages > 1
        if ($request->total_stages > 1 && $request->stage_name) {
            foreach ($request->stage_name as $i => $name) {
                if (!$name)
                    continue;
                CompetitionStage::create([
                    'competition_id' => $competition->id,
                    'stage_number' => $i + 1,
                    'stage_name' => $name,
                    'deadline' => $request->stage_deadline[$i] ?? null,
                    'description' => $request->stage_desc[$i] ?? null,
                ]);
            }
        }

        return redirect()->route('admin.competitions.index')
            ->with('success', 'Lomba "' . $competition->title . '" berhasil ditambahkan.');
    }

    public function edit(Competition $competition)
    {
        $competition->load('stages');
        $categories = Category::all();
        $fields = Field::all();
        return view('admin.competitions.edit', compact('competition', 'categories', 'fields'));
    }

    public function update(Request $request, Competition $competition)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'organizer' => 'required|string|max:200',
            'category_id' => 'required|exists:categories,id',
            'field_id' => 'required|exists:fields,id',
            'level' => 'required|in:sekolah,kota,provinsi,nasional,internasional',
            'type' => 'required|in:solo,team',
            'min_members' => 'required|integer|min:1',
            'max_members' => 'required|integer|min:1',
            'deadline' => 'required|date',
            'register_deadline' => 'nullable|date',
            'announcement_date' => 'nullable|date',
            'description' => 'nullable|string',
            'requirements' => 'nullable|string',
            'link_registration' => 'nullable|url',
            'poster' => 'nullable|image|max:2048',
            'cover' => 'nullable|image|max:2048',
            'total_stages' => 'required|integer|min:1',
            'is_trending' => 'nullable|boolean',
            'is_active' => 'nullable|boolean',
        ]);

        $data = $request->except(['poster', 'cover', 'stage_name', 'stage_deadline', 'stage_desc', '_token', '_method']);
        $data['is_trending'] = $request->boolean('is_trending');
        $data['is_active'] = $request->boolean('is_active', true);

        if ($request->hasFile('poster')) {
            if ($competition->poster)
                Storage::disk('public')->delete($competition->poster);
            $data['poster'] = $request->file('poster')->store('competitions', 'public');
        }
        if ($request->hasFile('cover')) {
            if ($competition->cover)
                Storage::disk('public')->delete($competition->cover);
            $data['cover'] = $request->file('cover')->store('covers', 'public');
        }

        $competition->update($data);

        // Update stages
        $competition->stages()->delete();
        if ($request->total_stages > 1 && $request->stage_name) {
            foreach ($request->stage_name as $i => $name) {
                if (!$name)
                    continue;
                CompetitionStage::create([
                    'competition_id' => $competition->id,
                    'stage_number' => $i + 1,
                    'stage_name' => $name,
                    'deadline' => $request->stage_deadline[$i] ?? null,
                    'description' => $request->stage_desc[$i] ?? null,
                ]);
            }
        }

        return redirect()->route('admin.competitions.index')
            ->with('success', 'Lomba berhasil diperbarui.');
    }

    public function destroy(Competition $competition)
    {
        if ($competition->poster)
            Storage::disk('public')->delete($competition->poster);
        if ($competition->cover)
            Storage::disk('public')->delete($competition->cover);
        $competition->delete();
        return redirect()->route('admin.competitions.index')
            ->with('success', 'Lomba berhasil dihapus.');
    }

    public function toggleActive(Competition $competition)
    {
        $competition->update(['is_active' => !$competition->is_active]);
        return back()->with('success', 'Status lomba diperbarui.');
    }
}