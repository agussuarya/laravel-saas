<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use App\Imports\ForeignTransactionsImport;
use App\Imports\HoldingCompositionsImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Facades\Excel;

class HoldingCompositionController extends Controller
{
    private $viewPathPrefix;

    public function __construct()
    {
        $this->viewPathPrefix = 'cms.holding-compositions.';
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
            'txtFile' => 'required|file',
        ]);
        if ($validator->fails()) {
            throw ValidationException::withMessages($validator->errors()->toArray());
        }
        $validated = $validator->validated();

        // Import csv file
        Excel::import(new HoldingCompositionsImport(), $validated['txtFile']);

        // Return success
        return redirect()->route('cms.holding-compositions.index')
            ->with('success', 'Import txt success.');
    }
}
