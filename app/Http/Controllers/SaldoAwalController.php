<?php

namespace App\Http\Controllers;

use App\Models\saldo_awal;
use Illuminate\Http\Request;
use App\Imports\prosessaldoawalimport;
use Maatwebsite\Excel\Facades\Excel;

class SaldoAwalController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
        $saldo_awals = saldo_awal::where('nomor_perkiraan','like','%'.$request->search.'%')->get();
        $debit=saldo_awal::where('jenis','debit')->sum('saldo_awal');
        $kredit=saldo_awal::where('jenis','kredit')->sum('saldo_awal');
        if($debit!=$kredit){
            $status="belum balance";
            $selisih=$debit-$kredit;
        }else{
            $status="balance";
            $selisih=0;
        }
        // dd($debit);
        return view('admin.proses_awal.saldo_proses_awal.index', compact('saldo_awals','debit','kredit','status','selisih'));
    }
    public function indexview()
    {
        return view('admin.cetak.neraca.index');
    }
    public function index2($nomor)
    {
        $saldo_awals = saldo_awal::where('nomor_perkiraan',$nomor)->get();
        return response()->json($saldo_awals);
    }

    public function create()
    {
        return view('admin.proses_awal.saldo_proses_awal.create');
    }

    public function store(Request $request)
    {
        $saldo_awal=$request->nomor_perkiraan;
        $hasil=saldo_awal::where('nomor_perkiraan',$saldo_awal)->first();
        
        if($hasil != null){
            // dd($hasil->id);
            $update=saldo_Awal::where('id',$hasil->id)->update([
                'jenis'=>$request->jenis,
                'saldo_awal'=>$request->saldo_awal,
                'created_by'=>$request->created_by,
            ]);
        }else{
            saldo_awal::create($request->all());

        }
        return redirect()->route('saldo_awals.index');
    }

    public function show(saldo_awal $saldo_awal)
    {
        return view('saldo_awals.show', compact('saldo_awal'));
    }

    public function edit(saldo_awal $saldo_awal)
    {
        return view('admin.proses_awal.saldo_proses_awal.edit', compact('saldo_awal'));
    }

    public function update(Request $request, saldo_awal $saldo_awal)
    {
        $saldo_awal->update($request->all());
        return redirect()->route('saldo_awals.index');
    }

    public function destroy(saldo_awal $saldo_awal)
    {
        $saldo_awal->delete();
        return redirect()->route('saldo_awals.index');
    }
    public function import(Request $request)
    {
        $request->validate([
            'import' => 'required|mimes:xlsx,xls,csv',
        ]);

        $file = $request->file('import');

        Excel::import(new prosessaldoawalimport, $file);
        return redirect('/saldo_awals');
    }
}