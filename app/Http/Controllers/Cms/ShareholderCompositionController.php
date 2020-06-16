<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use App\Imports\ForeignTransactionsImport;
use App\Imports\ShareholderCompositionsImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Facades\Excel;

class ShareholderCompositionController extends Controller
{
    private $viewPathPrefix;

    public function __construct()
    {
        $this->viewPathPrefix = 'cms.shareholder-compositions.';
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
        Excel::import(new ShareholderCompositionsImport(), $validated['txtFile']);

        // Return success
        return redirect()->route('cms.shareholder-compositions.index')
            ->with('success', 'Import txt success.');
    }
}
