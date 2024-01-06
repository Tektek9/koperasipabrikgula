<?php

namespace App\Http\Controllers;

use App\Models\memorial;
use Illuminate\Http\Request;
use App\Models\nomor_perkiraan;
use App\Imports\datamemorialimport;
use Maatwebsite\Excel\Facades\Excel;

class MemorialController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }
    public function index(Request $request)
    {
        $data=$request->tanggal;
        if($data !=0){
            $memorials=memorial::where("tanggal",$data)->get();
        }else{
            $memorials = memorial::all();

        }
        $memori=memorial::all();
        $semua=[];
        $total=0;
        foreach($memori as $memo){
            // Ambil data dari database berdasarkan nomor bukti
            $memorialEntries = memorial::where('nomor_bukti', $memo->nomor_bukti)->get();

            // Inisialisasi variabel untuk jumlah debit dan kredit
            $totalDebit = 0;
            $totalKredit = 0;

            // Iterasi melalui entri-entri data
            foreach ($memorialEntries as $entry) {
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
        return view('admin.masukan_data_harian.koreksi_data_memorial.index', compact('memorials','semua'));
    }
    public function index2($no_bukti)
    {
        $memorials = memorial::where("nomor_bukti",$no_bukti)->get();
        $hasil_debit=0;
        $hasil_kredit=0;
        $selisih=0;
        $status="";
        foreach($memorials as $memori){
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
            "data"=>$memorials,
            "status"=>$status,
            "selisih"=>$selisih,
        ]);
    }

    public function create(Request $request)
    {
        $nomor_perkiraan=nomor_perkiraan::all();
        $data=$request->tanggal;
        $no_bukti=null;
        if($data !=null){
            $dateWithoutYear = substr($data, 5);

            // Menghapus tanda "-" dari string
            $dateWithoutDashes = str_replace('-', '', $dateWithoutYear);
            $nilai=memorial::where("tanggal",$request->tanggal)->orderBy('created_at','desc')->first();
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
        return view('admin.masukan_data_harian.koreksi_data_memorial.create',compact('data','no_bukti','nomor_perkiraan'));
    }

    public function store(Request $request)
    {
        memorial::create($request->all());
        return response()->json($request->all());
    }

    public function show(Memorial $memorial)
    {
        return view('memorials.show', compact('memorial'));
    }
    public function edit2($no_bukti)
    {
        $nomor_perkiraan=nomor_perkiraan::all();
          
        $memorial=memorial::where('nomor_bukti',$no_bukti)->first();

        return view('admin.masukan_data_harian.koreksi_data_memorial.edit', compact('memorial','nomor_perkiraan'));
    }
    public function edit(Memorial $memorial)
    {
        return response()->json(['data' => $memorial]);
    }

    public function update(Request $request, Memorial $memorial)
    {
        $memorial->update($request->all());
        return redirect()->route('memorials.index');
    }

    public function destroy($id)
    {
        $memorial=memorial::find($id);
        $memorial->delete();
        return redirect()->route('memorials.index');
    }
    public function destroy2($id)
    {
        $memorial=memorial::where("nomor_bukti",$id)->delete();
        return redirect()->route('memorials.index');
    }
    public function import(Request $request)
    {
        $request->validate([
            'import' => 'required|mimes:xlsx,xls,csv',
        ]);

        $file = $request->file('import');

        Excel::import(new datamemorialimport, $file);
        return redirect('/memorials');
    }
}