@extends('layouts.app')

@section('content')
<div class="container px-5 mt-5 bg-white rounded col-md-10 shadow-lg p-4">
    <p class="h3">Siswa Yang Izin</p>
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <td>
                        Nama Siswa
                    </td>
                    <td>
                        Alasan
                    </td>
                    <td>
                        Bukti
                    </td>
                    <td class="text-center">
                        Detail
                    </td>
                </tr>
            </thead>
            <tbody>
                @foreach($permit as $row)
                <tr>
                    <td>{{$row->user->name}}</td>
                    <td>({{$row->keperluan}}) {{$row->keterangan}}</td>
                    <td>
                        <div class="col-md-5">
                            <img src="{{asset('storage/images/'.$row->bukti)}}" alt="" class="img-thumbnail">
                        </div>
                    </td>
                    <td class="d-flex gap-3 justify-content-center">
                        <a href="{{route('permit.show', $row->id)}}" class="btn btn-warning">Detail</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection