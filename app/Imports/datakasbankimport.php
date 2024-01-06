<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\ToModel;
use App\Models\data_kas_bank;
use Carbon\Carbon;

class datakasbankimport implements ToModel, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function model(array $row)
    {
        $existingData = data_kas_bank::where('nomor_bukti', $row['nomor_bukti'])->first();

        // Jika data sudah ada, hapus data sebelumnya
        if ($existingData) {
            $existingData->delete();
        }
        //dd(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['tanggal']));
        return new data_kas_bank([
            'tanggal' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['tanggal']),
            'jenis' => $row['jenis'],
            'nomor_bukti' => $row['nomor_bukti'],
            'nomor_perkiraan' => $row['nomor_perkiraan'],
            'nomor_perkiraan_lawan' => $row['nomor_perkiraan_lawan'],
            'deskripsi' => $row['deskripsi'],
            'ubl' => $row['ubl'],
            'jumlah_uang' => $row['jumlah_uang'],
            'created_by' => $row['created_by'],
        ]);
    }
}
