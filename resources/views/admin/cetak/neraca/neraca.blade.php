<html>
    <head>
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
       
    </head>
    <body>
        <div class="container">
  
            <table>
                <thead>
                    <tr id="header-text">
                        <th rowspan="2">NOMOR DAN NAMA PERKIRAAN</th>
                        <th colspan="2">JUMLAH SD AKHIR THN.YBL AWAL THN.INI</th>
                        <th colspan="2">MUTASI BULAN INI</th>
                        <th colspan="2">MUTASI SAMPAI DENGAN BULAN INI</th>
                        <th colspan="2">JUMLAH SD.BULAN INI/PD.TAHUN INI</th>
                        <th >RAB SD.BL.INI</th>
                    </tr>
                    <tr id="header-text">
                        <th>DEBIT</th>
                        <th>KREDIT</th>
                        <th>DEBIT</th>
                        <th>KREDIT</th>
                        <th>DEBIT</th>
                        <th>KREDIT</th>
                        <th>DEBIT</th>
                        <th>KREDIT</th>
                        <th>DEBIT</th>
                        
                    </tr>
                </thead>
                <tbody>
                    @foreach ($totalsPerGolongan as $golongan1=> $totalPerGolongan)
                    @php
                        $totaldebitsaldoawal_rubik=0;
                        $totalkreditsaldoawal_rubik=0;
                        $totalkasbankdebitgolongan_rubik=0;
                        $totalkasbankkreditgolongan_rubik=0;
                        $totalsampaibulaninikasbankdebitgolongan_rubik=0;
                        $totalsampaibulaninikasbankkreditgolongan_rubik=0;
                        $totaljumlahdebitsampaibulaninigolongan_rubik=0;
                        $totaljumlahkreditsampebulaninigolongan_rubik=0;
                    @endphp
                    @foreach ($totalsPerGolongan[$golongan1 ] as $golongan=> $totalPerGolongan)
                    @php
                        $totaldebitsaldoawal=0;
                        $totalkreditsaldoawal=0;
                        $totalkasbankdebitgolongan=0;
                        $totalkasbankkreditgolongan=0;
                        $totalsampaibulaninikasbankdebitgolongan=0;
                        $totalsampaibulaninikasbankkreditgolongan=0;
                        $totaljumlahdebitsampaibulaninigolongan=0;
                        $totaljumlahkreditsampebulaninigolongan=0;
                    @endphp
                       
                    @foreach ($totalPerGolongan as $golongan2=>$total)
                    @php
                    $totalDebit = 0;
                    $totalKredit = 0;
                    $totalkasbankDebit=0;
                    $totalkasbankKredit=0;
                    $totalsampaibulaninikasbankDebit=0;
                    $totalsampaibulaninikasbankKredit=0;
                    $jumlahdebitsampaibulanini=0;
                    $jumlahkreditsampaibulanini=0;
                    $saldoawaldebit=0;
                    $saldoawalkredit=0;
                    $jumlahtotaldebit=0;
                    $jumlahtotalkredit=0;
                @endphp
                    @foreach ($totalPerGolongan[$golongan2]['details'] as $detail)
                    <tr>
                        <td style="text-align: left;">{{ $detail['kode'] }} |{{ $detail['uraian'] }}</td>
                        @if ($detail['jenis']=='debit')
                            <td>{{number_format($detail['saldo_awal'], 2, ',', '.')}}</td>
                            <td>{{number_format(0, 2, ',', '.')}}</td>
                    @php
                    $saldoawaldebit=$detail['saldo_awal'];
                        $totalDebit += $detail['saldo_awal'];
                    @endphp
                        @else
                        <td>{{number_format(0, 2, ',', '.')}}</td>
                        <td>{{number_format($detail['saldo_awal'], 2, ',', '.')}}</td>
                        @php
                        $saldoawalkredit=$detail['saldo_awal'];
                        $totalKredit += $detail['saldo_awal'];
                    @endphp
                        @endif
                        <td>{{number_format($detail['kasbank_debit'], 2, ',', '.')}}</td>
                        <td>{{number_format($detail['kasbank_kredit'], 2, ',', '.')}}</td>
                        @php
                        $totalkasbankDebit += $detail['kasbank_debit'];
                        $totalkasbankKredit += $detail['kasbank_kredit'];
                         @endphp
                         <td>{{number_format($detail['sampaibulaninikasbank_debit'], 2, ',', '.')}}</td>
                         <td>{{number_format($detail['sampaibulaninikasbank_kredit'], 2, ',', '.')}}</td>
                         @php
                         $totalsampaibulaninikasbankDebit += $detail['sampaibulaninikasbank_debit'];
                         $totalsampaibulaninikasbankKredit += $detail['sampaibulaninikasbank_kredit'];
                          @endphp
                          @if ($detail['jenis']=='debit')
                          <td>
                            {{number_format($saldoawaldebit+$detail['sampaibulaninikasbank_debit']-$detail['sampaibulaninikasbank_kredit'], 2, ',', '.')}}
                            </td>
                          <td>0</td>
                          @php
                          $jumlahtotaldebit += $saldoawaldebit+$detail['sampaibulaninikasbank_debit']-$detail['sampaibulaninikasbank_kredit'];
                           @endphp
                        @else 
                        <td>0</td>
                        <td>
                            {{number_format($saldoawalkredit+$detail['sampaibulaninikasbank_kredit']-$detail['sampaibulaninikasbank_debit'], 2, ',', '.')}}
                        </td> 
                        @php
                          $jumlahtotalkredit += $saldoawalkredit+$detail['sampaibulaninikasbank_kredit']-$detail['sampaibulaninikasbank_debit'];
                           @endphp
                          @endif
                          <td>0</td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="10" style="text-align: right;">================================================================================================================================</td>
                </tr>
                <tr>
                    <td style="text-align: left;">Jumlah Perkiraan Utama :{{ $golongan2 }}</td>
                    <td>{{ number_format($totalDebit, 2, ',', '.') }}</td>
                    <td>{{ number_format($totalKredit, 2, ',', '.') }}</td>
                    <td>{{ number_format($totalkasbankDebit, 2, ',', '.') }}</td>
                    <td>{{ number_format($totalkasbankKredit, 2, ',', '.') }}</td>
                    <td>{{ number_format($totalsampaibulaninikasbankDebit, 2, ',', '.') }}</td>
                    <td>{{ number_format($totalsampaibulaninikasbankKredit, 2, ',', '.') }}</td>
                    <td>{{ number_format($jumlahtotaldebit, 2, ',', '.') }}</td>
                    <td>{{ number_format($jumlahtotalkredit, 2, ',', '.') }}</td>
                    <td>0</td>
                    @php
                        $totaldebitsaldoawal+=$totalDebit;
                        $totalkreditsaldoawal+=$totalKredit;
                        $totalkasbankdebitgolongan+=$totalkasbankDebit;
                        $totalkasbankkreditgolongan+=$totalkasbankKredit;
                        $totalsampaibulaninikasbankdebitgolongan+=$totalsampaibulaninikasbankDebit;
                        $totalsampaibulaninikasbankkreditgolongan+=$totalsampaibulaninikasbankKredit;
                        $totaljumlahdebitsampaibulaninigolongan+=$jumlahtotaldebit;
                        $totaljumlahkreditsampebulaninigolongan+=$jumlahtotalkredit;
                    @endphp
                </tr>
                <tr>
                    <td colspan="10" style="text-align: right;">================================================================================================================================</td>
                </tr>
                    @endforeach
                    <td style="text-align: left;">Jumlah Golongan :{{ $golongan }}</td>
                    <td>{{ number_format($totaldebitsaldoawal, 2, ',', '.') }}</td>
                    <td>{{ number_format($totalkreditsaldoawal, 2, ',', '.') }}</td>
                    <td>{{ number_format($totalkasbankdebitgolongan, 2, ',', '.') }}</td>
                    <td>{{ number_format($totalkasbankkreditgolongan, 2, ',', '.') }}</td>
                    <td>{{ number_format($totalsampaibulaninikasbankdebitgolongan, 2, ',', '.') }}</td>
                    <td>{{ number_format($totalsampaibulaninikasbankkreditgolongan, 2, ',', '.') }}</td>
                    <td>{{ number_format($totaljumlahdebitsampaibulaninigolongan, 2, ',', '.') }}</td>
                    <td>{{ number_format($totaljumlahkreditsampebulaninigolongan, 2, ',', '.') }}</td>
                    @php
                        $totaldebitsaldoawal_rubik+=$totaldebitsaldoawal;
                        $totalkreditsaldoawal_rubik+=$totalkreditsaldoawal;
                        $totalkasbankdebitgolongan_rubik+=$totalkasbankdebitgolongan;
                        $totalkasbankkreditgolongan_rubik+=$totalkasbankkreditgolongan;
                        $totalsampaibulaninikasbankdebitgolongan_rubik+=$totalsampaibulaninikasbankdebitgolongan;
                        $totalsampaibulaninikasbankkreditgolongan_rubik+=$totalsampaibulaninikasbankkreditgolongan;
                        $totaljumlahdebitsampaibulaninigolongan_rubik+=$totaljumlahdebitsampaibulaninigolongan;
                        $totaljumlahkreditsampebulaninigolongan_rubik+=$totaljumlahkreditsampebulaninigolongan;
                    @endphp
                    <tr>
                        <td colspan="10" style="text-align: right;">================================================================================================================================</td>
                    </tr>
                    @endforeach
                    
                    <tr>
                        <td style="text-align: left;">Jumlah Rubik :{{ $golongan1 }}</td>
                        <td>{{ number_format($totaldebitsaldoawal_rubik, 2, ',', '.') }}</td> 
                        <td>{{ number_format($totalkreditsaldoawal_rubik, 2, ',', '.') }}</td>
                        <td>{{ number_format($totalkasbankdebitgolongan_rubik, 2, ',', '.') }}</td>
                        <td>{{ number_format($totalkasbankkreditgolongan_rubik, 2, ',', '.') }}</td>
                        <td>{{ number_format($totalsampaibulaninikasbankdebitgolongan_rubik, 2, ',', '.') }}</td>
                        <td>{{ number_format($totalsampaibulaninikasbankkreditgolongan_rubik, 2, ',', '.') }}</td>
                        <td>{{ number_format($totaljumlahdebitsampaibulaninigolongan_rubik, 2, ',', '.') }}</td>
                        <td>{{ number_format($totaljumlahkreditsampebulaninigolongan_rubik, 2, ',', '.') }}</td>
                        @php
                            
                        @endphp
                    </tr>
                    <tr>
                        <td colspan="10" style="text-align: right;">================================================================================================================================</td>
                    </tr>
                    @endforeach
                    <tr>
                        <td>
                            REKAPITULASI
                        </td>
                    </tr>
                    <tr>
                        <td>
                            ============================
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align: left;">0  AKTIVA BENDA DAN MODAL</td>
                    </tr>
                    <tr>
                        <td style="text-align: left;">1  KEUANGAN</td>
                    </tr>
                    <tr>
                        <td style="text-align: left;">3  PERSEDIAAN BAHAN BRG. PERLENGKAPAN</td>
                    </tr>
                    <tr>
                        <td style="text-align: left;">4  JENIS BIAYA TAHUN INI</td>
                    </tr>
                    <tr>
                        <td style="text-align: left;">6  TEMPAT BIAYA TAHUN INI</td>
                    </tr>
                    <tr>
                        <td style="text-align: left;">8  PENDAP/PENGHAS TAHUN INI</td>
                    </tr>
                    <tr>
                        <td style="text-align: left;">9  LABA/RUGI TAHUN INI</td>
                    </tr>
               
                </tbody>  
            </table>
           
        </div>
        <script type="text/php">
            if ( isset($pdf) ) { 
                $pdf->page_script('
                    $font = $fontMetrics->get_font("Arial, Helvetica, sans-serif", "normal");
                    $size = 12;
                    $pageText = "HALAMAN : " . $PAGE_NUM . " dari " . $PAGE_COUNT;
                    $y = 40;
                    $x = 1020;
                    $pdf->text($x, $y, $pageText, $font, $size);
                    $pageText = "BULAN : DESEMBER 2023";
                    $y = 60;
                    $x = 1000;
                    $pdf->text($x, $y, $pageText, $font, $size);
                    $pageText = "NERACA SISA";
                    $y = 40;
                    $x = 520;
                    $pdf->text($x, $y, $pageText, $font, 24);
                    $headerText = "PT PERKEBUNAN KOPKAR PABRIK GULA DJATIROTO";
                    $pdf->text(130, 20, $headerText, $font, $size);
                    $headerText = "UNIT KERJA PTPN XI PG. JATIROTO";
                    $pdf->text(130, 40, $headerText, $font, $size);
                    $imagePath = public_path("logo.jpg"); // Ganti dengan path gambar Anda
                    $pdf->image($imagePath, 50, 70, 60, 0);
                    $html = \'
                    <table border="1" cellpadding="2" cellspacing="0">
                        <tr>
                            <th rowspan="2">No Bukti</th>
                            <th rowspan="2">NOMOR DAN NAMA PERKIRAAN</th>
                            <th colspan="2">JUMLAH SD AKHIR THN.YBL AWAL THN.INI</th>
                            <th colspan="2">MUTASI BULAN INI</th>
                            <th colspan="2">MUTASI SAMPAI DENGAN BULAN INI</th>
                            <th colspan="2">JUMLAH SD.BULAN INI/PD.TAHUN INI</th>
                            <th colspan="2">RAB SD.BL.INI</th>
                        </tr>
                        <tr>
                            <th>DEBIT</th>
                            <th>KREDIT</th>
                            <th>DEBIT</th>
                            <th>KREDIT</th>
                            <th>DEBIT</th>
                            <th>KREDIT</th>
                            <th>DEBIT</th>
                            <th>KREDIT</th>
                            <th>DEBIT</th>
                            <th>KREDIT</th>
                        </tr>
                        <!-- Add your table data here -->
                    </table>
                    \';
            
            ');
            }
        </script>
    </body>
</html>


