@extends('layouts.app')

@section('content')
<div class="container mx-5 bg-white p-3 rounded col-md-10">
    <div class="d-flex gap-3">
        <p>Nama :</p>
        <p>{{$permit->user->name}}</p>
    </div>
    <div class="d-flex gap-3">
        <p>Kepada :</p>
        <p>{{$permit->departement->user->name}} ({{$permit->departement->nama_departemen}})</p>
    </div>
    <div class="d-flex gap-3">
        <p>Keperluan :</p>
        <p>{{$permit->keterangan}} ({{$permit->keperluan}})</p>
    </div>
    <div class="d-flex gap-3">
        <p>Tanggal Izin :</p>
        <p>{{$permit->start_date}} sampai {{$permit->end_date}}</p>
    </div>
    <div class="">
        <p>Bukti :</p>
        <img src="{{asset('storage/images/'.$permit->bukti)}}" alt="" class="w-75 img-thumbnail">
    </div>
    <div class="mt-5 d-flex gap-3 justify-content-end">
        @if($permit->status == "menunggu")
        <form action="{{route('permit.update', $permit->id)}}" method="post">
            @csrf
            {{method_field('put')}}
            <input type="text" name="status" value="diizinkan" hidden>
            <button type="submit" class="btn btn-success">Izinkan</button>
        </form>
        <form action="{{route('permit.update', $permit->id)}}" method="post">
            @csrf
            {{method_field('put')}}
            <input type="text" name="status" value="ditolak" hidden>
            <button type="submit" class="btn btn-danger">Tolak</button>
        </form>
        @else
        <button type="button" class="btn btn-warning">{{$permit->status}}</button>
        @endif
    </div>
</div>
@endsection
