@extends('layouts.app-admin')
@section('title', 'Tambah Lomba')
@php $pageTitle = 'Tambah Lomba Baru'; @endphp

@section('content')
    <div class="page-header">
        <h1><i class="fa-solid fa-plus-circle text-red"></i> Tambah Lomba Baru</h1>
    </div>

    <form method="POST" action="{{ route('admin.competitions.store') }}" enctype="multipart/form-data">
        @csrf
        @include('admin.competitions._form', ['competition' => null])
    </form>
@endsection