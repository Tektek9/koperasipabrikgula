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
        <form action="/saldo_awals" method="GET">
            <div class="input-group mb-3">
              <input type="text" class="form-control" placeholder="Cari..." name="search">
              <div class="input-group-append">
                <button class="btn btn-warning" type="submit">Cari</button>
              </div>
            </div>
          </form>
          <form action="/import/saldo_awal" method="post" enctype="multipart/form-data">
            @csrf
            <div class="input-group mb-3">
              <input type="file" class="form-control" placeholder="Cari..." name="import">
              <div class="input-group-append">
                <button class="btn btn-info" type="submit">Import Data</button>
              </div>
            </div>
          </form>
        <a href="/saldo_awals/create" class="btn btn-primary mb-3">Create Data</a>
        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>Nomor Perkiraan</th>
                    <th>Nama Perkiraan</th>
                    <th>Jenis</th>
                    <th>Saldo Awal</th>
                    <th>created_by</th>
                    <th>acion</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($saldo_awals as $saldo)
                <tr>
                    <td>{{$saldo->nomor_perkiraan}}</td>
                    <td>{{$saldo->nama_perkiraan}}</td>
                    <td>{{$saldo->jenis}}</td>
                    <td>Rp. {{number_format($saldo->saldo_awal, 0, ',', '.')}}</td>
                    <td>{{$saldo->created_by}}</td>
                    <td>
                        <a href="{{ route('saldo_awals.edit', $saldo->id) }}" class="btn btn-primary">Edit</a>
                        <form action="{{ route('saldo_awals.destroy', $saldo->id) }}" method="POST" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>

                    
                @endforeach
               
                <!-- Tambahkan baris tambahan jika perlu -->
            </tbody>
        </table>
        <div class="col">
            <div class="col">
                <h1 class="text-white">Status : {{$status}}</h1>
            </div>
            <div class="col">
                <h1 class="text-white">Selisih :Rp. {{number_format($selisih, 0, ',', '.')}}</h1>
            </div>
            <div class="col">
                <h1 class="text-white">Jumlah Debit:Rp. {{number_format($debit, 0, ',', '.')}}</h1>
            </div>
            <div class="col">
                <h1 class="text-white">Jumlah Kredit:Rp. {{number_format($kredit, 0, ',', '.')}}</h1>
            </div>
        </div>
       
       
       
    </div>
</div>
@endsection

