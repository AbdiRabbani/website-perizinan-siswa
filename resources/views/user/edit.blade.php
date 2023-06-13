@extends('layouts.app')

@section('content')
<div class="container px-4 mt-5 d-flex justify-content-center">
    <form role="form" method="POST" action="{{ route('user.update', $user->id) }}" class="col-md-11">
        @csrf
        {{method_field('PUT')}}
        <div class="mb-3">
            <input id="username" aria-label="username" type="text"
                class="form-control" name="username" placeholder="username" value="{{$user->username}}">
        </div>
        <div class="mb-3">
            <input id="name" aria-label="Name" type="text" class="form-control"
                name="name" value="{{$user->name}}" placeholder="name">
        </div>
        <div class="mb-3">
            <select name="level" id="level" class="form-select">
                <option value="{{$user->level}}">{{$user->level}}--current</option>
                <option value="admin">admin</option>
                <option value="guru">guru</option>
                <option value="siswa">siswa</option>
            </select>
        </div>
        <div class="mb-3">
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{$user->email}}" placeholder="Email" aria-label="Email">
        </div>
        <div class="mb-3">
            <input id="password" placeholder="Password" aria-label="Password" type="password"
                class="form-control" name="password">
        </div>
        <div class="text-center">
            <button type="submit" class="btn bg-gradient-dark w-100 my-4 mb-2">
                {{ __('Kirim') }}
            </button>
        </div>
    </form>
</div>
@endsection
