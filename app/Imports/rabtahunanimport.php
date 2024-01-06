<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\ToModel;
use App\Models\rab_tahunan;


class rabtahunanimport implements ToModel, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function model(array $row)
    {
        $existingData = rab_tahunan::where('tahun', $row['tahun'])->first();

        // Jika data sudah ada, hapus data sebelumnya
        if ($existingData) {
            $existingData->delete();
        }
        // dd($row);
        return new rab_tahunan([
            'tahun'=>$row['tahun'],
            'nomor_perkiraan'=>$row['nomor_perkiraan'],
            'nama_perkiraan'=>$row['nama_perkiraan'],
            'rab_januari'=>$row['rab_januari'],
            'rab_februari'=>$row['rab_februari'],
            'rab_maret'=>$row['rab_maret'],
            'rab_april'=>$row['rab_april'],
            'rab_mei'=>$row['rab_mei'],
            'rab_juni'=>$row['rab_juni'],
            'rab_juli'=>$row['rab_juli'],
            'rab_agustus'=>$row['rab_agustus'],
            'rab_september'=>$row['rab_september'],
            'rab_oktober'=>$row['rab_oktober'],
            'rab_november'=>$row['rab_november'],
            'rab_desember'=>$row['rab_desember'],
            'created_by'=>$row['created_by'],
            // Sesuaikan dengan kolom-kolom dalam file Excel.
        ]);
    }
}
