<?php

namespace App\Exports;

use App\CartDetail;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;

class ReportExport implements FromView
{
    use Exportable;

    private $year;
    private $month;

    public function forDate($year, $month)
    {
        $this->year = $year;
        $this->month = $month;

        return $this;
    }

    public function view(): View
    {
        $orders = CartDetail::with('product')
                    ->whereYear('created_at', $this->year)
                    ->whereMonth('created_at', $this->month)
                    ->where('state', 'Atendido')
                    ->orderBy('created_at', 'ASC')
                    ->get();

        return view('admin.reports.export', compact('orders'));
    }
}
