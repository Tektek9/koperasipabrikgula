<?php

namespace App\Http\Controllers;

use App\Models\data_kas_bank;
use Illuminate\Http\Request;
use App\Models\nomor_perkiraan;
use App\Imports\datakasbankimport;
use Maatwebsite\Excel\Facades\Excel;

class DataKasBankController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
        $data=$request->tanggal;
        if($data !=0){
            $data_kas_banks=data_kas_bank::where("tanggal",$data)->get();// Menghitung jumlah uang untuk jenis 'Masuk'
            $jumlahMasuk =data_kas_bank::where('jenis', 'Masuk')->sum('jumlah_uang');
    
            // Menghitung jumlah uang untuk jenis 'Keluar'
            $jumlahKeluar =data_kas_bank::where('jenis', 'Keluar')->sum('jumlah_uang');
        }else{
            $data_kas_banks = data_kas_bank::all();
            // Menghitung jumlah uang untuk jenis 'Masuk'
        $jumlahMasuk =data_kas_bank::where('jenis', 'Masuk')->sum('jumlah_uang');

        // Menghitung jumlah uang untuk jenis 'Keluar'
        $jumlahKeluar =data_kas_bank::where('jenis', 'Keluar')->sum('jumlah_uang');

        }
        return view('admin.masukan_data_harian.koreksi_data_kas_bank.index', compact('data_kas_banks','jumlahMasuk','jumlahKeluar'));
    }
    public function index2($no_bukti)
    {
        $data_kas_banks = data_kas_bank::where("nomor_bukti",$no_bukti)->get();
        $jumlah=0;
        foreach($data_kas_banks as $data){
            $jumlah+=$data->jumlah_uang;
        }
        return response()->json([
            "data"=>$data_kas_banks,
            "jumlah"=>$jumlah
        ]);
    }

    public function create(Request $request)
    {
        $nomor_perkiraan=nomor_perkiraan::where('uraian','KAS')->orWhere('uraian', 'BANK')->get();
        // dd($request->tanggal);
        $data=$request->tanggal;
        $jenis=$request->jenis;
        // $datetime = new DateTime($data);
        // Menghapus tahun dan tanda "-"
        $no_bukti=null;
        if($data !=null){
            $dateWithoutYear = substr($data, 5);

            // Menghapus tanda "-" dari string
            $dateWithoutDashes = str_replace('-', '', $dateWithoutYear);
            $nilai=data_kas_bank::where("tanggal",$request->tanggal)->where('jenis',$jenis)->orderBy('created_at','desc')->first();
            // dd($nilai);
            if($nilai != null){
                $nb=$nilai->nomor_bukti;
                $nb_int=(int)$nb+1;
                // dd(strval($nb_int));
                $no_bukti=strval($nb_int);
            }else{
                // dd($dateWithoutDashes."001");
                $no_bukti=$dateWithoutDashes."001";
            }
        }
        return view('admin.masukan_data_harian.koreksi_data_kas_bank.create',compact('data','jenis','no_bukti','nomor_perkiraan'));
    }

    public function store(Request $request)
    {
            data_kas_bank::create($request->all());
        return response()->json([$request->all()]);
    }

    public function show(data_kas_bank $data_kas_bank)
    {
        return view('admin.masukan_data_harian.koreksi_data_kas_bank.show', compact('data_kas_bank'));
    }

    public function edit2($no_bukti)
    {
        $nomor_perkiraan=nomor_perkiraan::all();
          
        $data_kas_bank=data_kas_bank::where('nomor_bukti',$no_bukti)->first();

        return view('admin.masukan_data_harian.koreksi_data_kas_bank.edit', compact('data_kas_bank','nomor_perkiraan'));
    }
    public function edit(data_kas_bank $data_kas_bank)
    {
        return response()->json(['data' => $data_kas_bank]);
    }

    public function update(Request $request, data_kas_bank $data_kas_bank)
    {
        $data_kas_bank->update($request->all());
        return redirect()->route('data_kas_banks.index');
    }

    public function destroy($id)
    {
        $data_kas_bank=data_kas_bank::find($id);
        $data_kas_bank->delete();
        return redirect()->route('data_kas_banks.index');
    }
    public function destroy2($id)
    {
        $data_kas_bank=data_kas_bank::where("nomor_bukti",$id)->delete();
        return redirect()->route('data_kas_banks.index');
    }
    public function import(Request $request)
    {
       // dd($request);
        $request->validate([
            'import' => 'required|mimes:xlsx,xls,csv',
        ]);

        $file = $request->file('import');

        Excel::import(new datakasbankimport, $file);
        return redirect('/data_kas_banks');
    }
}