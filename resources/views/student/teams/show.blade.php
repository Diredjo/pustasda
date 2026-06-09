@extends('layouts.app-student')
@section('title', 'Detail Tim')

@section('content')
    <div class="container">
        <h2>Tim: {{ $team->team_name }}</h2>
        <div class="alert alert-info">
            Kode Undangan: <strong>{{ $team->invite_code }}</strong> (Bagikan ke temanmu!)
        </div>

        <h5>Anggota Tim:</h5>
        <ul class="list-group">
            @foreach($team->members as $member)
                <li class="list-group-item">
                    {{ $member->user->name }} - <span
                        class="badge bg-{{ $member->status == 'accepted' ? 'success' : 'warning' }}">{{ $member->status }}</span>
                </li>
            @endforeach
        </ul>

        @if($team->leader_id == auth()->id())
            <hr>
            <h5>Permintaan Masuk:</h5>
            {{-- Di sini nanti kamu bisa loop member yang statusnya 'pending' --}}
        @endif
    </div>
@endsection