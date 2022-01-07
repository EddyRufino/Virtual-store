<?php

namespace App\Http\Controllers\Admin\Reports;

use Illuminate\Http\Request;
use App\Exports\ReportExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;

class ReportController extends Controller
{
    public function index()
    {
        return view('admin.reports.index');
    }

    public function export()
    {
        $month = request()->validate([
            'month' => 'required'
        ]);

        $year = request()->validate([
            'year' => 'required'
        ]);

        return (new ReportExport)->forDate($year, $month)->download('reporte.xlsx');
    }
}
