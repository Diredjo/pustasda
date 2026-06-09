@extends('layouts.app-student')
@section('title', 'Buat Tim Baru')

@section('content')
    <div class="container" style="max-width: 600px; margin-top: 20px;">
        <div class="card">
            <div class="card-header">
                <h4>Buat Tim Baru</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('student.teams.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="competition_id" value="{{ $competition->id }}">

                    <div class="mb-3">
                        <label class="form-label">Nama Tim</label>
                        <input type="text" name="team_name" class="form-control" required
                            placeholder="Contoh: Sang Juara 2026">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Status Tim</label>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="is_public" value="1" id="is_public"
                                checked>
                            <label class="form-check-label" for="is_public">
                                Publik (Tim bisa dilihat dan dilamar orang lain)
                            </label>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ url()->previous() }}" class="btn btn-secondary">Kembali</a>
                        <button type="submit" class="btn btn-primary">Simpan Tim</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection