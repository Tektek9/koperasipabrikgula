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
        
        <div class="container mt-5">
        
            @if ($request->sesuai_dengan==null)
            <h2 class="mb-4">Pilih sesuai Cetak</h2>
            <form id="myForm" method="GET" action="/cetak/buku_besar/no_perkiraan/view">
              <div class="form-group">
                <label for="tanggal">Cetak sesuai dengan:</label>
                <select class="form-control" id="selectPerkiraan" name="sesuai_dengan" required>
                  <option value="per_Tanggal">Urut Tanggal</option>
                  <option value="per_noperkiraan">Urut Perkiraan</option>
                </select>
              </div>
        
              <button type="submit" class="btn btn-primary" >Submit</button>
            </form>
            @elseif ($request->sesuai_dengan=='per_Tanggal')
            <h2 class="mb-4">Pilih tanggal cetak</h2>
            <form id="myForm" method="GET" action="/cetak/buku_besar/tanggal">
              <div class="form-group">
                <label for="tanggal">Pilih Tanggal Awal :</label>
                <input type="date" class="form-control" id="tanggal" name="tanggal_awal" required>
              </div>
              <div class="form-group">
                <label for="tanggal">Pilih Tanggal Akhir :</label>
                <input type="date" class="form-control" id="tanggal" name="tanggal_akhir" required>
              </div>
              
              <button type="submit" class="btn btn-primary" >Submit</button>
            </form>
            @else
            <h2 class="mb-4">Pilih tanggal cetak</h2>
            <form id="myForm" method="GET" action="/cetak/buku_besar/no_perkiraan">
              <div class="form-group">
                <label for="tanggal">Pilih no perkiraan :</label>
                <input class="form-control" type="text"  id="nomor_perkiraan2" maxlength="10" name="nomor_perkiraan" required onchange="getNamaPerkiraan()">
                <div id="searchResults2" class="mt-2"></div>
              </div>
        
              <button type="submit" class="btn btn-primary" >Submit</button>
            </form>
            @endif
            
          </div>
       
       
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
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

