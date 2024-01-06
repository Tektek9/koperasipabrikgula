<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\ToModel;
use App\Models\memorial;


class datamemorialimport implements ToModel, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function model(array $row)
    {
        $existingData = memorial::where('nomor_bukti', $row['nomor_bukti'])->where('nomor_perkiraan',$row['nomor_perkiraan'])->first();

        // Jika data sudah ada, hapus data sebelumnya
        if ($existingData) {
            $existingData->delete();
        }
        return new memorial([
            'tanggal' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['tanggal']),
            'nomor_bukti' => $row['nomor_bukti'],
            'nomor_perkiraan' => $row['nomor_perkiraan'],
            'deskripsi' => $row['deskripsi'],
            'ubl' => $row['ubl'],
            'jumlah_uang' => $row['jumlah_uang'],
            'jenis' => $row['jenis'],
            'created_by' => $row['created_by'],
        ]);
    }
}
