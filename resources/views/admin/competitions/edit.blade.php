@extends('layouts.app-admin')
@section('title', 'Edit Lomba')
@php $pageTitle = 'Edit Lomba'; @endphp

@section('content')
    <div class="page-header">
        <h1><i class="fa-solid fa-pen text-red"></i> Edit Lomba</h1>
    </div>

    <form method="POST" action="{{ route('admin.competitions.update', $competition) }}" enctype="multipart/form-data">
        @csrf @method('PUT')
        @include('admin.competitions._form', ['competition' => $competition])
    </form>
@endsection