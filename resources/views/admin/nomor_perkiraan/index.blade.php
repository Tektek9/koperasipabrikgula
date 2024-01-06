@extends('admin.layout.core')

@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <p class="text-white mt-5 mb-5">Welcome back, <b>Admin</b></p>
        </div>
    </div>
    <!-- row -->
    <div class="row tm-content-row">
        <form action="/nomor_perkiraans" method="GET">
            <div class="input-group mb-3">
              <input type="text" class="form-control" placeholder="Cari..." name="search">
              <div class="input-group-append">
                <button class="btn btn-warning" type="submit">Cari</button>
              </div>
            </div>
          </form>
          <form action="/import/no_perkiraan" method="post" enctype="multipart/form-data">
            @csrf
            <div class="input-group mb-3">
              <input type="file" class="form-control" placeholder="Cari..." name="import">
              <div class="input-group-append">
                <button class="btn btn-info" type="submit">Import Data</button>
              </div>
            </div>
          </form>
        <a href="/nomor_perkiraans/create" class="btn btn-primary mb-3">Create Data</a>
        <div class="table-responsive">
            {{$nomor_perkiraans->links()}}
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Kode</th>
                        <th scope="col">Uraian</th>
                        <th scope="col">Created_by</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($nomor_perkiraans as $nomorPerkiraan)
                    <tr>
                        <th scope="row">{{ $nomorPerkiraan->id }}</th>
                        <td>{{ $nomorPerkiraan->kode }}</td>
                        <td>{{ $nomorPerkiraan->uraian }}</td>
                        <td>{{ $nomorPerkiraan->created_by }}</td>
                        <td>
                            <a href="{{ route('nomor_perkiraans.edit', $nomorPerkiraan->id) }}" class="btn btn-primary">Edit</a>
            <form action="{{ route('nomor_perkiraans.destroy', $nomorPerkiraan->id) }}" method="POST" style="display: inline-block;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            
        </div>
       
       
    </div>
</div>
@endsection

