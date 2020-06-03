<?php

namespace App\Imports;

use App\Models\ForeignTransaction;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToCollection;

class ForeignTransactionsImport implements ToCollection
{

    private $transactionDate;
    private $transactionType;

    public function __construct($transactionDate, $transactionType)
    {
        $this->transactionDate = $transactionDate;
        $this->transactionType = $transactionType;
    }

    public function collection(Collection $rows)
    {
        $foreignTransactionType = $this->transactionType;

        try {
            DB::beginTransaction();

            foreach ($rows as $index => $row) {
                // Dont save the first row
                // First row is header
                if ($index == 0) {
                    continue;
                }

                // Pre processing last price
                // E.g. change value from 2,950 to 2950
                $lastPrice = intval(str_replace(',', '', $row[1]));

                // Pre processing change value & percentage
                // Set value to positive if value is Rise
                // Set value to negative if value if Fall
                if (Arr::get($row, '2') == 'Rise') {
                    $changeValue = $row[3];
                    $changePercentage = $row[4];
                } else {
                    $changeValue = $row[3] * -1;
                    $changePercentage = $row[4] * -1;
                }

                // Pre processing frequency, volume, value, frg buy, and frg sell
                // E.g. change value from 60,787 to 60787
                $frequency = intval(str_replace(',', '', $row[5]));
                $volume = intval(str_replace(',', '', $row[6]));
                // Change volume from lot to shares
                // 1 lot = 100 shares
                $volume *= 100;
                $value = intval(str_replace(',', '', $row[7]));
                $value *= 1000;
                $foreignBuy = intval(str_replace(',', '', $row[8]));
                $foreignSell = intval(str_replace(',', '', $row[9]));
                if ($foreignTransactionType == ForeignTransaction::TYPE_VALUE) {
                    $foreignBuy *= 1000;
                    $foreignSell *= 1000;
                } else {
                    // Change volume from lot to shares
                    // 1 lot = 100 shares
                    $foreignBuy *= 100;
                    $foreignSell *= 100;
                }

                // Store data
                $data = [
                    'transaction_date' => $this->transactionDate,
                    'stock_code' => $row[0],
                    'last_price' => $lastPrice,
                    'change_value' => $changeValue,
                    'change_percentage' => $changePercentage,
                    'grid_fluctuation_ratio' => $row[4],
                    'frequency' => $frequency,
                    'volume' => $volume,
                    'value' => $value,
                    'type' => $foreignTransactionType,
                    'foreign_buy' => $foreignBuy,
                    'foreign_sell' => $foreignSell,
                    'net_buy' => $foreignBuy - $foreignSell,
                    'net_sell' => $foreignSell - $foreignBuy,
                ];
                ForeignTransaction::create($data);
            }

            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            dd($exception);
        }
    }
}
