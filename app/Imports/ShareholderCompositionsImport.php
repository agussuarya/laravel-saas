<?php

namespace App\Imports;

use App\Models\ShareholderComposition;
use App\Models\ShareholderCompositionDetail;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToCollection;

class ShareholderCompositionsImport implements ToCollection
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
                    'domestic_is' => $oneRow[5],
                    'domestic_cp' => $oneRow[6],
                    'domestic_pf' => $oneRow[7],
                    'domestic_ib' => $oneRow[8],
                    'domestic_id' => $oneRow[9],
                    'domestic_mf' => $oneRow[10],
                    'domestic_sc' => $oneRow[11],
                    'domestic_fd' => $oneRow[12],
                    'domestic_ot' => $oneRow[13],
                    'domestic_total' => $oneRow[14],
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

                // Store to shareholder composition
                $shareholderComposition = ShareholderComposition::create([
                    'date' => $data['date'],
                    'code' => $data['code'],
                    'type' => $data['type'],
                    'number_of_securities' => $data['number_of_securities'],
                    'price' => $data['price'],
                    'domestic_total' => $data['domestic_total'],
                    'foreign_total' => $data['foreign_total'],
                ]);

                // Store to shareholder composition details
                $controllerNumberOfShares = $data['number_of_securities'] - $data['domestic_total'] - $data['foreign_total'];
                ShareholderCompositionDetail::insert([
                    [
                       'shareholder_composition_id' => $shareholderComposition->id,
                       'investor_status' => ShareholderCompositionDetail::INVESTOR_STATUS_DOMESTIC,
                       'investor_type' => ShareholderCompositionDetail::INVESTOR_TYPE_IS,
                       'number_of_shares' => $data['domestic_is'],
                       'created_at' => now(),
                       'updated_at' => now(),
                   ], [
                       'shareholder_composition_id' => $shareholderComposition->id,
                       'investor_status' => ShareholderCompositionDetail::INVESTOR_STATUS_DOMESTIC,
                       'investor_type' => ShareholderCompositionDetail::INVESTOR_TYPE_CP,
                       'number_of_shares' => $data['domestic_cp'],
                       'created_at' => now(),
                       'updated_at' => now(),
                   ], [
                       'shareholder_composition_id' => $shareholderComposition->id,
                       'investor_status' => ShareholderCompositionDetail::INVESTOR_STATUS_DOMESTIC,
                       'investor_type' => ShareholderCompositionDetail::INVESTOR_TYPE_PF,
                       'number_of_shares' => $data['domestic_pf'],
                       'created_at' => now(),
                       'updated_at' => now(),
                   ], [
                       'shareholder_composition_id' => $shareholderComposition->id,
                       'investor_status' => ShareholderCompositionDetail::INVESTOR_STATUS_DOMESTIC,
                       'investor_type' => ShareholderCompositionDetail::INVESTOR_TYPE_IB,
                       'number_of_shares' => $data['domestic_ib'],
                       'created_at' => now(),
                       'updated_at' => now(),
                   ], [
                       'shareholder_composition_id' => $shareholderComposition->id,
                       'investor_status' => ShareholderCompositionDetail::INVESTOR_STATUS_DOMESTIC,
                       'investor_type' => ShareholderCompositionDetail::INVESTOR_TYPE_ID,
                       'number_of_shares' => $data['domestic_id'],
                       'created_at' => now(),
                       'updated_at' => now(),
                   ], [
                       'shareholder_composition_id' => $shareholderComposition->id,
                       'investor_status' => ShareholderCompositionDetail::INVESTOR_STATUS_DOMESTIC,
                       'investor_type' => ShareholderCompositionDetail::INVESTOR_TYPE_MF,
                       'number_of_shares' => $data['domestic_mf'],
                       'created_at' => now(),
                       'updated_at' => now(),
                   ], [
                       'shareholder_composition_id' => $shareholderComposition->id,
                       'investor_status' => ShareholderCompositionDetail::INVESTOR_STATUS_DOMESTIC,
                       'investor_type' => ShareholderCompositionDetail::INVESTOR_TYPE_SC,
                       'number_of_shares' => $data['domestic_sc'],
                       'created_at' => now(),
                       'updated_at' => now(),
                   ], [
                       'shareholder_composition_id' => $shareholderComposition->id,
                       'investor_status' => ShareholderCompositionDetail::INVESTOR_STATUS_DOMESTIC,
                       'investor_type' => ShareholderCompositionDetail::INVESTOR_TYPE_FD,
                       'number_of_shares' => $data['domestic_fd'],
                       'created_at' => now(),
                       'updated_at' => now(),
                   ], [
                       'shareholder_composition_id' => $shareholderComposition->id,
                       'investor_status' => ShareholderCompositionDetail::INVESTOR_STATUS_DOMESTIC,
                       'investor_type' => ShareholderCompositionDetail::INVESTOR_TYPE_OT,
                       'number_of_shares' => $data['domestic_ot'],
                       'created_at' => now(),
                       'updated_at' => now(),
                   ], [
                        'shareholder_composition_id' => $shareholderComposition->id,
                        'investor_status' => ShareholderCompositionDetail::INVESTOR_STATUS_FOREIGN,
                        'investor_type' => ShareholderCompositionDetail::INVESTOR_TYPE_IS,
                        'number_of_shares' => $data['foreign_is'],
                        'created_at' => now(),
                        'updated_at' => now(),
                    ], [
                        'shareholder_composition_id' => $shareholderComposition->id,
                        'investor_status' => ShareholderCompositionDetail::INVESTOR_STATUS_FOREIGN,
                        'investor_type' => ShareholderCompositionDetail::INVESTOR_TYPE_CP,
                        'number_of_shares' => $data['foreign_cp'],
                        'created_at' => now(),
                        'updated_at' => now(),
                    ], [
                        'shareholder_composition_id' => $shareholderComposition->id,
                        'investor_status' => ShareholderCompositionDetail::INVESTOR_STATUS_FOREIGN,
                        'investor_type' => ShareholderCompositionDetail::INVESTOR_TYPE_PF,
                        'number_of_shares' => $data['foreign_pf'],
                        'created_at' => now(),
                        'updated_at' => now(),
                    ], [
                        'shareholder_composition_id' => $shareholderComposition->id,
                        'investor_status' => ShareholderCompositionDetail::INVESTOR_STATUS_FOREIGN,
                        'investor_type' => ShareholderCompositionDetail::INVESTOR_TYPE_IB,
                        'number_of_shares' => $data['foreign_ib'],
                        'created_at' => now(),
                        'updated_at' => now(),
                    ], [
                        'shareholder_composition_id' => $shareholderComposition->id,
                        'investor_status' => ShareholderCompositionDetail::INVESTOR_STATUS_FOREIGN,
                        'investor_type' => ShareholderCompositionDetail::INVESTOR_TYPE_ID,
                        'number_of_shares' => $data['foreign_id'],
                        'created_at' => now(),
                        'updated_at' => now(),
                    ], [
                        'shareholder_composition_id' => $shareholderComposition->id,
                        'investor_status' => ShareholderCompositionDetail::INVESTOR_STATUS_FOREIGN,
                        'investor_type' => ShareholderCompositionDetail::INVESTOR_TYPE_MF,
                        'number_of_shares' => $data['foreign_mf'],
                        'created_at' => now(),
                        'updated_at' => now(),
                    ], [
                        'shareholder_composition_id' => $shareholderComposition->id,
                        'investor_status' => ShareholderCompositionDetail::INVESTOR_STATUS_FOREIGN,
                        'investor_type' => ShareholderCompositionDetail::INVESTOR_TYPE_SC,
                        'number_of_shares' => $data['foreign_sc'],
                        'created_at' => now(),
                        'updated_at' => now(),
                    ], [
                        'shareholder_composition_id' => $shareholderComposition->id,
                        'investor_status' => ShareholderCompositionDetail::INVESTOR_STATUS_FOREIGN,
                        'investor_type' => ShareholderCompositionDetail::INVESTOR_TYPE_FD,
                        'number_of_shares' => $data['foreign_fd'],
                        'created_at' => now(),
                        'updated_at' => now(),
                    ], [
                        'shareholder_composition_id' => $shareholderComposition->id,
                        'investor_status' => ShareholderCompositionDetail::INVESTOR_STATUS_FOREIGN,
                        'investor_type' => ShareholderCompositionDetail::INVESTOR_TYPE_OT,
                        'number_of_shares' => $data['foreign_ot'],
                        'created_at' => now(),
                        'updated_at' => now(),
                    ], [
                        'shareholder_composition_id' => $shareholderComposition->id,
                        'investor_status' => ShareholderCompositionDetail::INVESTOR_STATUS_CONTROLLER,
                        'investor_type' => ShareholderCompositionDetail::INVESTOR_TYPE_CONTROLLER,
                        'number_of_shares' => $controllerNumberOfShares,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ],
                ]);
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
