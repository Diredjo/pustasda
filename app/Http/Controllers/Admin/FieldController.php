<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Field;
use Illuminate\Http\Request;

class FieldController extends Controller
{
    public function index()
    {
        $fields = Field::withCount('competitions')->get();
        return view('admin.fields.index', compact('fields'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100|unique:fields,name',
            'icon' => 'required|string|max:100',
        ]);
        Field::create($request->only('name', 'icon'));
        return back()->with('success', 'Bidang berhasil ditambahkan.');
    }

    public function update(Request $request, Field $field)
    {
        $request->validate([
            'name' => 'required|string|max:100|unique:fields,name,' . $field->id,
            'icon' => 'required|string|max:100',
        ]);
        $field->update($request->only('name', 'icon'));
        return back()->with('success', 'Bidang berhasil diperbarui.');
    }

    public function destroy(Field $field)
    {
        if ($field->competitions()->count() > 0) {
            return back()->with('error', 'Bidang tidak bisa dihapus karena masih digunakan lomba.');
        }
        $field->delete();
        return back()->with('success', 'Bidang berhasil dihapus.');
    }
}