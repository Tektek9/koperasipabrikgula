<?php

namespace App\Http\Controllers;

use App\Models\penutup;
use App\Models\nomor_perkiraan;
use Illuminate\Http\Request;

class PenutupController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
        $data=$request->tanggal;
        if($data !=0){
            $penutups=penutup::where("tahun",$data)->get();
        }else{
            $penutups = penutup::all();

        }
        $memori=penutup::all();
        $semua=[];
        $total=0;
        foreach($memori as $memo){
            // Ambil data dari database berdasarkan nomor bukti
            $penutupEntries = penutup::where('nomor_bukti', $memo->nomor_bukti)->get();

            // Inisialisasi variabel untuk jumlah debit dan kredit
            $totalDebit = 0;
            $totalKredit = 0;

            // Iterasi melalui entri-entri data
            foreach ($penutupEntries as $entry) {
                // Periksa apakah jenis adalah debit atau kredit
                if ($entry['jenis'] === 'debit') {
                    $totalDebit += $entry['jumlah_uang'];
                } elseif ($entry['jenis'] === 'kredit') {
                    $totalKredit += $entry['jumlah_uang'];
                }
            }

            // Periksa apakah totalDebit lebih besar, lebih kecil, atau sama dengan totalKredit
            if ($totalDebit > $totalKredit) {
                $status = "belum balance";
            } elseif ($totalDebit === $totalKredit) {
                $status = "sudah balance";
            } else {
                $status = "sudah balance";
            }
             // Check if the 'nomor_bukti' already exists in $semua
    $index = array_search($memo->nomor_bukti, array_column($semua, 'nomor_bukti'));

    if ($index !== false) {
        // Update status if 'nomor_bukti' already exists
        $semua[$index]['status'] = $status;
    } else {
        $semua[] = [
            "nomor_bukti" => $memo->nomor_bukti,
            "status" => $status,
        ];
    }
        }
        // dd($semua);
        return view('admin.masukan_data_harian.memo_penutup.index', compact('penutups','semua'));
    }
    public function index2($no_bukti)
    {
        $penutups = penutup::where("nomor_bukti",$no_bukti)->get();
        $hasil_debit=0;
        $hasil_kredit=0;
        $selisih=0;
        $status="";
        foreach($penutups as $memori){
            if($memori->jenis=="debit"){
                $hasil_debit+=$memori->jumlah_uang;
            }else{
                $hasil_kredit+=$memori->jumlah_uang;
            }
        }
        if($hasil_debit!=$hasil_kredit){
            $status="belum belance";
            $selisih=$hasil_debit-$hasil_kredit;
        }else{
            $status="sudah belance";
            $selisih=0;
        }
        // dd($hasil_debit);
        return response()->json([
            "data"=>$penutups,
            "status"=>$status,
            "selisih"=>$selisih,
        ]);
    }

    public function create(Request $request)
    {
        $nomor_perkiraan=nomor_perkiraan::all();
        $data=$request->tahun;
        $no_bukti=null;
        if($data !=null){
            $dateWithoutYear = substr($data, 5);

            // Menghapus tanda "-" dari string
            $dateWithoutDashes = str_replace('-', '', $dateWithoutYear);
            $nilai=penutup::where("tahun",$request->tanggal)->orderBy('created_at','desc')->first();
            // dd($nilai);
            if($nilai != null){
                $nb=$nilai->nomor_bukti;
                $nb_int=(int)$nb+1;
                // dd(strval($nb_int));
                $no_bukti=strval($nb_int);
                $no_bukti=$nb;
            }else{
                // dd($dateWithoutDashes."001");
                $no_bukti=$dateWithoutDashes."001";
            }
        }
        return view('admin.masukan_data_harian.memo_penutup.create',compact('data','no_bukti','nomor_perkiraan'));
    }

    public function store(Request $request)
    {
        Penutup::create($request->all());
        return redirect()->route('penutups.index');
    }

    public function show(Penutup $penutup)
    {
        return view('penutups.show', compact('penutup'));
    }

   
    public function edit2($no_bukti)
    {
        $nomor_perkiraan=nomor_perkiraan::all();
          
        $penutup=penutup::where('nomor_bukti',$no_bukti)->first();

        return view('admin.masukan_data_harian.memo_penutup.edit', compact('penutup','nomor_perkiraan'));
    }
    public function edit(penutup $penutup)
    {
        return response()->json(['data' => $penutup]);
    }

    public function update(Request $request, Penutup $penutup)
    {
        $penutup->update($request->all());
        return redirect()->route('penutups.index');
    }

    public function destroy($id)
    {
        $penutup=penutup::find($id);
        $penutup->delete();
        return redirect()->route('penutups.index');
    }
    public function destroy2($id)
    {
        $penutup=penutup::where("nomor_bukti",$id)->delete();
        return redirect()->route('penutups.index');
    }
}
