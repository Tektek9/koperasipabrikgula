<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class NeracaAktifaPasifaController extends Controller
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
        $pdf = pdf::loadView('admin.cetak.neraca_aktifa_pasifa.neraca',compact('base64'));
        return $pdf->download('neraca_aktifa_pasifa.pdf');
        // return view("admin.cetak.neraca_aktifa_pasifa.neraca",compact('base64'));
    }
    public function indexview()
    {
        return view('admin.cetak.neraca_aktifa_pasifa.index');
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
