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
        <form action="/rab_tahunans" method="GET">
            <div class="input-group mb-3">
              <input type="text" class="form-control" placeholder="Cari..." name="search">
              <div class="input-group-append">
                <button class="btn btn-warning" type="submit">Cari</button>
              </div>
            </div>
          </form>
          <form action="/import/rab_tahunan" method="post" enctype="multipart/form-data">
            @csrf
            <div class="input-group mb-3">
              <input type="file" class="form-control" placeholder="Cari..." name="import">
              <div class="input-group-append">
                <button class="btn btn-info" type="submit">Import Data</button>
              </div>
            </div>
          </form>
        <a href="/rab_tahunans/create" class="btn btn-primary mb-3">Create Data</a>
        <div class="table-responsive">
            <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>Tahun</th>
                    <th>Nomor Perkiraan</th>
                    <th>Nama Perkiraan</th>
                    <th>RAB Januari</th>
                    <th>RAB Februari</th>
                    <th>RAB Maret</th>
                    <th>RAB April</th>
                    <th>RAB Mei</th>
                    <th>RAB Juni</th>
                    <th>RAB Juli</th>
                    <th>RAB Agustus</th>
                    <th>RAB September</th>
                    <th>RAB Oktober</th>
                    <th>RAB November</th>
                    <th>RAB Desember</th>
                    <th>Created By</th>
                    <th>Acion</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($rab_tahunans as $rab)
                <tr>
                    <td>{{$rab->tahun}}</td>
                    <td>{{$rab->nomor_perkiraan}}</td>
                    <td>{{$rab->nama_perkiraan}}</td>
                    <td>{{$rab->rab_januari}}</td>
                    <td>{{$rab->rab_februari}}</td>
                    <td>{{$rab->rab_maret}}</td>
                    <td>{{$rab->rab_april}}</td>
                    <td>{{$rab->rab_mei}}</td>
                    <td>{{$rab->rab_juni}}</td>
                    <td>{{$rab->rab_juli}}</td>
                    <td>{{$rab->rab_agustus}}</td>
                    <td>{{$rab->rab_september}}</td>
                    <td>{{$rab->rab_oktober}}</td>
                    <td>{{$rab->rab_november}}</td>
                    <td>{{$rab->rab_desember}}</td>
                    <td>{{$rab->created_by}}</td>
                    <td>
                        <a href="{{ route('rab_tahunans.edit', $rab->id) }}" class="btn btn-primary">Edit</a>
                        <form action="{{ route('rab_tahunans.destroy', $rab->id) }}" method="POST" style="display: inline-block;">
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

