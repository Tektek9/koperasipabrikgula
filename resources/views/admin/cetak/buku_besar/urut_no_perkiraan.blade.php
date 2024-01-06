
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            text-align: center;
        }
        .title {
            font-size: 24px;
            font-weight: bold;
        }
        .subtitle {
            font-size: 18px;
            font-weight: bold;
        }
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            padding: 8px;
            text-align: center;
        }
        body {
            font-family: Arial, sans-serif;
            text-align: center;
        }
        #header {
            margin-bottom: 20px;
        }
        #logo {
            float: left;
            height: 50px; /* Sesuaikan dengan tinggi tulisan */
            /* margin-right: 5px; */
        }
        h1, h2 {
            margin: 0;
        }
        #header {
            display: flex;
            align-items: center;
        }
        
        #logo {
            width: 80px; /* Sesuaikan lebar sesuai kebutuhan */
            height: auto; /* Sesuaikan tinggi sesuai kebutuhan atau biarkan otomatis */
        }
        
        #header-text {
            margin-left: 20px; /* Sesuaikan jarak dari logo sesuai kebutuhan */
        }
        @page :first {
            margin-top: 30mm; /* Margin top untuk halaman pertama */
        }

        @page {
            margin-top: 30mm; /* Margin top untuk halaman ke-2 dan seterusnya */
        }
        table {
        width: 100%;
        border-collapse: collapse;
        }

        thead {
            display: table-header-group;
        }

        #header-text {
            background-color: #ccc; /* Atur warna latar belakang header sesuai kebutuhan Anda */
        }

    </style>
    <div class="container">
        <div id="header">
            <img id="logo" src="{{$base64}}" alt="Logo">
            <h1>KOPERASI KONSUMEN KARYAWAN<br> PABRIK GULA DJATIROTO</h1>
            <h4><br>BUKU BESAR PER 31 DESEMBER 2022 DAN 31 DESEMBER 2023</h4>
        </div>

        <table>
            <tr id="header-text">
                <th>Tanggal</th>
                <th>ID</th>
                <th>Nomer Perkiraan</th>
                <th>URAIAN</th>
                <th>JENIS</th>
                <th>SALDO</th>
            </tr>
            <tr>
                <th>...</th>
                <th>...</th>
                <th>...</th>
                <th>...</th>
                <th>...</th>
                <th>...</th>
            </tr>
        </table>
    </div>