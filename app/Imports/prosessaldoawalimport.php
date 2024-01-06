<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\ToModel;
use App\Models\saldo_awal;


class prosessaldoawalimport implements ToModel, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function model(array $row)
    {
        $existingData = saldo_awal::where('nomor_perkiraan', $row['nomor_perkiraan'])->first();

        // Jika data sudah ada, hapus data sebelumnya
        if ($existingData) {
            $existingData->delete();
        }
        return new saldo_awal([
            'nomor_perkiraan' => $row['nomor_perkiraan'],
            'nama_perkiraan' => $row['nama_perkiraan'],
            'jenis' => $row['jenis'],
            'saldo_awal' => $row['saldo_awal'],
            'created_by' => $row['created_by'],
        ]);
    }
}
