@extends('layouts.app')


@section('content')
<div class="card shadow-lg mx-4 mt-5">
      <div class="card-body p-3">
        <div class="row gx-4">
          <div class="col-auto">
            <div class="avatar avatar-xl position-relative">
              @if($siswa)
              @foreach($siswa as $row)
              <img src="{{asset('storage/images/' .$row->foto)}}" alt="profile_image" class="w-100 border-radius-lg shadow-sm">
              @endforeach
              @else
              <img src="{{asset('template/img/profile-ex.png')}}" alt="profile_image" class="w-100 border-radius-lg shadow-sm">
              @endif
            </div>
          </div>
          <div class="col-auto my-auto">
            <div class="h-100">
              <h5 class="mb-1">
                {{Auth::user()->name}}
              </h5>
              <p class="mb-0 font-weight-bold text-sm">
                {{Auth::user()->level}}
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-md-8">
          <div class="card">
            <div class="card-header pb-0">
              <div class="d-flex align-items-center">
                @if($siswa)
                <p class="mb-0">Edit Profile</p>
                @elseif(Auth()->user()->level != "siswa")
                <p class="mb-0">Edit Profile</p>
                @else
                <p class="mb-0">Add Profile</p>
                @endif
              </div>
            </div>
            @if(Auth()->user()->level == "siswa")
            @if($siswa)
            @foreach($siswa as $row)
            <form class="card-body" method="post" action="{{route('siswa.update', $row->id)}}" enctype="multipart/form-data">
              {{method_field('PUT')}}
            @endforeach
            @else
            <form class="card-body" method="post" action="{{route('siswa.store')}}" enctype="multipart/form-data">
            @endif
            @else
            <form class="card-body" method="post" action="{{route('user.update', $user->id)}}">
              {{method_field('PUT')}}
            @endif
              @csrf
              <p class="text-uppercase text-sm">User Information</p>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Username</label>
                    <input class="form-control" type="text" name="username" value="{{Auth::user()->username}}">
                    <input class="form-control" type="text" name="id_user" value="{{Auth::user()->id}}" hidden>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Email address</label>
                    <input class="form-control" type="email" name="email" value="{{Auth::user()->email}}">
                    <input class="form-control" type="text" name="level" value="{{Auth::user()->level}}" hidden>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Password</label>
                    <input class="form-control" type="password" name="password">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">name</label>
                    <input class="form-control" type="text" name="name" value="{{Auth::user()->name}}">
                  </div>
                </div>
                @if(Auth()->user()->level == "siswa")
                @if($siswa)
                @foreach($siswa as $row)
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">NISN</label>
                    <input class="form-control" type="number" name="nisn" value="{{$row->nisn}}">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Photo Profile</label>
                    <input class="form-control" type="file" name="foto">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">NIS</label>
                    <input class="form-control" type="number" value="{{$row->nis}}" name="nis">
                  </div>
                </div>
              </div>
              <hr class="horizontal dark">
              <p class="text-uppercase text-sm">Contact Information</p>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Address</label>
                    <input class="form-control" type="text" value="{{$row->alamat}}"  name="alamat">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Phone Number</label>
                    <input class="form-control" type="number" value="{{$row->no_hp}}" name="no_hp">
                  </div>
                </div>
              </div>
              @endforeach
              @else
              <div class="col-md-6">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">NISN</label>
                    <input class="form-control" type="number" name="nisn">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Photo Profile</label>
                    <input class="form-control" type="file" name="foto">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">NIS</label>
                    <input class="form-control" type="number" name="nis">
                  </div>
                </div>
              </div>
              <hr class="horizontal dark">
              <p class="text-uppercase text-sm">Contact Information</p>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Address</label>
                    <input class="form-control" type="text" name="alamat">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Phone Number</label>
                    <input class="form-control" type="number" name="no_hp">
                  </div>
                </div>
              </div>
              @endif
              @endif
              <div class="col-md-12 d-flex justify-content-end">
                  <div class="form-group">
                    <button class="btn btn-success">Submit</button>
                  </div>
                </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection