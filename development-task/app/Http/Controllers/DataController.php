<?php

namespace App\Http\Controllers;

use App\Exports\TaxesExport;
use App\Imports\TaxesImport;
use Illuminate\Http\Request;
use Excel;

class DataController extends Controller
{
    public function importExportView()
    {
        return view('import');
    }

    public function export()
    {
        return Excel::download(new TaxesExport(), 'Taxes.xlsx');
    }

    public function import()
    {
        Excel::import(new TaxesImport(),request()->file('import_file'));
        return redirect()->back()->with('message', "Imported Successfully!");
    }
}
