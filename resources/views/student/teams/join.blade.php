@extends('layouts.app-student')
@section('title', 'Gabung Tim')

@section('content')
    <div class="container" style="max-width: 500px; margin-top: 50px;">
        <div class="card">
            <div class="card-header">
                <h4>Gabung Tim via Kode</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('student.teams.join.submit') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Masukkan Kode Undangan</label>
                        <input type="text" name="code" class="form-control" required placeholder="Contoh: ABCD123">
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Gabung Tim</button>
                </form>
            </div>
        </div>
    </div>
@endsection