<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Dompdf\Options;
use Dompdf\Dompdf;
use App\Models\memorial;
use App\Models\saldo_awal;
use App\Models\nomor_perkiraan;
use App\Models\data_kas_bank;

class NeracaController extends Controller
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
        $memori_bulanini=memorial::join('nomor_perkiraans','nomor_perkiraans.kode','=','memorials.nomor_perkiraan')
        ->whereMonth('tanggal', '=', date('m', strtotime($request->tanggal))) // Filter berdasarkan bulan
        ->whereYear('tanggal', '=', date('Y', strtotime($request->tanggal)))  // Filter berdasarkan tahun
        ->get(); 
        //dd($memori_bulanini);
        $memori=memorial::join('nomor_perkiraans','nomor_perkiraans.kode','=','memorials.nomor_perkiraan')
        ->get(); 
        $datakasbank=data_kas_bank::join('nomor_perkiraans','nomor_perkiraans.kode','=','data_kas_banks.nomor_perkiraan_lawan')->get();
        foreach($datakasbank as $datakas){
            $saldo_awal=saldo_awal::where('nomor_perkiraan',$datakas->nomor_perkiraan_lawan)->first();
            //dd($datakas);
            if(!$saldo_awal){
                if($datakas->jenis=='Masuk'){
                    saldo_awal::create([
                        'nomor_perkiraan'=>$datakas->nomor_perkiraan_lawan,
                        'nama_perkiraan'=>$datakas->uraian,
                        'jenis'=>'kredit',
                        'saldo_awal'=>0,
                        'created_by'=>$datakas->created_by
                    ]);
                }else{
                    saldo_awal::create([
                        'nomor_perkiraan'=>$datakas->nomor_perkiraan_lawan,
                        'nama_perkiraan'=>$datakas->uraian,
                        'jenis'=>'debit',
                        'saldo_awal'=>0,
                        'created_by'=>$datakas->created_by
                    ]);
                }
                
            }
        }
        foreach($memori as $memo){
            $saldo_awal=saldo_awal::where('nomor_perkiraan',$memo->nomor_perkiraan)->first();
            if(!$saldo_awal){
                saldo_awal::create([
                    'nomor_perkiraan'=>$memo->nomor_perkiraan,
                    'nama_perkiraan'=>$memo->uraian,
                    'jenis'=>$memo->jenis,
                    'saldo_awal'=>0,
                    'created_by'=>$memo->created_by
                ]);
            }
        }
      
        $pemindahbukuan=data_kas_bank::where('nomor_perkiraan_lawan','like','400%')->sum('jumlah_uang')+memorial::where('nomor_perkiraan','like','400%')->sum('jumlah_uang');
        $pemindahbukuan1=data_kas_bank::where('nomor_perkiraan_lawan','like','401%')->sum('jumlah_uang')+memorial::where('nomor_perkiraan','like','401%')->sum('jumlah_uang');
        $pemindahbukuan2=data_kas_bank::where('nomor_perkiraan_lawan','like','402%')->sum('jumlah_uang')+memorial::where('nomor_perkiraan','like','402%')->sum('jumlah_uang');
        $pemindahbukuan3=data_kas_bank::where('nomor_perkiraan_lawan','like','403%')->sum('jumlah_uang')+memorial::where('nomor_perkiraan','like','403%')->sum('jumlah_uang');
        $pemindahbukuan4=data_kas_bank::where('nomor_perkiraan_lawan','like','404%')->sum('jumlah_uang')+memorial::where('nomor_perkiraan','like','404%')->sum('jumlah_uang');
        $pemindahbukuan5=data_kas_bank::where('nomor_perkiraan_lawan','like','409%')->sum('jumlah_uang')+memorial::where('nomor_perkiraan','like','409%')->sum('jumlah_uang');
        $pemindahbukuan11=data_kas_bank::where('nomor_perkiraan_lawan','like','410%')->sum('jumlah_uang')+memorial::where('nomor_perkiraan','like','410%')->sum('jumlah_uang');
        $pemindahbukuan12=data_kas_bank::where('nomor_perkiraan_lawan','like','420%')->sum('jumlah_uang')+memorial::where('nomor_perkiraan','like','420%')->sum('jumlah_uang');
        $pemindahbukuan13=data_kas_bank::where('nomor_perkiraan_lawan','like','460%')->sum('jumlah_uang')+memorial::where('nomor_perkiraan','like','460%')->sum('jumlah_uang');
        $pemindahbukuan14=data_kas_bank::where('nomor_perkiraan_lawan','like','470%')->sum('jumlah_uang')+memorial::where('nomor_perkiraan','like','470%')->sum('jumlah_uang');
        $pemindahbukuan15=data_kas_bank::where('nomor_perkiraan_lawan','like','480%')->sum('jumlah_uang')+memorial::where('nomor_perkiraan','like','480%')->sum('jumlah_uang');
        $pemindahbukuan69=data_kas_bank::where('nomor_perkiraan_lawan','like','610%')->sum('jumlah_uang')+memorial::where('nomor_perkiraan','like','610%')->sum('jumlah_uang');
        $pemindahbukuan8=data_kas_bank::where('nomor_perkiraan_lawan','like','810.00')->sum('jumlah_uang')+memorial::where('nomor_perkiraan','like','810.00')->sum('jumlah_uang');
        $pemindahbukuan81=data_kas_bank::where('nomor_perkiraan_lawan','like','810.20')->sum('jumlah_uang')+memorial::where('nomor_perkiraan','like','810.20')->sum('jumlah_uang');
        $pemindahbukuan82=data_kas_bank::where('nomor_perkiraan_lawan','like','810.50')->sum('jumlah_uang')+memorial::where('nomor_perkiraan','like','810.50')->sum('jumlah_uang');
        $pemindahbukuan83=data_kas_bank::where('nomor_perkiraan_lawan','like','810.60')->sum('jumlah_uang')+memorial::where('nomor_perkiraan','like','810.60')->sum('jumlah_uang');
        $pemindahbukuan84=data_kas_bank::where('nomor_perkiraan_lawan','like','810.80')->sum('jumlah_uang')+memorial::where('nomor_perkiraan','like','810.80')->sum('jumlah_uang');
        $pemindahbukuan85=data_kas_bank::where('nomor_perkiraan_lawan','like','810.90')->sum('jumlah_uang')+memorial::where('nomor_perkiraan','like','810.90')->sum('jumlah_uang');
        $pemindahbukuan9=data_kas_bank::where('nomor_perkiraan_lawan','like','910.00')->sum('jumlah_uang')+memorial::where('nomor_perkiraan','like','910.00')->sum('jumlah_uang');
        $pemindahbukuan91=data_kas_bank::where('nomor_perkiraan_lawan','like','910.20')->sum('jumlah_uang')+memorial::where('nomor_perkiraan','like','910.20')->sum('jumlah_uang');
        $pemindahbukuan92=data_kas_bank::where('nomor_perkiraan_lawan','like','910.50')->sum('jumlah_uang')+memorial::where('nomor_perkiraan','like','910.50')->sum('jumlah_uang');
        $pemindahbukuan93=data_kas_bank::where('nomor_perkiraan_lawan','like','910.60')->sum('jumlah_uang')+memorial::where('nomor_perkiraan','like','910.60')->sum('jumlah_uang');
        $pemindahbukuan94=data_kas_bank::where('nomor_perkiraan_lawan','like','910.70')->sum('jumlah_uang')+memorial::where('nomor_perkiraan','like','910.70')->sum('jumlah_uang');
        $pemindahbukuan95=data_kas_bank::where('nomor_perkiraan_lawan','like','910.80')->sum('jumlah_uang')+memorial::where('nomor_perkiraan','like','910.80')->sum('jumlah_uang');
        $pemindahbukuan96=data_kas_bank::where('nomor_perkiraan_lawan','like','910.90')->sum('jumlah_uang')+memorial::where('nomor_perkiraan','like','910.90')->sum('jumlah_uang');
        $pemindahbukuan99=data_kas_bank::where('nomor_perkiraan_lawan','like','910%')->sum('jumlah_uang')+memorial::where('nomor_perkiraan','like','910%')->sum('jumlah_uang');
        $nomorkira=nomor_perkiraan::where('kode','491.00')->first();
        $nomorkira1=nomor_perkiraan::where('kode','491.10')->first();
        $nomorkira2=nomor_perkiraan::where('kode','491.20')->first();
        $nomorkira3=nomor_perkiraan::where('kode','491.30')->first();
        $nomorkira4=nomor_perkiraan::where('kode','491.40')->first();
        $nomorkira5=nomor_perkiraan::where('kode','491.90')->first();
        $nomorkira8=nomor_perkiraan::where('kode','890.00')->first();
        $nomorkira81=nomor_perkiraan::where('kode','890.20')->first();
        $nomorkira82=nomor_perkiraan::where('kode','890.30')->first();
        $nomorkira83=nomor_perkiraan::where('kode','890.60')->first();
        $nomorkira84=nomor_perkiraan::where('kode','890.80')->first();
        $nomorkira85=nomor_perkiraan::where('kode','890.90')->first();
        $nomorkira6=nomor_perkiraan::where('kode','610.00')->first();
        $nomorkira61=nomor_perkiraan::where('kode','610.10')->first();
        $nomorkira62=nomor_perkiraan::where('kode','610.20')->first();
        $nomorkira63=nomor_perkiraan::where('kode','610.30')->first();
        $nomorkira64=nomor_perkiraan::where('kode','610.40')->first();
        $nomorkira65=nomor_perkiraan::where('kode','610.90')->first();
        $nomorkira9=nomor_perkiraan::where('kode','910.00')->first();
        $nomorkira91=nomor_perkiraan::where('kode','910.20')->first();
        $nomorkira92=nomor_perkiraan::where('kode','910.50')->first();
        $nomorkira93=nomor_perkiraan::where('kode','910.60')->first();
        $nomorkira94=nomor_perkiraan::where('kode','910.70')->first();
        $nomorkira95=nomor_perkiraan::where('kode','910.80')->first();
        $nomorkira96=nomor_perkiraan::where('kode','910.90')->first();
        $nomorkira99=nomor_perkiraan::where('kode','990.00')->first();
        $nomorkira69=nomor_perkiraan::where('kode','690.00')->first();
        $nomorkira11=nomor_perkiraan::where('kode','492.10')->first();
        $nomorkira12=nomor_perkiraan::where('kode','492.20')->first();
        $nomorkira13=nomor_perkiraan::where('kode','492.60')->first();
        $nomorkira14=nomor_perkiraan::where('kode','492.70')->first();
        $nomorkira15=nomor_perkiraan::where('kode','492.80')->first();
        if($pemindahbukuan69>0 ){
            $awal1=saldo_awal::where('nomor_perkiraan',$nomorkira69->kode)->first();
            if(!$awal1){
                saldo_awal::create([
                    'nomor_perkiraan'=>$nomorkira69->kode,
                    'nama_perkiraan'=>$nomorkira69->uraian,
                    'jenis'=>'kredit',
                    'saldo_awal'=>0,
                    'created_by'=>$memo->created_by
                ]);
            }
                $awal1=saldo_awal::where('nomor_perkiraan',$nomorkira6->kode)->first();
            if(!$awal1){
                saldo_awal::create([
                    'nomor_perkiraan'=>$nomorkira6->kode,
                    'nama_perkiraan'=>$nomorkira6->uraian,
                    'jenis'=>'kredit',
                    'saldo_awal'=>0,
                    'created_by'=>$memo->created_by
                ]);

            }
         }
         if($pemindahbukuan99>0 ){
            $awal1=saldo_awal::where('nomor_perkiraan',$nomorkira99->kode)->first();
            if(!$awal1){
                saldo_awal::create([
                    'nomor_perkiraan'=>$nomorkira99->kode,
                    'nama_perkiraan'=>$nomorkira99->uraian,
                    'jenis'=>'kredit',
                    'saldo_awal'=>0,
                    'created_by'=>$memo->created_by
                ]);
            }
         }
         if($pemindahbukuan9>0 ){
            $awal1=saldo_awal::where('nomor_perkiraan',$nomorkira9->kode)->first();
            if(!$awal1){
                saldo_awal::create([
                    'nomor_perkiraan'=>$nomorkira9->kode,
                    'nama_perkiraan'=>$nomorkira9->uraian,
                    'jenis'=>'kredit',
                    'saldo_awal'=>0,
                    'created_by'=>$memo->created_by
                ]);
            }
         }
         if($pemindahbukuan91>0 ){
            $awal1=saldo_awal::where('nomor_perkiraan',$nomorkira91->kode)->first();
            if(!$awal1){
                saldo_awal::create([
                    'nomor_perkiraan'=>$nomorkira91->kode,
                    'nama_perkiraan'=>$nomorkira91->uraian,
                    'jenis'=>'kredit',
                    'saldo_awal'=>0,
                    'created_by'=>$memo->created_by
                ]);
            }
         }
         if($pemindahbukuan92>0 ){
            $awal1=saldo_awal::where('nomor_perkiraan',$nomorkira92->kode)->first();
            if(!$awal1){
                saldo_awal::create([
                    'nomor_perkiraan'=>$nomorkira92->kode,
                    'nama_perkiraan'=>$nomorkira92->uraian,
                    'jenis'=>'kredit',
                    'saldo_awal'=>0,
                    'created_by'=>$memo->created_by
                ]);
            }
         }
         if($pemindahbukuan93>0 ){
            $awal1=saldo_awal::where('nomor_perkiraan',$nomorkira93->kode)->first();
            if(!$awal1){
                saldo_awal::create([
                    'nomor_perkiraan'=>$nomorkira93->kode,
                    'nama_perkiraan'=>$nomorkira93->uraian,
                    'jenis'=>'kredit',
                    'saldo_awal'=>0,
                    'created_by'=>$memo->created_by
                ]);
            }
         }
         if($pemindahbukuan94>0 ){
            $awal1=saldo_awal::where('nomor_perkiraan',$nomorkira94->kode)->first();
            if(!$awal1){
                saldo_awal::create([
                    'nomor_perkiraan'=>$nomorkira94->kode,
                    'nama_perkiraan'=>$nomorkira94->uraian,
                    'jenis'=>'kredit',
                    'saldo_awal'=>0,
                    'created_by'=>$memo->created_by
                ]);
            }
         }
         if($pemindahbukuan95>0 ){
            $awal1=saldo_awal::where('nomor_perkiraan',$nomorkira95->kode)->first();
            if(!$awal1){
                saldo_awal::create([
                    'nomor_perkiraan'=>$nomorkira95->kode,
                    'nama_perkiraan'=>$nomorkira95->uraian,
                    'jenis'=>'kredit',
                    'saldo_awal'=>0,
                    'created_by'=>$memo->created_by
                ]);
            }
         }
         if($pemindahbukuan96>0 ){
            $awal1=saldo_awal::where('nomor_perkiraan',$nomorkira96->kode)->first();
            if(!$awal1){
                saldo_awal::create([
                    'nomor_perkiraan'=>$nomorkira96->kode,
                    'nama_perkiraan'=>$nomorkira96->uraian,
                    'jenis'=>'kredit',
                    'saldo_awal'=>0,
                    'created_by'=>$memo->created_by
                ]);
            }
         }
         
         if($pemindahbukuan8>0 ){
            $awal1=saldo_awal::where('nomor_perkiraan',$nomorkira8->kode)->first();
            if(!$awal1){
                saldo_awal::create([
                    'nomor_perkiraan'=>$nomorkira8->kode,
                    'nama_perkiraan'=>$nomorkira8->uraian,
                    'jenis'=>'kredit',
                    'saldo_awal'=>0,
                    'created_by'=>$memo->created_by
                ]);
            }
         }
         if($pemindahbukuan81>0 ){
            $awal1=saldo_awal::where('nomor_perkiraan',$nomorkira81->kode)->first();
            if(!$awal1){
                saldo_awal::create([
                    'nomor_perkiraan'=>$nomorkira81->kode,
                    'nama_perkiraan'=>$nomorkira81->uraian,
                    'jenis'=>'kredit',
                    'saldo_awal'=>0,
                    'created_by'=>$memo->created_by
                ]);
            }
         }
         if($pemindahbukuan82>0 ){
            $awal1=saldo_awal::where('nomor_perkiraan',$nomorkira82->kode)->first();
            if(!$awal1){
                saldo_awal::create([
                    'nomor_perkiraan'=>$nomorkira82->kode,
                    'nama_perkiraan'=>$nomorkira82->uraian,
                    'jenis'=>'kredit',
                    'saldo_awal'=>0,
                    'created_by'=>$memo->created_by
                ]);
            }
         }
         if($pemindahbukuan83>0 ){
            $awal1=saldo_awal::where('nomor_perkiraan',$nomorkira83->kode)->first();
            if(!$awal1){
                saldo_awal::create([
                    'nomor_perkiraan'=>$nomorkira83->kode,
                    'nama_perkiraan'=>$nomorkira83->uraian,
                    'jenis'=>'kredit',
                    'saldo_awal'=>0,
                    'created_by'=>$memo->created_by
                ]);
            }
         }
         if($pemindahbukuan84>0 ){
            $awal1=saldo_awal::where('nomor_perkiraan',$nomorkira84->kode)->first();
            if(!$awal1){
                saldo_awal::create([
                    'nomor_perkiraan'=>$nomorkira84->kode,
                    'nama_perkiraan'=>$nomorkira84->uraian,
                    'jenis'=>'kredit',
                    'saldo_awal'=>0,
                    'created_by'=>$memo->created_by
                ]);
            }
         }
         if($pemindahbukuan85>0 ){
            $awal1=saldo_awal::where('nomor_perkiraan',$nomorkira85->kode)->first();
            if(!$awal1){
                saldo_awal::create([
                    'nomor_perkiraan'=>$nomorkira85->kode,
                    'nama_perkiraan'=>$nomorkira85->uraian,
                    'jenis'=>'kredit',
                    'saldo_awal'=>0,
                    'created_by'=>$memo->created_by
                ]);
            }
         }
        if($pemindahbukuan>0 ){
            $awal1=saldo_awal::where('nomor_perkiraan',$nomorkira->kode)->first();
            if(!$awal1){
                saldo_awal::create([
                    'nomor_perkiraan'=>$nomorkira->kode,
                    'nama_perkiraan'=>$nomorkira->uraian,
                    'jenis'=>'kredit',
                    'saldo_awal'=>0,
                    'created_by'=>$memo->created_by
                ]);
            }
                $awal1=saldo_awal::where('nomor_perkiraan',$nomorkira6->kode)->first();
            if(!$awal1){
                saldo_awal::create([
                    'nomor_perkiraan'=>$nomorkira6->kode,
                    'nama_perkiraan'=>$nomorkira6->uraian,
                    'jenis'=>'kredit',
                    'saldo_awal'=>0,
                    'created_by'=>$memo->created_by
                ]);

            }
    }
    if($pemindahbukuan1>0 ){
        $awal1=saldo_awal::where('nomor_perkiraan',$nomorkira1->kode)->first();
        if(!$awal1){
            saldo_awal::create([
                'nomor_perkiraan'=>$nomorkira1->kode,
                'nama_perkiraan'=>$nomorkira1->uraian,
                'jenis'=>'kredit',
                'saldo_awal'=>0,
                'created_by'=>$memo->created_by
            ]);

        }
        $awal1=saldo_awal::where('nomor_perkiraan',$nomorkira61->kode)->first();
        if(!$awal1){
            saldo_awal::create([
                'nomor_perkiraan'=>$nomorkira61->kode,
                'nama_perkiraan'=>$nomorkira61->uraian,
                'jenis'=>'kredit',
                'saldo_awal'=>0,
                'created_by'=>$memo->created_by
            ]);

        }
    }
    if($pemindahbukuan2>0 ){
        $awal1=saldo_awal::where('nomor_perkiraan',$nomorkira2->kode)->first();
        if(!$awal1){
            saldo_awal::create([
                'nomor_perkiraan'=>$nomorkira2->kode,
                'nama_perkiraan'=>$nomorkira2->uraian,
                'jenis'=>'kredit',
                'saldo_awal'=>0,
                'created_by'=>$memo->created_by
            ]);

        }
        $awal1=saldo_awal::where('nomor_perkiraan',$nomorkira62->kode)->first();
        if(!$awal1){
            saldo_awal::create([
                'nomor_perkiraan'=>$nomorkira62->kode,
                'nama_perkiraan'=>$nomorkira62->uraian,
                'jenis'=>'kredit',
                'saldo_awal'=>0,
                'created_by'=>$memo->created_by
            ]);

        }
    }
    if($pemindahbukuan3>0 ){
        $awal1=saldo_awal::where('nomor_perkiraan',$nomorkira3->kode)->first();
        if(!$awal1){
            saldo_awal::create([
                'nomor_perkiraan'=>$nomorkira3->kode,
                'nama_perkiraan'=>$nomorkira3->uraian,
                'jenis'=>'kredit',
                'saldo_awal'=>0,
                'created_by'=>$memo->created_by
            ]);

        }
        $awal1=saldo_awal::where('nomor_perkiraan',$nomorkira63->kode)->first();
        if(!$awal1){
            saldo_awal::create([
                'nomor_perkiraan'=>$nomorkira63->kode,
                'nama_perkiraan'=>$nomorkira63->uraian,
                'jenis'=>'kredit',
                'saldo_awal'=>0,
                'created_by'=>$memo->created_by
            ]);

        }
    }
    if($pemindahbukuan4>0 ){
        $awal1=saldo_awal::where('nomor_perkiraan',$nomorkira4->kode)->first();
        if(!$awal1){
            saldo_awal::create([
                'nomor_perkiraan'=>$nomorkira4->kode,
                'nama_perkiraan'=>$nomorkira4->uraian,
                'jenis'=>'kredit',
                'saldo_awal'=>0,
                'created_by'=>$memo->created_by
            ]);

        }
        $awal1=saldo_awal::where('nomor_perkiraan',$nomorkira64->kode)->first();
        if(!$awal1){
            saldo_awal::create([
                'nomor_perkiraan'=>$nomorkira64->kode,
                'nama_perkiraan'=>$nomorkira64->uraian,
                'jenis'=>'kredit',
                'saldo_awal'=>0,
                'created_by'=>$memo->created_by
            ]);

        }
    }
    if($pemindahbukuan5>0 ){
        $awal1=saldo_awal::where('nomor_perkiraan',$nomorkira5->kode)->first();
        if(!$awal1){
            saldo_awal::create([
                'nomor_perkiraan'=>$nomorkira5->kode,
                'nama_perkiraan'=>$nomorkira5->uraian,
                'jenis'=>'kredit',
                'saldo_awal'=>0,
                'created_by'=>$memo->created_by
            ]);

        }
        $awal1=saldo_awal::where('nomor_perkiraan',$nomorkira65->kode)->first();
        if(!$awal1){
            saldo_awal::create([
                'nomor_perkiraan'=>$nomorkira65->kode,
                'nama_perkiraan'=>$nomorkira65->uraian,
                'jenis'=>'kredit',
                'saldo_awal'=>0,
                'created_by'=>$memo->created_by
            ]);

        }
    }
    if($pemindahbukuan11>0 ){
        $awal1=saldo_awal::where('nomor_perkiraan',$nomorkira11->kode)->first();
        if(!$awal1){
            saldo_awal::create([
                'nomor_perkiraan'=>$nomorkira11->kode,
                'nama_perkiraan'=>$nomorkira11->uraian,
                'jenis'=>'kredit',
                'saldo_awal'=>0,
                'created_by'=>$memo->created_by
            ]);

        }
    }
    if($pemindahbukuan12>0 ){
        $awal1=saldo_awal::where('nomor_perkiraan',$nomorkira12->kode)->first();
        if(!$awal1){
            saldo_awal::create([
                'nomor_perkiraan'=>$nomorkira12->kode,
                'nama_perkiraan'=>$nomorkira12->uraian,
                'jenis'=>'kredit',
                'saldo_awal'=>0,
                'created_by'=>$memo->created_by
            ]);

        }
    }
    if($pemindahbukuan13>0 ){
        $awal1=saldo_awal::where('nomor_perkiraan',$nomorkira13->kode)->first();
        if(!$awal1){
            saldo_awal::create([
                'nomor_perkiraan'=>$nomorkira13->kode,
                'nama_perkiraan'=>$nomorkira13->uraian,
                'jenis'=>'kredit',
                'saldo_awal'=>0,
                'created_by'=>$memo->created_by
            ]);

        }
    }
    if($pemindahbukuan14>0 ){
        $awal1=saldo_awal::where('nomor_perkiraan',$nomorkira14->kode)->first();
        if(!$awal1){
            saldo_awal::create([
                'nomor_perkiraan'=>$nomorkira14->kode,
                'nama_perkiraan'=>$nomorkira14->uraian,
                'jenis'=>'kredit',
                'saldo_awal'=>0,
                'created_by'=>$memo->created_by
            ]);

        }
    }
    if($pemindahbukuan15>0 ){
        $awal1=saldo_awal::where('nomor_perkiraan',$nomorkira15->kode)->first();
        if(!$awal1){
            saldo_awal::create([
                'nomor_perkiraan'=>$nomorkira15->kode,
                'nama_perkiraan'=>$nomorkira15->uraian,
                'jenis'=>'kredit',
                'saldo_awal'=>0,
                'created_by'=>$memo->created_by
            ]);

        }
    }
       
        $nomor_perkiraan = nomor_perkiraan::join('saldo_awals','saldo_awals.nomor_perkiraan','=','nomor_perkiraans.kode')->select('saldo_awals.*','nomor_perkiraans.*')->orderBy('kode', 'asc')->get();
       
