@extends('layouts.user.layout')

@section('title', 'User Login')
@section('logo')
    <b>User</b> Login
@endsection
@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            {{ $errors->first() }}
        </div>
    @endif

    <form action="{{ route('user.login') }}" method="POST">
        @csrf
        <div class="input-group mb-3">
            <input type="email" name="email" value="{{ old('email') }}" class="form-control" placeholder="Email">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-envelope"></span>
                </div>
            </div>
        </div>

        <div class="input-group mb-3">
            <input type="password" name="password" class="form-control" placeholder="Password">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                </div>
            </div>
            <button type="submit" class="btn btn-primary btn-block">
                Sign In
            </button>
    </form>
@endsection
