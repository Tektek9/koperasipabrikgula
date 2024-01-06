@extends('admin.layout.core')

@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <p class="text-white mt-5 mb-5">Welcome back, <b>Admin</b></p>
        </div>
    </div>
    <!-- row -->
    <div class="row ">
        <div class="row">
            <div class="col">
                  <form action="/import/memorial" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="input-group mb-3">
                      <input type="file" class="form-control" placeholder="Cari..." name="import">
                      <div class="input-group-append">
                        <button class="btn btn-info" type="submit">Import Data</button>
                      </div>
                    </div>
                  </form>
            </div>
            <div class="col">
                <a href="/memorials/create" class="btn btn-primary mb-3">Tambahkan Data</a>
            </div>
        </div>
        <div class="row ml-3 mr-3 mb-3">
            <div class="col">
                <form action="/memorials" method="get">
                    @csrf
                    <div class="form-group">
                        <label for="tanggal">Tanggal:</label>
                        <input type="date" class="form-control" id="tanggal" name="tanggal">
                    </div>
                    <button type="submit" class="btn btn-primary">Cari Data</button>
                </form>
            </div>
        </div>
    </div>
    <div class="row">
        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>Status</th>
                    <th>Nomor Bukti</th>
                    <th>Opsi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($semua as $memori)
                <tr>
                    <td>{{$memori['status']}}</td>
                    <td>{{$memori['nomor_bukti']}}</td>
                    <td>
                        <a href="/memorials/edit/{{$memori['nomor_bukti']}}" class="btn btn-primary">Edit</a>
                        <a href="/memorials/hapus/{{$memori['nomor_bukti']}}" class="btn btn-danger">Hapus</a>
                        
                    </td>
                </tr>
                @endforeach
                
                <!-- Tambahkan baris tambahan jika perlu -->
            </tbody>
        </table>
    </div>
    <div class="row mt-3">
        <table class="table table-bordered -mt3">
            <thead class="thead-dark">
                <tr>
                    <th>Tanggal</th>
                    <th>Nomor Bukti</th>
                    <th>Nomor Perkiraan</th>
                    <th>Deskripsi</th>
                    <th>UBL</th>
                    <th>Jumlah Uang</th>
                    <th>Jenis</th>
                    <th>Created By</th>
                    <th>Opsi</th>
                </tr>
            </thead>
            <tbody>
                @if ($memorials->count()==0)
                <td colspan="10" align="center">data tidak di temukan</td>
            @else
                @foreach ($memorials as $memori)
                <tr>
                    <td>{{$memori->tanggal}}</td>
                    <td>{{$memori->nomor_bukti}}</td>
                    <td>{{$memori->nomor_perkiraan}}</td>
                    <td>{{$memori->deskripsi}}</td>
                    <td>{{$memori->ubl}}</td>
                    <td>{{number_format($memori->jumlah_uang, 0, ',', '.')}}</td>
                    <td>{{$memori->jenis}}</td>
                    <td>{{$memori->created_by}}</td>
                    <td>
                        <a href="/memorials/edit/{{$memori->nomor_bukti}}" class="btn btn-primary">Edit</a>
                        <a href="/memorials/hapus/{{$memori->nomor_bukti}}" class="btn btn-danger">Hapus</a>
                        
                    </td>
                </tr>
                @endforeach
            @endif
                
                <!-- Tambahkan baris tambahan jika perlu -->
            </tbody>
        </table>
       
       
       
    </div>
</div>
@endsection

