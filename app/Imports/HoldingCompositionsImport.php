<?php

namespace App\Imports;

use App\Models\HoldingComposition;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToCollection;

class HoldingCompositionsImport implements ToCollection
{

    public function collection(Collection $rows)
    {
        try {
            DB::beginTransaction();

            foreach ($rows as $index => $row) {
                // Dont save the first row
                // First row is header
                if ($index == 0) {
                    continue;
                }

                $oneRow = explode('|', $row);

                $date = str_replace('["', '', $oneRow[0]);
                $foreignTotal = str_replace('"]', '', $oneRow[24]);

                // Store data
                $data = [
                    'date' => $date,
                    'code' => $oneRow[1],
                    'type' => $oneRow[2],
                    'number_of_securities' => $oneRow[3],
                    'price' => $oneRow[4],
                    'local_is' => $oneRow[5],
                    'local_cp' => $oneRow[6],
                    'local_pf' => $oneRow[7],
                    'local_ib' => $oneRow[8],
                    'local_id' => $oneRow[9],
                    'local_mf' => $oneRow[10],
                    'local_sc' => $oneRow[11],
                    'local_fd' => $oneRow[12],
                    'local_ot' => $oneRow[13],
                    'local_total' => $oneRow[14],
                    'foreign_is' => $oneRow[15],
                    'foreign_cp' => $oneRow[16],
                    'foreign_pf' => $oneRow[17],
                    'foreign_ib' => $oneRow[18],
                    'foreign_id' => $oneRow[19],
                    'foreign_mf' => $oneRow[20],
                    'foreign_sc' => $oneRow[21],
                    'foreign_fd' => $oneRow[22],
                    'foreign_ot' => $oneRow[23],
                    'foreign_total' => $foreignTotal,
                ];
                HoldingComposition::create($data);
            }

            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            dd([
                'exception' => $exception,
                'data' => $data,
                'row' => $row,
            ]);
        }
    }
}
