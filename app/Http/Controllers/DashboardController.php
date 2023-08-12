<?php

namespace App\Http\Controllers;

use App\Models\Receipts;

class DashboardController extends Controller
{
    public function index()
    {
        $nowDate = GetNowDate();
        $tanggalAwal = DateFormat($nowDate, "Y/M/D 00:00:00");
        $tanggalAkhir = DateFormat($nowDate, "Y/M/D 23:59:59");

        $data =[
            'title' => "Dashboard",
            'content' => "admin/dashboard/index",
            'tahun'       				=> DateFormat($nowDate, "d/m/Y H:i"),
            'totalPenjualanHariIni'		=> Receipts::getTotalPenjualanHariIni($tanggalAwal, $tanggalAkhir),
            'totalPembelianHariIni'		=> Receipts::getTotalPembelianHariIni($tanggalAwal, $tanggalAkhir),
            'totalNotaHariIni'			=> Receipts::getCountNotaHariIni($tanggalAwal, $tanggalAkhir),
            'totalStokHariIni'			=> Receipts::getTotalStokHariIni(),
            'totalHutangHariIni'		=> Receipts::getTotalHutangHariIni(),
        ];

        return view('admin.layouts.wrapper', $data);
    }
}