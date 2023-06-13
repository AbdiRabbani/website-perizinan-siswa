@extends('layouts.app')

@section('content')
<div class="container p-5 mt-5 bg-white rounded col-md-10 shadow-lg">
    <form action="{{route('departement.store')}}" method="post">
        @csrf
        <div class="mt-3">
            <label for="">Departement</label>
            <input type="text" name="nama_departemen" class="form-control">
        </div>
        <div class="mt-3">
            <label for="">Ketua</label>
            <select name="id_user" id="" class="form-select">
                @foreach($guru as $row)
                <option value="{{$row->id}}">{{$row->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="mt-3 d-flex justify-content-end">
            <button class="btn btn-primary">
                Tambah
            </button>
        </div>
    </form>
</div>
<div class="container p-5 mt-5 bg-white rounded col-md-10 shadow-lg">
    <div class="table-responsive">
        <table class="table table-hover text-dark">
            <thead>
                <tr>
                    <td>Nama</td>
                    <td>Ketua</td>
                    <td>Aksi</td>
                </tr>
            </thead>
            <tbody>
                @foreach($departement as $row)
                <tr>
                    <td>
                        {{$row->nama_departemen}}
                    </td>
                    <td>
                        {{$row->user->name}}
                    </td>
                    <td class="d-flex gap-3">
                        <form action="{{route('departement.destroy', $row->id)}}" method="post">
                            @csrf
                            {{method_field('delete')}}
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                        <a href="{{route('departement.edit', $row->id)}}" class="btn btn-warning">Edit</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection