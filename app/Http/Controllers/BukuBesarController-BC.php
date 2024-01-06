<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\data_kas_bank;

class BukuBesarController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $image = file_get_contents(public_path('logo.jpg'));
        $base64 = 'data:image/png;base64,' . base64_encode($image);
        $pdf = pdf::loadView('admin.cetak.buku_besar.urut_no_perkiraan',compact('base64'));
        return $pdf->download('buku_besar.pdf');
        return view("");
        //
    }
    public function index2(Request $request)
    {
        //dd($request);
        // Ambil tanggal awal dan akhir dari request
        $tanggalAwal = $request->input('tanggal_awal');
        $tanggalAkhir = $request->input('tanggal_akhir');

        // Lakukan query menggunakan where untuk memfilter berdasarkan rentang tanggal
        $kasbank = data_kas_bank::whereBetween('tanggal', [$tanggalAwal, $tanggalAkhir])->get();
        dd($kasbank);
        return view("admin.cetak.buku_besar.urut_tanggal");
        //
    }
    public function indexview(Request $request)
    {
        $image = file_get_contents(public_path('logo.jpg'));
        $base64 = 'data:image/png;base64,' . base64_encode($image);
        return view("admin.cetak.buku_besar.urut_no_perkiraan",compact('request','base64'));
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
