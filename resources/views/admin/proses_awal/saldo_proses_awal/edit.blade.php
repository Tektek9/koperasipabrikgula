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
        <form method="POST" action="/saldo_awals/{{$saldo_awal->id}}">
            @csrf
            @method("PUT")
            <div class="form-group">
                <label for="nomor_perkiraan">Nomor Perkiraan</label>
                <input type="text" class="form-control" id="nomor_perkiraan" maxlength="10" name="nomor_perkiraan" required readonly value="{{$saldo_awal->nomor_perkiraan}}">
                <div id="searchResults" class="mt-2"></div>
            </div>
            <div class="form-group">
                <label for="nama_perkiraan">Nama Perkiraan</label>
                <input type="text" class="form-control" id="nama_perkiraan" name="nama_perkiraan" required value="{{$saldo_awal->nama_perkiraan}}">
            </div>
            <div class="form-group">
                <label for="jenis">Jenis</label>
                <select class="form-control" id="jenis" name="jenis" required>
                    <option value="{{$saldo_awal->jenis}}" disabled selected>{{$saldo_awal->jenis}}</option>
                    <option value="debit">Debit</option>
                    <option value="kredit">Kredit</option>
                </select>
            </div>
            <div class="form-group">
                <label for="saldo_awal">Saldo Awal</label>
                <input type="number"  class="form-control" id="saldo_awal" name="saldo_awal" required value="{{$saldo_awal->saldo_awal}}">
            </div>
            <input type="hidden" class="form-control" id="uraian" name="created_by" value="{{Auth::user()->name}}">
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        <script>
            function getNamaPerkiraan() {
                let nomorPerkiraan = document.getElementById('nomor_perkiraan').value;
                console.log(nomorPerkiraan);
                if (nomorPerkiraan !== '') {
                    fetch(`/saldo_awal/${nomorPerkiraan}`)
                        .then(response => response.json())
                        .then(data => {
                            let select = document.getElementById('jenis');
                            let option = document.createElement('option');
                            option.value = data[0].jenis; 
                            option.text = data[0].jenis; 
                                option.selected = true; // memilih opsi 'kredit' secara otomatis
                            select.appendChild(option);
                            console.log(data[0].nama_perkiraan);
                            document.getElementById('nama_perkiraan').value = data[0].nama_perkiraan;
                            document.getElementById('saldo_awal').value = data[0].saldo_awal;
                        })
                        .catch(error => {
                            console.error('Error:', error);
                        });
                }
            }
        </script>
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        <script>
            $(document).ready(function () {
                $('#nomor_perkiraan').on('input', function () {
                    var nomorPerkiraan = $(this).val();
        
                    // Kirim permintaan Ajax ke server
                    $.ajax({
                        url: '/get-nama-perkiraan/' + nomorPerkiraan,
                        type: 'GET',
                        success: function (data) {
                             // Kosongkan elemen searchResults sebelum menambahkan data baru
                             $('#searchResults').empty();

                            // Iterasi melalui data dan tambahkan elemen div untuk setiap item
                            $.each(data, function (index, item) {
                                $('#searchResults').append('<div class="dropdown-item">' + item.kode + ' | ' + item.uraian + '</div>');
                            });
                        },
                        error: function (error) {
                            console.log(error);
                        }
                    });
                });
                $('#searchResults').on('click', '.dropdown-item', function () {
            // Get the text content of the clicked item
            var selectedItemText = $(this).text();
            var parts = selectedItemText.split('|').map(function (part) {
        return part.trim();
    });

            // Extract nomor_perkiraan from the text (assuming it is separated by '|')
            var nomorPerkiraan = selectedItemText.split('|')[0].trim();

            // Set the value of nomor_perkiraan input
            $('#nomor_perkiraan').val(nomorPerkiraan);
// Extract uraian from the data attribute
var uraian = parts[1];
console.log(uraian);
// Set the value of nama_perkiraan input
$('#nama_perkiraan').val(uraian);
            // Clear the dropdown after selecting an item (optional)
            $('#searchResults').empty();
        });
            });
        </script>
       
       
    </div>
</div>
@endsection

