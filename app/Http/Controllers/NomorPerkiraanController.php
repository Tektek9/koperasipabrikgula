<?php

namespace App\Http\Controllers;

use App\Models\nomor_perkiraan;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use App\Imports\noperkiraanImport;

class NomorPerkiraanController extends Controller
{
    public function index(Request $request)
    {
        if($request->search==null){
            $nomor_perkiraans = nomor_perkiraan::orderBy('created_at','desc')->simplePaginate(10);

        }else{
            $nomor_perkiraans = nomor_perkiraan::where('kode','like',$request->search.'%')->orderBy('created_at','desc')->simplePaginate(10);

        }
        return view('admin.nomor_perkiraan.index', compact('nomor_perkiraans'));
    }
    public function cari(Request $request)
    {
            $nomor_perkiraans = nomor_perkiraan::where('kode','like',$request->q.'%')->orderBy('created_at','desc')->simplePaginate(10);

        return response($nomor_perkiraans);
    }

    public function create()
    {
        return view('admin.nomor_perkiraan.create');
    }
    public function getNamaPerkiraan($nomorPerkiraan)
    {
        // Lakukan logika untuk mendapatkan data dropdown berdasarkan $nomorPerkiraan
        $namaPerkiraans = nomor_perkiraan::where('kode', 'like', "$nomorPerkiraan%")->get();

        // Kembalikan tampilan (misalnya, menggunakan view atau JSON)
        return response()->json($namaPerkiraans);
    }
    public function import(Request $request)
    {
        $request->validate([
            'import' => 'required|mimes:xlsx,xls,csv',
        ]);

        $file = $request->file('import');

        Excel::import(new noperkiraanImport, $file);
        return redirect('/nomor_perkiraans');
    }

    public function store(Request $request)
    {
        $existingNomorPerkiraan = nomor_perkiraan::where('kode', $request->kode)->first();
        $existinguraianPerkiraan = nomor_perkiraan::where('uraian', $request->uraian)->first();

    if ($existingNomorPerkiraan) {
        return back()->withErrors(['kode' => 'Kode sudah digunakan.']);
    }
    if ($existinguraianPerkiraan) {
        return back()->withErrors(['uraian' => 'uraian sudah digunakan.']);
    }
        nomor_perkiraan::create($request->all());
        return redirect()->route('nomor_perkiraans.index');
    }

    public function show(nomor_perkiraan $nomor_perkiraan)
    {
        return view('nomor_perkiraans.show', compact('nomor_perkiraan'));
    }

    public function edit(nomor_perkiraan $nomor_perkiraan)
    {
        return view('admin.nomor_perkiraan.edit', compact('nomor_perkiraan'));
    }

    public function update(Request $request, nomor_perkiraan $nomor_perkiraan)
    {
        
        $nomor_perkiraan->update($request->all());
        return redirect()->route('nomor_perkiraans.index');
    }

    public function destroy(nomor_perkiraan $nomor_perkiraan)
    {
        $nomor_perkiraan->delete();
        return redirect()->route('nomor_perkiraans.index');
    }
}
