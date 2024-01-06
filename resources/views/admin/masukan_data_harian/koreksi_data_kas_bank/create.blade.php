@extends('admin.layout.core')

@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <p class="text-white mt-5 mb-5">Welcome back, <b>Admin</b></p>
        </div>
    </div>
    <!-- row -->
    @if ($data==null)
    <div class="row tm-content-row">
        <form action="/data_kas_banks/create" method="get">
            @csrf
            <div class="form-group">
                <label for="tanggal">Tanggal:</label>
                <input type="date" class="form-control" id="tanggal" name="tanggal">
            </div>
            <div class="form-group">
                <label for="jenis">Jenis:</label>
                <select class="form-control" id="jenis" name="jenis">
                    <option value="Masuk">Masuk</option>
                    <option value="Keluar">Keluar</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    @else
    <div class="row">
        <div class="col-md-6">
    <form  id="dataForm" method="post" action="/data_kas_banks">
        @csrf
        <table>
            <tr>
                <td>Tanggal:</td>
                <td><input type="text" name="tanggal" value="{{$data}}" readonly></td>
            </tr>
            <tr>
                <td>Jenis:</td>
                <td><input type="text" name="jenis" value="{{$jenis}}" readonly></td>
            </tr>
            <tr>
                <td>Nomor Bukti:</td>
                <td><input type="text" name="nomor_bukti" value="{{$no_bukti}}"></td>
            </tr>
            <tr>
                <td>Nomor Perkiraan:</td>
                <td>
                    <input type="text"  id="nomor_perkiraan2" maxlength="10" name="nomor_perkiraan" required onchange="getNamaPerkiraan()">
                    <div id="searchResults2" class="mt-2"></div>
                </td>
            </tr>
            <tr>
                <td>Nomor Perkiraan Lawan:</td>
                <td>
                    <input type="text"  id="nomor_perkiraan" maxlength="10" name="nomor_perkiraan_lawan" required onchange="getNamaPerkiraan()">
                <div id="searchResults" class="mt-2"></div>
                </td>
            </tr>
            <tr>
                <td>Deskripsi:</td>
                <td><textarea name="deskripsi" id="" cols="20" rows="5"></textarea></td>
            </tr>
            <tr>
                <td>UBL:</td>
                <td>
                    <select  id="nomor_perkiraan" name="ubl" required >
                            <option value="" disabled selected>Pilih UBL</option>
                                <option value="upah">Upah</option>
                                <option value="bahan">Bahan</option>
                                <option value="lain-lain">Lain-lain</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Jumlah Uang:</td>
                <td><input type="text" name="jumlah_uang" ></td>
                <input type="hidden" class="form-control" id="uraian" name="created_by" value="{{Auth::user()->name}}">
            </tr>
            <tr>
                <td colspan="2"><input type="submit" value="Submit"></td>
                <td colspan="2"><a class="btn btn-primary" href="/data_kas_banks">selesai</a>
                </td>
            </tr>
        </table>
    </form>
        </div>
   
    <div class="col-md-6">
        <div class="table-responsive">
            <table class="table" id="dataContainer">
                @if($jenis=='Masuk')
                <thead class="thead-primary bg-info">
                @else
                <thead class="thead-warning bg-danger">
                    @endif
                    <tr>
                        <th>Nomor Perkiraan Lawan</th>
                        <th>Deskripsi</th>
                        <th>UBL</th>
                        <th>Jumlah Uang</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
        
    </div>
    </div>
    @endif
    
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function () {
        $('#dataForm').on('submit', function (e) {
            e.preventDefault();
            $.ajax({
                type: 'post',
                url: $(this).attr('action'),
                data: $(this).serialize(),
                success: function (response) {
                    console.log(response);
                    // Menghapus nilai-nilai formulir setelah pengiriman berhasil
                    $('#dataForm')[0].reset();
                }
            });
        });
    });
</script>
<script>
   $(document).ready(function () {
    function getData() {
        $.ajax({
            url: '/api/data_kas_banks/{{$no_bukti}}',
            type: 'GET',
            dataType: 'json',
            success: function (data) {
                // Bersihkan kontainer sebelum menambahkan data baru
                $('#dataContainer tbody').empty();
                console.log(data);
                // Lakukan iterasi terhadap data dan tampilkan di halaman
                var dataContainer = $('#dataContainer');
                data.data.forEach(function (item) {
                    var row = $('<tr>');
                    row.append($('<td>').text(item.nomor_perkiraan_lawan));
                    row.append($('<td>').text(item.deskripsi));
                    row.append($('<td>').text(item.ubl));
                    row.append($('<td>').text(item.jumlah_uang.toLocaleString()));
                    $('#dataContainer tbody').append(row);
                // console.log(item.tanggal);
                // totalAmount += parseFloat(item.jumlah_uang);
                });
                var totalRow = $('<tr>');
                totalRow.append('<td colspan="3"><b>Total Jumlah Uang:</b></td>');
                totalRow.append($('<td>').text(data.jumlah));
                $('#dataContainer tbody').append(totalRow);
                // Panggil fungsi lagi setelah beberapa waktu
                setTimeout(getData, 1000); // Panggil setiap 5 detik (5000 milidetik)
            },
            error: function (error) {
                // Tampilkan pesan kesalahan jika terjadi
                console.log(error);

                // Coba panggil lagi setelah beberapa waktu jika terjadi kesalahan
                setTimeout(getData, 1000); // Panggil setiap 5 detik (5000 milidetik)
            }
        });
    }

    // Panggil fungsi pertama kali
    getData();
});

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
<script>
    $(document).ready(function () {
        $('#nomor_perkiraan2').on('input', function () {
            var nomorPerkiraan = $(this).val();

            // Kirim permintaan Ajax ke server
            $.ajax({
                url: '/get-nama-perkiraan/' + nomorPerkiraan,
                type: 'GET',
                success: function (data) {
                     // Kosongkan elemen searchResults sebelum menambahkan data baru
                     $('#searchResults2').empty();

                    // Iterasi melalui data dan tambahkan elemen div untuk setiap item
                    $.each(data, function (index, item) {
                        $('#searchResults2').append('<div class="dropdown-item">' + item.kode + ' | ' + item.uraian + '</div>');
                    });
                },
                error: function (error) {
                    console.log(error);
                }
            });
        });
        $('#searchResults2').on('click', '.dropdown-item', function () {
    // Get the text content of the clicked item
    var selectedItemText = $(this).text();
    var parts = selectedItemText.split('|').map(function (part) {
return part.trim();
});

    // Extract nomor_perkiraan from the text (assuming it is separated by '|')
    var nomorPerkiraan = selectedItemText.split('|')[0].trim();

    // Set the value of nomor_perkiraan input
    $('#nomor_perkiraan2').val(nomorPerkiraan);
// Extract uraian from the data attribute
var uraian = parts[1];
console.log(uraian);
// Set the value of nama_perkiraan input
$('#nama_perkiraan2').val(uraian);
    // Clear the dropdown after selecting an item (optional)
    $('#searchResults2').empty();
});
    });
</script>
@endsection

