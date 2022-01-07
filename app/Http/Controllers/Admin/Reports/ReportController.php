<?php

namespace App\Http\Controllers\Admin\Reports;

use App\CartDetail;
use App\Charts\OrdersChart;
use App\Exports\ReportExport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    public function index()
    {
        // Chart
        $months = ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'];
        $dateStart = "1";
        $dateLast = "12";

        $dataOrder = collect([]);

        for ($days_backwards = $dateStart; $days_backwards <= $dateLast; $days_backwards++)
        {
            $dataOrder->push(CartDetail::whereMonth('created_at', $days_backwards)->count());
        }

        //dd($dataOrder);

        $chart = new OrdersChart;

        $today = today()->format('M Y');
        $chart->labels($months);
        $chart->dataset("Pedidos - {$today}", 'line', $dataOrder)
                                ->backgroundColor('rgba(63, 191, 127, .6)');

        return view('admin.reports.index', compact('chart'));
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
