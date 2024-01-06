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
            <form method="POST" action="/rab_tahunans">
                @csrf 
                <div class="form-row">
                    <div class="col">
                        <div class="form-group">
                            <label for="tahun">Tahun</label>
                            <input type="text" class="form-control" id="tahun" min="1900" max="2099" name="tahun" required>
                            @error('kode')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        </div>
                        <div class="form-group">
                            <label for="nomor_perkiraan">Nomor Perkiraan</label>
                            <select class="form-control" id="nomor_perkiraan" name="nomor_perkiraan" required onchange="setNamaPerkiraan()">
                                <option value="" disabled selected>Pilih Nomor Perkiraan</option>
                                @foreach($nomor_perkiraan as $nomor)
                                    <option value="{{ $nomor->kode }}">{{ $nomor->kode }} |{{$nomor->uraian}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="nomor_perkiraan">Nama Perkiraan</label>
                            <input type="text" class="form-control" id="nama_perkiraan" name="nama_perkiraan" required>
                        </div>
                        <!-- Lanjutkan dengan kolom pertama -->
                        <!-- ... -->
                        <div class="form-group">
                            <label for="rab_juli">RAB Januari</label>
                            <input type="number" min="0" class="form-control" id="rab_januari" name="rab_januari" required>
                        </div>
                        <div class="form-group">
                            <label for="rab_juli">RAB Februaru</label>
                            <input type="number" min="0" class="form-control" id="rab_juli" name="rab_februari" required>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="rab_juli">RAB Maret</label>
                            <input type="number" min="0" class="form-control" id="rab_juli" name="rab_maret" required>
                        </div>
                        <div class="form-group">
                            <label for="rab_juli">RAB April</label>
                            <input type="number" min="0" class="form-control" id="rab_juli" name="rab_april" required>
                        </div>
                        <div class="form-group">
                            <label for="rab_agustus">RAB Mei</label>
                            <input type="number" min="0" class="form-control" id="rab_agustus" name="rab_mei" required>
                        </div>
                        <div class="form-group">
                            <label for="rab_agustus">RAB Juni</label>
                            <input type="number" min="0" class="form-control" id="rab_agustus" name="rab_juni" required>
                        </div>
                        <div class="form-group">
                            <label for="rab_agustus">RAB Juli</label>
                            <input type="number" min="0" class="form-control" id="rab_agustus" name="rab_juli" required>
                        </div>
                    </div>
                       
                    <div class="col">
                        <div class="form-group">
                            <label for="rab_agustus">RAB Agustus</label>
                            <input type="number" min="0" class="form-control" id="rab_agustus" name="rab_agustus" required>
                        </div>
                        <div class="form-group">
                            <label for="rab_september">RAB September</label>
                            <input type="number" min="0" class="form-control" id="rab_september" name="rab_september" required>
                        </div>
                        <div class="form-group">
                            <label for="rab_september">RAB Oktober</label>
                            <input type="number" min="0" class="form-control" id="rab_september" name="rab_oktober" required>
                        </div>
                        <div class="form-group">
                            <label for="rab_september">RAB November</label>
                            <input type="number" min="0" class="form-control" id="rab_september" name="rab_november" required>
                        </div>
                        <div class="form-group">
                            <label for="rab_desember">RAB Desember</label>
                            <input type="number" min="0" class="form-control" id="rab_desember" name="rab_desember" required>
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
<script>
    function showYears() {
      var yearInput = document.getElementById('yearInput').value;
      alert("Tahun yang dipilih: " + yearInput);
    }
  </script>
@endsection

