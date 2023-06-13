@extends('layouts.app')

@section('content')
<div class="container p-5 mt-5 bg-white rounded col-md-10 shadow-lg">
    <form action="{{route('departement.update', $departement->id)}}" method="post">
        @csrf
        {{method_field('PUT')}}
        <div class="mt-3">
            <label for="">Departement</label>
            <input type="text" name="nama_departemen" class="form-control" value="{{$departement->nama_departemen}}">
        </div>
        <div class="mt-3">
            <label for="">Ketua</label>
            <select name="id_user" id="" class="form-select">
                <option value="{{$departement->user->id}}">{{$departement->user->name}}--current</option>
                @foreach($guru as $row)
                <option value="{{$row->id}}">{{$row->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="mt-3 d-flex justify-content-end">
            <button class="btn btn-primary">
                Update
            </button>
        </div>
    </form>
</div>
@endsection