// Inisialisasi array untuk menyimpan hasil per golongan
        $totalsPerGolongan = [];
        $debit=0;
        $kredit=0;
        $debitmemorial=0;
        $kreditmemorial=0;
        $jumlahdatakredit=0;
        $jumlahdatadebit=0;

        // dd($debit_total->count());
        if($nomor_perkiraan->count()==0){
            $pesan = 'Operasi berhasil dilakukan!';

            // Simpan pesan ke dalam session
            session()->flash('pesan', $pesan);
            // dd($pesan);
            return redirect::back();
        }
foreach ($nomor_perkiraan as $perkiraan) {
    // Pisahkan kode menjadi golongan (misal: "080" menjadi "00")
    $golongan = substr($perkiraan->kode, 0, 3);
    $golongan2=substr($perkiraan->kode,0,2);
    $golongan3=substr($perkiraan->kode,0,1);


    // Tambahkan jumlah perkiraan utama ke array hasil per golongan
    if (!isset($totalsPerGolongan[$golongan3][$golongan2][$golongan]['details'])) {
        $totalsPerGolongan[$golongan3][$golongan2][$golongan]['details'] = [];
    }
        $debit=data_kas_bank::where('nomor_perkiraan_lawan', $perkiraan->kode)->where('jenis', 'Masuk')->sum('jumlah_uang')+memorial::where('nomor_perkiraan',$perkiraan->kode)->where('jenis','debit')->sum('jumlah_uang');
        $kredit=data_kas_bank::where('nomor_perkiraan_lawan', $perkiraan->kode)->where('jenis', 'Keluar')->sum('jumlah_uang')+memorial::where('nomor_perkiraan',$perkiraan->kode)->where('jenis','kredit')->sum('jumlah_uang');
        $debit_total=data_kas_bank::where('nomor_perkiraan_lawan', $perkiraan->kode)->where('jenis', 'Masuk')
        ->whereMonth('tanggal', '=', date('m', strtotime($request->tanggal))) // Filter berdasarkan bulan
        ->whereYear('tanggal', '=', date('Y', strtotime($request->tanggal)))  // Filter berdasarkan tahun
        ->sum('jumlah_uang')+memorial::where('nomor_perkiraan',$perkiraan->kode)->where('jenis','debit')
        ->whereMonth('tanggal', '=', date('m', strtotime($request->tanggal))) // Filter berdasarkan bulan
        ->whereYear('tanggal', '=', date('Y', strtotime($request->tanggal)))  // Filter berdasarkan tahun
        ->sum('jumlah_uang');
        $kredit_total=data_kas_bank::where('nomor_perkiraan_lawan', $perkiraan->kode)->where('jenis', 'Keluar')
        ->whereMonth('tanggal', '=', date('m', strtotime($request->tanggal))) // Filter berdasarkan bulan
        ->whereYear('tanggal', '=', date('Y', strtotime($request->tanggal)))  // Filter berdasarkan tahun
        ->sum('jumlah_uang')+memorial::where('nomor_perkiraan',$perkiraan->kode)->where('jenis','kredit')
        ->whereMonth('tanggal', '=', date('m', strtotime($request->tanggal))) // Filter berdasarkan bulan
        ->whereYear('tanggal', '=', date('Y', strtotime($request->tanggal)))  // Filter berdasarkan tahun
        ->sum('jumlah_uang');
        $data=data_kas_bank::where('nomor_perkiraan',$perkiraan->kode)->get();
        if($data->count()>0){
            $kredit=data_kas_bank::where('nomor_perkiraan',$perkiraan->kode)->where('jenis','Masuk')->sum('jumlah_uang');
            $debit=data_kas_bank::where('nomor_perkiraan',$perkiraan->kode)->where('jenis','Keluar')->sum('jumlah_uang');   
            $kredit=data_kas_bank::where('nomor_perkiraan',$perkiraan->kode)->where('jenis','Masuk')
            ->whereMonth('tanggal', '=', date('m', strtotime($request->tanggal))) // Filter berdasarkan bulan
            ->whereYear('tanggal', '=', date('Y', strtotime($request->tanggal)))  // Filter berdasarkan tahun
            ->sum('jumlah_uang');
            $debit=data_kas_bank::where('nomor_perkiraan',$perkiraan->kode)->where('jenis','Keluar')
            ->whereMonth('tanggal', '=', date('m', strtotime($request->tanggal))) // Filter berdasarkan bulan
            ->whereYear('tanggal', '=', date('Y', strtotime($request->tanggal)))  // Filter berdasarkan tahun
            ->sum('jumlah_uang');
        }
        // dd($debit_total);
        if($debit_total==0 || $kredit_total==0){
            // $pesan = 'tidak terdapat data yang akan di cetak tolong pilih data yang sesuai';

            // // Simpan pesan ke dalam session
            // session()->flash('pesan', $pesan);
            // return redirect()->back();
        }
   
    $totalsPerGolongan[$golongan3][$golongan2][$golongan]['details'][] = [
        'kode' => $perkiraan->kode,
        'uraian' => $perkiraan->uraian,
        'jenis'=>$perkiraan->jenis,
        'saldo_awal'=>$perkiraan->saldo_awal,
        'kasbank_debit'=>$debit_total,
        'kasbank_kredit'=>$kredit_total,
        'sampaibulaninikasbank_debit'=>$debit,
        'sampaibulaninikasbank_kredit'=>$kredit
    ];

}
$rekapsaldoawaldebit[]=0;
$rekapsaldoawalkredit[]=0;
$bulaninidebit[]=0;
$bulaninikredit[]=0;
$sampaibulaninidebit[]=0;
$sampaibulaninikredit[]=0;
$totals[]=0;
foreach ($totalsPerGolongan as $golongan=> $totalPerGolongan) {
        $rekapsaldoawaldebit[$golongan]=saldo_awal::where('nomor_perkiraan','like',$golongan.'%')->where('jenis','debit')->sum('saldo_awal');
        $rekapsaldoawalkredit[$golongan]=saldo_awal::where('nomor_perkiraan','like',$golongan.'%')->where('jenis','kredit')->sum('saldo_awal');
        $bulaninidebit[$golongan]=data_kas_bank::where('nomor_perkiraan_lawan','like',$golongan.'%')->where('jenis', 'Masuk')
        ->whereMonth('tanggal', '=', date('m', strtotime($request->tanggal))) // Filter berdasarkan bulan
        ->whereYear('tanggal', '=', date('Y', strtotime($request->tanggal)))
        ->sum('jumlah_uang')+memorial::where('nomor_perkiraan','like',$golongan.'%')->where('jenis','debit')
        ->whereMonth('tanggal', '=', date('m', strtotime($request->tanggal))) // Filter berdasarkan bulan
        ->whereYear('tanggal', '=', date('Y', strtotime($request->tanggal)))
        ->sum('jumlah_uang');
        $bulaninikredit[$golongan]=data_kas_bank::where('nomor_perkiraan_lawan','like',$golongan.'%')->where('jenis', 'Keluar')
        ->whereMonth('tanggal', '=', date('m', strtotime($request->tanggal))) // Filter berdasarkan bulan
        ->whereYear('tanggal', '=', date('Y', strtotime($request->tanggal))) 
        ->sum('jumlah_uang')+memorial::where('nomor_perkiraan','like',$golongan.'%')->where('jenis','kredit')
        ->whereMonth('tanggal', '=', date('m', strtotime($request->tanggal))) // Filter berdasarkan bulan
        ->whereYear('tanggal', '=', date('Y', strtotime($request->tanggal)))
        ->sum('jumlah_uang');
        $sampaibulaninidebit[$golongan]=data_kas_bank::where('nomor_perkiraan_lawan','like',$golongan.'%')->where('jenis', 'Masuk')
        ->sum('jumlah_uang')+memorial::where('nomor_perkiraan','like',$golongan.'%')->where('jenis','debit')
        ->sum('jumlah_uang');
        $sampaibulaninikredit[$golongan]=data_kas_bank::where('nomor_perkiraan_lawan','like',$golongan.'%')->where('jenis', 'Keluar')
        ->sum('jumlah_uang')+memorial::where('nomor_perkiraan','like',$golongan.'%')->where('jenis','kredit')
        ->sum('jumlah_uang');
}
$totals=[
    'rekapsaldoawaldebit'=>$rekapsaldoawaldebit,
    'rekapsaldoawalkredit'=>$rekapsaldoawalkredit,
    'bulaninidebit'=>$bulaninidebit,
    'bulaninikredit'=>$bulaninikredit,
    'sampaibulaninidebit'=>$sampaibulaninidebit,
    'sampaibulaninikredit'=>$sampaibulaninikredit
];

