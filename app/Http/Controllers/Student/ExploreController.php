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
    public function index(Request $request)
    {
        $query = Competition::with(['category', 'field', 'creator'])
            ->where('is_active', true);

        // Filter
        if ($request->filter === 'trending')
            $query->where('is_trending', true);
        if ($request->filter === 'nasional')
            $query->where('level', 'nasional');
        if ($request->filter === 'terbaru')
            $query->latest();
        if ($request->filter === 'deadline')
            $query->whereDate('deadline', '<=', now()->addDays(7))->whereDate('deadline', '>=', now());
        if ($request->category)
            $query->where('category_id', $request->category);
        if ($request->field)
            $query->where('field_id', $request->field);
        if ($request->level)
            $query->where('level', $request->level);
        if ($request->type)
            $query->where('type', $request->type);
        if ($request->search)
            $query->where('title', 'like', '%' . $request->search . '%');

        $competitions = $query->whereDate('deadline', '>=', now())->orderByDesc('view_count')->get();

        // Kompetisi pertama untuk panel detail (default)
        $firstComp = $competitions->first();
        if ($request->selected) {
            $firstComp = Competition::with(['category', 'field', 'stages'])->find($request->selected) ?? $firstComp;
        }

        $categories = Category::all();
        $fields = Field::all();
        $saveFolders = SaveFolder::where('user_id', auth()->id())->get();
        $savedIds = CompetitionSave::where('user_id', auth()->id())->pluck('competition_id')->toArray();

        return view('student.explore', compact(
            'competitions',
            'firstComp',
            'categories',
            'fields',
            'saveFolders',
            'savedIds'
        ));
    }

    public function show(Competition $competition)
    {
        $competition->increment('view_count');
        $competition->load(['category', 'field', 'stages', 'creator']);
        return response()->json($competition);
    }

    public function save(Request $request, Competition $competition)
    {
        $existing = CompetitionSave::where('user_id', auth()->id())
            ->where('competition_id', $competition->id)->first();
        if ($existing) {
            $existing->delete();
            return response()->json(['saved' => false]);
        }

        CompetitionSave::create([
            'user_id' => auth()->id(),
            'competition_id' => $competition->id,
            'folder_id' => $request->folder_id ?? null,
        ]);
        return response()->json(['saved' => true]);
    }
}