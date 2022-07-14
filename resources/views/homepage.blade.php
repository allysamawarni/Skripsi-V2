@extends('layouts.main')

@section('content')
    <h1>Halaman Home</h1>
    <h3>{{ $name }}</h3>
    <p>{{ $email }}</p>
    <img src="img/{{ $image }}" alt="{{ $name }}" width="200">
@endsection
