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
        <div class="row ">
            <div class="row">
                <div class="col">
                    <a href="/penutups/create" class="btn btn-primary mb-3">Tambahkan Data</a>
                </div>
            </div>
            <div class="row ml-3 mr-3 mb-3">
                <div class="col">
                    <form action="/penutups" method="get">
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
                            <a href="/penutups/edit/{{$memori['nomor_bukti']}}" class="btn btn-primary">Edit</a>
                            <a href="/penutups/hapus/{{$memori['nomor_bukti']}}" class="btn btn-danger">Hapus</a>
                            
                        </td>
                    </tr>
                    @endforeach
                    
                    <!-- Tambahkan baris tambahan jika perlu -->
                </tbody>
            </table>
        </div>
        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>Tahun</th>
                    <th>Jenis</th>
                    <th>Nomor Bukti</th>
                    <th>Nomor Perkiraan</th>
                    <th>Deskripsi</th>
                    <th>UBL</th>
                    <th>Jumlah Uang</th>
                    <th>created By</th>
                    <th>opsi</th>
                </tr>
            </thead>
            <tbody>
                @if ($penutups->count()==0)
                <td colspan="10" align="center">data tidak di temukan</td>
            @else
                @foreach ($penutups as $suplement)
                <tr>
                    <td>{{$suplement->tahun}}</td>
                    <td>{{$suplement->jenis}}</td>
                    <td>{{$suplement->nomor_bukti}}</td>
                    <td>{{$suplement->nomor_perkiraan}}</td>
                    <td>{{$suplement->deskripsi}}</td>
                    <td>{{$suplement->ubl}}</td>
                    <td>{{$suplement->jumlah_uang}}</td>
                    <td>{{$suplement->created_by}}</td>
                    <td>
                        <a href="/penutups/edit/{{$suplement->nomor_bukti}}" class="btn btn-primary">Edit</a>
                        <a href="/penutups/hapus/{{$suplement->nomor_bukti}}" class="btn btn-danger">Hapus</a>
                        
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

