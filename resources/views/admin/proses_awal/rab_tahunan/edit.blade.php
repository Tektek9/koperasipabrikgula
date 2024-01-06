@extends('admin.layout.core')

@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <p class="text-white mt-5 mb-5">Welcome back, <b>Admin</b></p>
        </div>
    </div>
    <style>
        .form-container {
            background-color: #494848;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            font-weight: bold;
        }
    </style>
    <!-- row -->
    <div class="row tm-content-row">
        <div class="form-container">
            <form method="POST" action="/rab_tahunans/{{$rab_tahunan->id}}">
                @csrf 
                @method("PUT")
                <div class="form-row">
                    <div class="col">
                        <div class="form-group">
                            <label for="tahun">Tahun</label>
                            <input type="text" class="form-control" id="tahun" name="tahun" required value="{{$rab_tahunan->tahun}}">
                        </div>
                        <div class="form-group">
                            <label for="nomor_perkiraan">Nomor Perkiraan</label>
                            <select class="form-control" id="nomor_perkiraan" name="nomor_perkiraan" required onchange="setNamaPerkiraan()">
                                <option value="{{$rab_tahunan->nomor_perkiraan}}" disabled selected>{{$rab_tahunan->nomor_perkiraan}}</option>
                                @foreach($nomor_perkiraan as $nomor)
                                    <option value="{{ $nomor->kode }}">{{ $nomor->kode }} |{{$nomor->uraian}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="nomor_perkiraan">Nama Perkiraan</label>
                            <input type="text" class="form-control" id="nama_perkiraan" name="nama_perkiraan" readonly value="{{$rab_tahunan->nama_perkiraan}}">
                        </div>
                        <!-- Lanjutkan dengan kolom pertama -->
                        <!-- ... -->
                        <div class="form-group">
                            <label for="rab_juli">RAB Januari</label>
                            <input type="number" min="0" class="form-control" id="rab_januari" name="rab_januari" required value="{{$rab_tahunan->rab_januari}}">
                        </div>
                        <div class="form-group">
                            <label for="rab_juli">RAB Februaru</label>
                            <input type="number" min="0" class="form-control" id="rab_juli" name="rab_februari" required value="{{$rab_tahunan->rab_februari}}">
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="rab_juli">RAB Maret</label>
                            <input type="number" min="0" class="form-control" id="rab_juli" name="rab_maret" required value="{{$rab_tahunan->rab_maret}}">
                        </div>
                        <div class="form-group">
                            <label for="rab_juli">RAB April</label>
                            <input type="number" min="0" class="form-control" id="rab_juli" name="rab_april" required value="{{$rab_tahunan->rab_april}}">
                        </div>
                        <div class="form-group">
                            <label for="rab_agustus">RAB Mei</label>
                            <input type="number" min="0" class="form-control" id="rab_agustus" name="rab_mei" required value="{{$rab_tahunan->rab_mei}}">
                        </div>
                        <div class="form-group">
                            <label for="rab_agustus">RAB Juni</label>
                            <input type="number" min="0" class="form-control" id="rab_agustus" name="rab_juni" required value="{{$rab_tahunan->rab_juni}}">
                        </div>
                        <div class="form-group">
                            <label for="rab_agustus">RAB Juli</label>
                            <input type="number" min="0" class="form-control" id="rab_agustus" name="rab_juli" required value="{{$rab_tahunan->rab_juli}}">
                        </div>
                    </div>
                       
                    <div class="col">
                        <div class="form-group">
                            <label for="rab_agustus">RAB Agustus</label>
                            <input type="number" min="0" class="form-control" id="rab_agustus" name="rab_agustus" required value="{{$rab_tahunan->rab_agustus}}">
                        </div>
                        <div class="form-group">
                            <label for="rab_september">RAB September</label>
                            <input type="number" min="0" class="form-control" id="rab_september" name="rab_september" required value="{{$rab_tahunan->rab_september}}">
                        </div>
                        <div class="form-group">
                            <label for="rab_september">RAB Oktober</label>
                            <input type="number" min="0" class="form-control" id="rab_september" name="rab_oktober" required value="{{$rab_tahunan->rab_oktober}}">
                        </div>
                        <div class="form-group">
                            <label for="rab_september">RAB November</label>
                            <input type="number" min="0" class="form-control" id="rab_september" name="rab_november" required value="{{$rab_tahunan->rab_november}}">
                        </div>
                        <div class="form-group">
                            <label for="rab_desember">RAB Desember</label>
                            <input type="number" min="0" class="form-control" id="rab_desember" name="rab_desember" required value="{{$rab_tahunan->rab_desember}}">
                        </div>
                        <input type="hidden" class="form-control" id="uraian" name="created_by" value="{{Auth::user()->name}}">
                        <!-- Lanjutkan untuk bulan-bulan berikutnya -->
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
            
        </div>
       
       
    </div>
</div>
<script>
    function setNamaPerkiraan() {
        var selectBox = document.getElementById('nomor_perkiraan');
        var selectedValue = selectBox.options[selectBox.selectedIndex].text;
        var parts = selectedValue.split('|');
        var uraian = parts[1].trim();
        document.getElementById('nama_perkiraan').value = uraian;
    }
</script>
@endsection

