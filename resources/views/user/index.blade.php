@extends('layouts.app')

@section('content')
<div class="container p-5 mt-5 bg-white rounded col-md-10 shadow-lg">
    <div class="d-flex justify-content-end">
        <a href="{{route('user.create')}}" class="btn btn-primary">Add User</a>
    </div>
    <div class="table-responsive">
        <table id="myTable" class="table table-hover text-dark">
            <thead>
                <tr>
                    <td>Name</td>
                    <td>Email</td>
                    <td>level</td>
                    <td>Action</td>
                </tr>
            </thead>
            <tbody>
                @foreach($user as $row)
                <tr>
                    <td>
                        {{$row->name}}
                    </td>
                    <td>
                        {{$row->email}}
                    </td>
                    <td>
                        {{$row->level}}
                    </td>
                    <td class="d-flex gap-3">
                        <form action="{{route('user.destroy', $row->id)}}" method="post">
                            @csrf
                            {{method_field('delete')}}
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                        <a href="{{route('user.edit', $row->id)}}" class="btn btn-warning">Edit</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('#myTable').DataTable();
    })

</script>
@endsection
