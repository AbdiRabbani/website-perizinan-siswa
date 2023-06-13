@extends('layouts.app')

@section('content')
<div class="container px-4 mt-5 d-flex justify-content-center">
    <form role="form" method="POST" action="{{ route('user.store') }}" class="col-md-11">
        @csrf
        <div class="mb-3">
            <input id="username" aria-label="username" type="text"
                class="form-control @error('username') is-invalid @enderror" name="username"
                value="{{ old('username') }}" required autocomplete="username" autofocus placeholder="username">

            @error('username')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="mb-3">
            <input id="name" aria-label="Name" type="text" class="form-control @error('name') is-invalid @enderror"
                name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="name">

            @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="mb-3">
            <select name="level" id="level" class="form-select">
                <option value="admin">admin</option>
                <option value="guru">guru</option>
                <option value="siswa">siswa</option>
            </select>

            @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="mb-3">
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                value="{{ old('email') }}" required autocomplete="email" placeholder="Email" aria-label="Email">

            @error('level')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="mb-3">
            <input id="password" placeholder="Password" aria-label="Password" type="password"
                class="form-control @error('password') is-invalid @enderror" name="password" required
                autocomplete="new-password">

            @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="mb-3">
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required
                autocomplete="new-password" placeholder="comfirm password">
        </div>
        <div class="text-center">
            <button type="submit" class="btn bg-gradient-dark w-100 my-4 mb-2">
                {{ __('Create') }}
            </button>
        </div>
    </form>
</div>
@endsection
