<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use App\Imports\ForeignTransactionsImport;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Facades\Excel;

class ForeignTransactionController extends Controller
{

    private $viewPathPrefix;

    public function __construct()
    {
        $this->viewPathPrefix = 'cms.foreign-transactions.';
    }

    public function index()
    {
        return view($this->viewPathPrefix . 'index');
    }

    public function create()
    {
        return view($this->viewPathPrefix . 'create');
    }

    public function store(Request $request) {
        // Validation and get data
        $validator = Validator::make($request->all(), [
            'transactionDate' => 'required|date|date_format:Y-m-d',
            'transactionType' => 'required|string|in:volume,value',
            'csvFile' => 'required|file',
        ]);
        if ($validator->fails()) {
            throw ValidationException::withMessages($validator->errors()->toArray());
        }
        $validated = $validator->validated();
        $transactionDate = Arr::get($validated, 'transactionDate');
        $transactionType = Arr::get($validated, 'transactionType');

        // Import csv file
        Excel::import(
            new ForeignTransactionsImport($transactionDate, $transactionType),
            $request->file('csvFile')
        );

        // Return success
        return redirect()->route('cms.foreign-transactions.index')
            ->with('success', 'Import csv success.');
    }

    public function createV2()
    {
        return view($this->viewPathPrefix . 'create-v2');
    }

    public function storeV2(Request $request) {
        // Validation and get data
        $validator = Validator::make($request->all(), [
            'csvFiles' => 'required|array',
            'csvFiles.*' => 'file',
        ]);
        if ($validator->fails()) {
            throw ValidationException::withMessages($validator->errors()->toArray());
        }

        // Csv files
        $csvFiles = $request->file('csvFiles', []);
        foreach ($csvFiles as $csvFile) {

            /**
             * Get transaction date && transaction type
             * Filename format: 2020-06-03_buy_volume.csv
             * 2020-06-03 = date(YYYY-MM-DD)
             * buy = action (buy/sell)
             * volume = type (volume/value)
             */
            $fileNameWithExt = $csvFile->getClientOriginalName();
            $fileNameWithoutExt = Arr::get(explode('.', $fileNameWithExt), '0', '__');
            $transactionDate = Arr::get(explode('_', $fileNameWithoutExt), '0', '');
            $transactionType = Arr::get(explode('_', $fileNameWithoutExt), '2', '');

            Excel::import(
                new ForeignTransactionsImport($transactionDate, $transactionType),
                $csvFile
            );
        }

        // Return success
        return redirect()->route('cms.foreign-transactions.index')
            ->with('success', 'Import csv success.');
    }
}