// Tampilkan hasil
// foreach ($totalsPerGolongan as $golongan => $totalPerGolongan) {
//     echo "Golongan: $golongan\n";
//     foreach ($totalPerGolongan['details'] as $detail) {
//         echo " - {$detail['kode']}: {$detail['uraian']}\n";
//     }
//     echo "\n";
// }

// Tampilkan hasil



//dd($totals);
        return view('admin.cetak.neraca.neraca',compact('totalsPerGolongan'));
        $saldo_awal=saldo_awal::join('nomor_perkiraans','nomor_perkiraans.kode','=','saldo_awals.nomor_perkiraan')->select('saldo_awals.*','nomor_perkiraans.*')->get();
        dd($saldo_awal);
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isPhpEnabled', true);
        $pdf = new Dompdf($options);
        $image = file_get_contents(public_path('logo.jpg'));
        $base64 = 'data:image/png;base64,' . base64_encode($image);
        // return view('admin.cetak.neraca.neraca',compact('base64'));
        $data = memorial::join('nomor_perkiraans','kode','=','memorials.nomor_perkiraan')
        ->select("memorials.*","nomor_perkiraans.*")->get();
        $groupedData = [];
        $totalDebit = 0;
        $totalKredit = 0;

// Mengelompokkan data berdasarkan nomor bukti
        foreach ($data as $item) {
            $nomorBukti = $item->nomor_bukti;

            if (!isset($groupedData[$nomorBukti])) {
                $groupedData[$nomorBukti] = [
                    'debit' => 0,
                    'kredit' => 0,
                    'items' => [],
                ];
            }

            $groupedData[$nomorBukti]['items'][] = $item;

            // Menambahkan jumlah debit atau kredit berdasarkan jenis
            if ($item->jenis == 'debit') {
                $groupedData[$nomorBukti]['debit'] += $item->jumlah_uang;
                $totalDebit += $item->jumlah_uang;
            } elseif ($item->jenis == 'kredit') {
                $groupedData[$nomorBukti]['kredit'] += $item->jumlah_uang;
                $totalKredit += $item->jumlah_uang;
            }
        }

        // Mengonversi hasil pengelompokan ke dalam array
        $data = array_values($groupedData);

        $pageNumber=null;
        $totalPages=null;
        $html= view('admin.cetak.neraca.neraca', compact('base64', 'data','totalDebit','totalKredit', 'pageNumber', 'totalPages'));
        $pdf->loadHtml($html);

        $pdf->setPaper('a3', 'landscape')->render();
        $totalPages = $pdf->getCanvas()->get_page_count();
        
        $pdf->render();
        
        return $pdf->stream('neraca.pdf', array('Attachment' => 0));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function indexview()
    {
        return view('admin.cetak.neraca.index');
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
