<?php

namespace App\Http\Controllers;
use App\Charts\HistoryPembayaranChart;
Use App\Models\Transaction;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AdminPerusahaan extends Controller
{
    public function perusahaan(HistoryPembayaranChart $chart){
        $tahun = date('Y');
        $bulan = date('m');
        for ($i = 1; $i <= $bulan; $i++) {
            $totalTransaksi = Transaction ::whereYear('created_at', $tahun)->whereMonth('created_at', $i)->where('status', 'success')->sum('price');
            $dataBulan[] = Carbon::create()->day(1)->month($i)->format('F');
            $dataTotalTransaksi[] = $totalTransaksi;
        }
        $data['dataBulan'] = $dataBulan;
        $data['dataTotalTransaksi'] = $dataTotalTransaksi;
        $data['chart'] = $chart ->build();
        return view('admin.perusahaan',[
           'transactions' => Transaction::latest()->get()
        ], $data);
    }
}