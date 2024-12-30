<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;
Use App\Models\Transaction;
use Carbon\Carbon;

class HistoryPembayaranChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\LineChart
    {
        $tahun = date('Y');
        $bulan = date('m');
        for ($i = 1; $i <= $bulan; $i++) {
            $totalTransaksi = Transaction ::whereYear('created_at', $tahun)->whereMonth('created_at', $i)->where('status', 'success')->sum('price');
            $dataBulan[] = Carbon::create()->day(1)->month($i)->format('F');
            $dataTotalTransaksi[] = $totalTransaksi;
        }
        return $this->chart->lineChart()
            ->setTitle('Data Pembelian')
            ->setSubtitle('Total Pembelian Setiap Bulan')
            ->addData('Total Pembelian', $dataTotalTransaksi)
            ->setXAxis($dataBulan);
    }
}
