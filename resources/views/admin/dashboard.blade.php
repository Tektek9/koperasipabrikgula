@extends('admin.layout.core')

@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <p class="text-white mt-5 mb-5">Welcome back, <b>Admin</b></p>
        </div>
    </div>
    <!-- row -->
    <div class="container my-5">
        <h1 class="mb-4 text-white">Tutorial Penggunaan Aplikasi</h1>
        
        <button class="btn btn-info mt-3" onclick="showTutorial('langkah1')">Langkah 1: Mengisi nomor perkiraan</button>
        <button class="btn btn-info mt-3" onclick="showTutorial('langkah2')">Langkah 2: Mengisi Rab Tahun Ini</button>
        <button class="btn btn-info mt-3" onclick="showTutorial('langkah3')">Langkah 3: Isi Proses Saldo Awal</button>
        <button class="btn btn-info mt-3" onclick="showTutorial('langkah4')">Langkah 4: Koreksi Masukan Data Kas Bank</button>
        <button class="btn btn-info mt-3" onclick="showTutorial('langkah5')">Langkah 5: Masukan Koreksi Data Manual</button>
        <button class="btn btn-info mt-3" onclick="showTutorial('langkah6')">Langkah 6: Masukan Koreksi Data Memo Suplement</button>
        <button class="btn btn-info mt-3" onclick="showTutorial('langkah7')">Langkah 7: Masukan Koreksi Data Memo Penutup</button>
      
        <div class="tutorial mt-3 text-white" id="langkah1" style="display:none;">
          <h2>Langkah 1: Mengisi Nomor Perkiraan</h2>
          <p>Langkah Pertama adalah mengisi nomor perkiraan yang akan di gunakan</p>
          <ul>
            <li>
                pilih menu nomor perkiraan di atas
            </li>
            <li>
                create data
            </li>
            <li>
                isi kode dan uraian sesuai dengan yang di tentukan
            </li>
            <li>
                kemudian submit
            </li>
          </ul>
          <p>apabila ingin mengedit dan menghapus data terdapat button edit dan hapus di pojok kanan setiap kolom data yang di tampilkan di nomor perkiraan
          </p>
          <h1>video tutorial</h1>

            <video width="320" height="240" controls>
                <source src="{{asset('langkah1.mkv')}}" type="video/mp4">
                Your browser does not support the video tag.
            </video>

        </div>
      
        <div class="tutorial mt-3 text-white" id="langkah2" style="display:none;">
          <h2>Langkah 2: Mengisi Rab Tahun Ini</h2>
          <p>langkah kedua yakni mengisi rab tahun ini</p>
          <ul>
            <li>
                pilih menu proses awal kemudian klik isi rab tahun ini
            </li>
            <li>
                create data
            </li>
            <li>
                isi tahun untuk rab nya
            </li>
            <li>
                isikan rab setiab bulanya
            </li>
            <li>
                lemudian submit
            </li>
          </ul>
          <p>apabila ingin mengedit dan menghapus data terdapat button edit dan hapus di pojok kanan setiap kolom data yang di tampilkan di rab tahun ini 
            dengan cara geser kurser ke kanan ada fied acion dengan button edit dan hapus
          </p>
          <h1>video tutorial</h1>

          <video width="320" height="240" controls>
              <source src="{{asset('langkah2.mkv')}}" type="video/mp4">
              Your browser does not support the video tag.
          </video>
        </div>
      
        <div class="tutorial mt-3 text-white" id="langkah3" style="display:none;">
            <h2>Langkah 3: isi Proses Saldo Awal</h2>
            <p>langkah kedua yakni isi Proses Saldo Awal</p>
            <ul>
              <li>
                  pilih menu proses awal kemudian klik isi rab tahun ini
              </li>
              <li>
                  create data
              </li>
              <li>
                  isi tahun untuk rab nya
              </li>
              <li>
                  isikan rab setiab bulanya
              </li>
              <li>
                  lemudian submit
              </li>
            </ul>
            <p>apabila ingin mengedit dan menghapus data terdapat button edit dan hapus di pojok kanan setiap kolom data yang di tampilkan di rab tahun ini 
              dengan cara geser kurser ke kanan ada fied acion dengan button edit dan hapus
            </p>
            <h1>video tutorial</h1>

          <video width="320" height="240" controls>
              <source src="{{asset('langkah3.mkv')}}" type="video/mp4">
              Your browser does not support the video tag.
          </video>
          </div>
          <div class="tutorial mt-3 text-white" id="langkah4" style="display:none;">
            <h2>Langkah 4:koreksi masukan data kas Bank</h2>
            <p>langkah kedua yaknikoreksi masukan data kas Bank</p>
            <ul>
              <li>
                  pilih menu proses awal kemudian klik isi rab tahun ini
              </li>
              <li>
                  create data
              </li>
              <li>
                  isi tahun untuk rab nya
              </li>
              <li>
                  isikan rab setiab bulanya
              </li>
              <li>
                  lemudian submit
              </li>
            </ul>
            <p>apabila ingin mengedit dan menghapus data terdapat button edit dan hapus di pojok kanan setiap kolom data yang di tampilkan di rab tahun ini 
              dengan cara geser kurser ke kanan ada fied acion dengan button edit dan hapus
            </p>
            <h1>video tutorial</h1>

          <video width="320" height="240" controls>
              <source src="{{asset('langkah4.mkv')}}" type="video/mp4">
              Your browser does not support the video tag.
          </video>
          </div>
          <div class="tutorial mt-3 text-white" id="langkah5" style="display:none;">
            <h2>Langkah 5: masukan koreksi data memorial</h2>
            <p>langkah kedua yakni masukan koreksi data memorial</p>
            <ul>
              <li>
                  pilih menu proses awal kemudian klik isi rab tahun ini
              </li>
              <li>
                  create data
              </li>
              <li>
                  isi tahun untuk rab nya
              </li>
              <li>
                  isikan rab setiab bulanya
              </li>
              <li>
                  lemudian submit
              </li>
            </ul>
            <p>apabila ingin mengedit dan menghapus data terdapat button edit dan hapus di pojok kanan setiap kolom data yang di tampilkan di rab tahun ini 
              dengan cara geser kurser ke kanan ada fied acion dengan button edit dan hapus
            </p>
            <h1>video tutorial</h1>

            <video width="320" height="240" controls>
                <source src="{{asset('langkah5.mkv')}}" type="video/mp4">
                Your browser does not support the video tag.
            </video>
          </div>
          <div class="tutorial mt-3 text-white" id="langkah6" style="display:none;">
            <h2>Langkah 6: masukan koreksi data memo suplement</h2>
            <p>langkah kedua yakni masukan koreksi data memo suplement</p>
            <ul>
              <li>
                  pilih menu proses awal kemudian klik isi rab tahun ini
              </li>
              <li>
                  create data
              </li>
              <li>
                  isi tahun untuk rab nya
              </li>
              <li>
                  isikan rab setiab bulanya
              </li>
              <li>
                  lemudian submit
              </li>
            </ul>
            <p>apabila ingin mengedit dan menghapus data terdapat button edit dan hapus di pojok kanan setiap kolom data yang di tampilkan di rab tahun ini 
              dengan cara geser kurser ke kanan ada fied acion dengan button edit dan hapus
            </p>
            <h1>video tutorial</h1>

            <video width="320" height="240" controls>
                <source src="{{asset('langkah6.mkv')}}" type="video/mp4">
                Your browser does not support the video tag.
            </video>
          </div>
          <div class="tutorial mt-3 text-white" id="langkah7" style="display:none;">
            <h2>Langkah 7: masukan koreksi data penutup</h2>
            <p>langkah kedua yakni masukan koreksi data penutup</p>
            <ul>
              <li>
                  pilih menu proses awal kemudian klik isi rab tahun ini
              </li>
              <li>
                  create data
              </li>
              <li>
                  isi tahun untuk rab nya
              </li>
              <li>
                  isikan rab setiab bulanya
              </li>
              <li>
                  lemudian submit
              </li>
            </ul>
            <p>apabila ingin mengedit dan menghapus data terdapat button edit dan hapus di pojok kanan setiap kolom data yang di tampilkan di rab tahun ini 
              dengan cara geser kurser ke kanan ada fied acion dengan button edit dan hapus
            </p>
            <h1>video tutorial</h1>

            <video width="320" height="240" controls>
                <source src="{{asset('langkah6.mkv')}}" type="video/mp4">
                Your browser does not support the video tag.
            </video>
          </div>
      </div>
      
      <!-- Bootstrap Bundle with Popper -->
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
      
      <script>
        function showTutorial(id) {
          // Menyembunyikan semua elemen dengan kelas tutorial mt-3
          var tutorials = document.getElementsByClassName("tutorial");
          for (var i = 0; i < tutorials.length; i++) {
            tutorials[i].style.display = "none";
          }
          // Menampilkan elemen dengan id yang sesuai dengan tombol yang diklik
          var element = document.getElementById(id);
          if (element) {
            element.style.display = "block";
          }
        }
      </script>
</div>
@endsection

