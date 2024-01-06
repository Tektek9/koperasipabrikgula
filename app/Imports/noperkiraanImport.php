<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\ToModel;
use App\Models\nomor_perkiraan;


class noperkiraanImport implements ToModel, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    // use Importable;
    public function model(array $row)
    {
        $existingData = nomor_perkiraan::where('kode', $row['kode'])->first();

        // Jika data sudah ada, hapus data sebelumnya
        if ($existingData) {
            $existingData->delete();
        }
        return new nomor_perkiraan([
            'kode' => $row['kode'],
            'uraian' => $row['uraian'],
            'created_by' => $row['created_by'],
            // Sesuaikan dengan kolom-kolom dalam file Excel.
        ]);
    }
}
