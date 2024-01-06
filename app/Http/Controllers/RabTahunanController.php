<?php

namespace App\Http\Controllers;

use App\Models\rab_tahunan;
use App\Models\nomor_perkiraan;
use Illuminate\Http\Request;
use App\Imports\rabtahunanimport;
use Maatwebsite\Excel\Facades\Excel;

class RabTahunanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
        $rab_tahunans = Rab_tahunan::where('tahun','like','%'.$request->search.'%')->get();
        return view('admin.proses_awal.rab_tahunan.index', compact('rab_tahunans'));
    }

    public function create()
    {
        $nomor_perkiraan=nomor_perkiraan::all();
        return view('admin.proses_awal.rab_tahunan.create',compact('nomor_perkiraan'));
    }

    public function store(Request $request)
    {
        $data=rab_tahunan::where("tahun",$request->tahun)->count();
        if($data !=0){
            return back()->withErrors(['kode' => 'tahun sudah ada rab nya bisa edit rab sesuai tahun.']);
        }
        Rab_tahunan::create($request->all());
        return redirect()->route('rab_tahunans.index');
    }

    public function show(Rab_tahunan $rab_tahunan)
    {
        return view('rab_tahunans.show', compact('rab_tahunan'));
    }

    public function edit(Rab_tahunan $rab_tahunan)
    {
        $nomor_perkiraan=nomor_perkiraan::all();
        return view('admin.proses_awal.rab_tahunan.edit', compact('rab_tahunan','nomor_perkiraan'));
    }

    public function update(Request $request, Rab_tahunan $rab_tahunan)
    {
        $rab_tahunan->update($request->all());
        return redirect()->route('rab_tahunans.index');
    }

    public function destroy(Rab_tahunan $rab_tahunan)
    {
        $rab_tahunan->delete();
        return redirect()->route('rab_tahunans.index');
    }
    public function import(Request $request)
    {
        $request->validate([
            'import' => 'required|mimes:xlsx,xls,csv',
        ]);

        $file = $request->file('import');

        Excel::import(new rabtahunanimport, $file);
        return redirect('/rab_tahunans');
    }
}
