@extends('layouts.app')

@section('content')
<div class="menu-login">
        <div class="bg-menu">
            <div class="img d-flex justify-content-center">
                <a href="{{ url('img/logo.png') }}">
                    <img src="{{ url('img/logo.jpg') }}" height="70" width="65" class="logo" >
                </a>
            </div>

            <div class="text-center">
                <form action="{{ route('login') }}" method="post" class="form-login">

                <h3>Selamat Datang!</h3>
                    @csrf
                    <div class="form-group has-feedback @error('email') has-error @enderror">
                        <input type="email" name="email" class="form-control login" placeholder="Email" required
                            value="{{ old('email') }}" autofocus>
                        @error('email')
                            <span class="help-block">{{ $message }}</span>
                        @else
                            <span class="help-block with-errors"></span>
                        @enderror
                    </div>
                    <div class="form-group has-feedback @error('password') has-error @enderror">
                        <input type="password" name="password" class="form-control login" placeholder="Kata sandi" required>
                        @error('password')
                            <span class="help-block">{{ $message }}</span>
                        @else
                            <span class="help-block with-errors"></span>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col-xs-8">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox"> Ingat saya
                                </label>
                            </div>
                        </div>
                        <div class="col-xs-4">
                            <button type="submit" class="btn btn-masuk">
                                <p class="log-in">Masuk</p>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
