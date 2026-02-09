@extends('layouts.app')

@section('title', 'Masuk ke Akun')

@section('content')
    <h1>Masuk</h1>
    <p>Gunakan email dan kata sandi untuk mengakses dashboard admin.</p>

    @if ($errors->any())
        <div class="error">
            {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="{{ route('login.submit') }}">
        @csrf

        <div>
            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
        </div>

        <div>
            <label for="password">Kata Sandi</label>
            <input type="password" id="password" name="password" required autocomplete="current-password">
        </div>

        <div class="actions">
            <div class="checkbox">
                <input type="checkbox" id="remember" name="remember" value="1">
                <label for="remember" style="margin:0;">Ingat saya</label>
            </div>
            <button type="submit">Masuk</button>
        </div>
    </form>
@endsection
