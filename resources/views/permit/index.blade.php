@extends('layouts.app')

@section('content')
@if(Auth::user()->level == "siswa")
<div class="container px-5 mt-5 bg-white rounded col-md-10 shadow-lg">
    <form action="{{route('permit.store')}}" class="p-3" enctype="multipart/form-data" method="post">
        @csrf
        <div class="mt-3">
            <label for="">Name</label>
            <input type="integer" value="{{Auth::user()->id}}" name="id_user" class="form-control" hidden>
            <input type="text" value="{{Auth::user()->name}}" class="form-control" disabled>
        </div>
        <div class="mt-3">
            <label for="">Penerima</label>
            <select name="id_departemen" id="" class="form-select   "> 
                @foreach($departement as $row)
                <option value="{{$row->id}}">{{$row->user->name}} ({{$row->nama_departemen}})</option>
                @endforeach
            </select>
        </div>
        <div class="mt-3">
            <label for="">Keperluan</label>
            <select name="keperluan" id="" class="form-control">
                <option value="izin">izin</option>
                <option value="sakit">sakit</option>
            </select>
        </div>
        <div class="mt-3">
            <label for="">Keterangan</label>
            <input type="text" name="keterangan" class="form-control">
        </div>
        <div class="mt-3">
            <label for="">Bukti</label>
            <input type="file" name="bukti" class="form-control">
        </div>
        <div class="mt-3">
            <label for="">Tanggal izin</label>
            <input type="date" name="start_date" id="start_date" onChange="dataSetStart()" class="form-control">
        </div>
        <div class="mt-3">
            <label for="">Tanggal datang</label>
            <input type="date" name="end_date" id="end_date" class="form-control">
        </div>
        <div class="mt-3 d-flex justify-content-end">
            <button type="submit" class="btn btn-primary">Izin</button>
        </div>
    </form>
</div>
<div class="container px-5 mt-5 bg-white rounded col-md-10 shadow-lg">
    <p class="h3">Izin kamu</p>
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <td>
                        Penerima
                    </td>
                    <td>
                        Keterangan
                    </td>
                    <td>
                        Tanggal datang
                    </td>
                    <td>
                        Aksi
                    </td>
                </tr>
            </thead>
            <tbody>
                @foreach($permit as $row)
                <tr>
                    <td>
                        {{$row->departement->user->name}} ({{$row->departement->nama_departemen}})
                    </td>
                    <td>
                        {{$row->keterangan}}
                    </td>
                    <td>
                        {{$row->end_date}}
                    </td>
                    <td>
                        <form action="{{route('permit.destroy', $row->id)}}" method="post">
                            @csrf
                            {{method_field('delete')}}
                            @if($row->status == 'menunggu')
                            <button type="submit" class="btn btn-danger">Batalkan</button>
                            @elseif($row->status == 'diizinkan')
                            <p class="p-2 text-success">DiIzinkan</p>
                            @else
                            <p class="p-2 text-danger">Ditolak</p>
                            @endif
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endif

@if(Auth::user()->level == 'guru')
<div class="container px-5 mt-5 bg-white rounded col-md-10 shadow-lg p-4">
    <p class="h3">Departemen Kamu</p>
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <td>
                        Nama Departemen
                    </td>
                    <td>
                        Detail yang izin
                    </td>
                </tr>
            </thead>
            <tbody>
                @foreach($mydept as $row)
                <tr>
                    <td>{{$row->nama_departemen}}</td>
                    <td class="d-flex gap-3">
                        <a href="{{route('departement.show', $row->id)}}" class="btn btn-warning">Lihat yang izin</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endif

@if(Auth::user()->level == "admin")
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
                        Status
                    </td>
                </tr>
            </thead>
            <tbody>
                @foreach($spermit as $row)
                <tr>
                    <td>{{$row->user->name}}</td>
                    <td>({{$row->keperluan}}) {{$row->keterangan}}</td>
                    <td>
                        <div class="col-md-5">
                            <img src="{{asset('storage/images/'.$row->bukti)}}" alt="" class="img-thumbnail">
                        </div>
                    </td>
                    <td class="d-flex gap-3 justify-content-center">
                        <form action="{{route('permit.update', $row->id)}}" method="post">
                            @csrf
                            {{method_field('put')}}
                            <input type="text" name="status" value="diizinkan" hidden>
                            <button type="submit" class="btn btn-success">Izinkan</button>
                        </form>
                        <form action="{{route('permit.update', $row->id)}}" method="post">
                            @csrf
                            {{method_field('put')}}
                            <input type="text" name="status" value="ditolak" hidden>
                            <button type="submit" class="btn btn-danger">Tolak</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endif
<script>
    function dataSetStart() {
        const startdate =  document.getElementById('start_date').value;

        document.getElementById('end_date').min = new Date(startdate).toISOString().split("T")[0];

        document.getElementById('end_date').value = new Date(startdate).toISOString().split("T")[0];
    }

    document.getElementById('start_date').value = new Date(new Date().getTime() - new Date().getTimezoneOffset() * 60000)
        .toISOString().split("T")[0];
    document.getElementById('end_date').value = new Date(new Date().getTime() - new Date().getTimezoneOffset() * 60000)
        .toISOString().split("T")[0];

    document.getElementById('start_date').min = new Date(new Date().getTime() - new Date().getTimezoneOffset() * 60000)
        .toISOString().split("T")[0];
    document.getElementById('end_date').min = new Date(new Date().getTime() - new Date().getTimezoneOffset() * 60000)
        .toISOString().split("T")[0];
</script>
@endsection