<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
class LabaRugiController extends Controller
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
        // return view("admin.cetak.laba_rugi.laba_rugi",compact('base64'));
        // dd("okay");

        $pdf = pdf::loadView('admin.cetak.laba_rugi.laba_rugi',compact('base64'));
        return $pdf->download('laba_rugi.pdf');
        // return view("admin.cetak.laba_rugi.laba_rugi");
    //     $pdf = App::make('dompdf.wrapper');
    // $pdf->loadHTML('<h1>Test</h1>');
    // return $pdf->stream();
    }
    public function indexview()
    {
        return view('admin.cetak.laba_rugi.index');
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
