@extends('admin.layout.core')

@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <p class="text-white mt-5 mb-5">Welcome back, <b>Admin</b></p>
        </div>
    </div>
   
    <div class="row">
        <div class="col-md-6">
            <table>
    <form  id="dataForm" method="post" action="/memorials">
        @csrf
            <tr>
                <td>Tanggal:</td>
                <td><input type="text" name="tanggal" value="{{$memorial->tanggal}}" readonly></td>
            </tr>
            <tr>
                <td>Nomor Bukti:</td>
                <td><input type="text" name="nomor_bukti" value="{{$memorial->nomor_bukti}}"></td>
            </tr>
            <tr>
                <td>Nomor Perkiraan:</td>
                <td>
                    <input type="text"  id="nomor_perkiraan" maxlength="10" name="nomor_perkiraan" required onchange="getNamaPerkiraan()">
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
                <td>Jenis:</td>
                <td>
                    <select  id="nomor_perkiraan" name="jenis" required >
                            <option value="" disabled selected>Pilih Jenis</option>
                                <option value="debit">Debit</option>
                                <option value="kredit">Credit</option>
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
                <td colspan="2"><a class="btn btn-primary" href="/memorials">selesai</a>
                </td>
            </tr>
    </form>
    <td colspan="2"><button id="tambahDataButton" class="btn btn-primary" onclick="tambahData()">Tambah Data</button></td>
</table>
        </div>
   
    <div class="col-md-6">
        <div class="table-responsive">
            <table class="table" id="dataContainer">
                <thead class="thead-dark">
                    <tr>
                        <th>Nomor Perkiraan</th>
                        <th>Deskripsi</th>
                        <th>UBL</th>
                        <th>Debit/Credit</th>
                        <th>Jumlah Uang</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
        
    </div>
    </div>
    
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    function tambahData() {
        $('#dataForm').attr('method', 'post'); // Mengubah metode formulir menjadi POST
        $.ajax({
            type: 'POST', // Mengirim data dengan metode POST
            url: '/memorials', // URL endpoint yang dituju
            data: $('#dataForm').serialize(), // Mengambil data dari formulir
            success: function (response) {
                console.log(response);
                // Menghapus nilai-nilai formulir setelah pengiriman berhasil
                $('#dataForm')[0].reset();
            }
        });
    }
</script>
<script>
    $(document).ready(function () {
        $('#dataForm').on('submit', function (e) {
            e.preventDefault();
            var method = $(this).attr('method'); // Ambil metode formulir
            var url = $(this).attr('action'); // Ambil URL formulir

            $.ajax({
                type: method, // Gunakan metode formulir
                url: url,
                data: method === 'POST' ? $(this).serialize() : $(this).serialize() + "&_method=PUT", // Sesuaikan data berdasarkan metode
                success: function (response) {
                    // console.log(response);
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
            url: '/api/memorials/{{$memorial->nomor_bukti}}',
            type: 'GET',
            dataType: 'json',
            success: function (data) {
                // Bersihkan kontainer sebelum menambahkan data baru
                $('#dataContainer tbody').empty();
                // console.log(data);
                // Lakukan iterasi terhadap data dan tampilkan di halaman
                var dataContainer = $('#dataContainer');
                data.data.forEach(function (item) {
                    var row = $('<tr>');
                    row.append($('<td>').text(item.nomor_perkiraan));
                    row.append($('<td>').text(item.deskripsi));
                    row.append($('<td>').text(item.ubl));
                    row.append($('<td>').text(item.jenis));
                    row.append($('<td>').text(item.jumlah_uang.toLocaleString()));
                        var editButton = $('<button>', {
                        text: 'Edit',
                        click: function () {
                            // Fungsi yang akan dijalankan saat tombol Edit diklik
                            editFunction(item);
                        }
                    });
                    row.append($('<td>').append(editButton));

                    // Tombol Delete
                    var deleteButton = $('<button>', {
                        text: 'Delete',
                        click: function () {
                            // Fungsi yang akan dijalankan saat tombol Delete diklik
                            deleteFunction(item);
                        }
                    });
                    row.append($('<td>').append(deleteButton));
                    $('#dataContainer tbody').append(row);
                // console.log(item.tanggal);
                // totalAmount += parseFloat(item.jumlah_uang);
                });
                var totalRow = $('<tr>');
                totalRow.append('<td colspan="4"><b>Status:</b></td>');
                totalRow.append($('<td>').text(data.status));
                $('#dataContainer tbody').append(totalRow);
                var totalRow2 = $('<tr>');
                totalRow2.append('<td colspan="4"><b>Selisih:</b></td>');
                totalRow2.append($('<td>').text(data.selisih.toLocaleString()));
                $('#dataContainer tbody').append(totalRow2);
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
    function editFunction(item) {
        $.ajax({
        type: "GET",
        url: "/memorials/" + item.id + "/edit", // Ganti dengan URL yang sesuai
        success: function(response) {
            console.log(response);
            // Isi formulir dengan data yang diterima
            $('input[name="tanggal"]').val(response.data.tanggal);
            $('select[name="jenis"]').val(response.data.jenis);
            $('input[name="nomor_bukti"]').val(response.data.nomor_bukti);
            $('select[name="nomor_perkiraan"]').val(response.data.nomor_perkiraan);
            $('textarea[name="deskripsi"]').val(response.data.deskripsi);
            $('select[name="ubl"]').val(response.data.ubl);
            $('input[name="jumlah_uang"]').val(response.data.jumlah_uang);
            $('#dataForm').attr('action', '/memorials/' + item.id);
        },
        error: function(error) {
            // Tangani kesalahan jika terjadi
            console.log(error);
        }
    });
}

function deleteFunction(item) {
      $.ajax({
        type: 'get',
        url: '/memorials/delete/' + item.id, // Ganti dengan URL yang sesuai
        success: function (response) {
            console.log(response);
            // Tambahkan logika tambahan di sini setelah penghapusan berhasil
        },
        error: function (error) {
            console.log(error);
            // Tambahkan logika penanganan kesalahan di sini
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
@endsection

