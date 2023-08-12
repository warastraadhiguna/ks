<?php

namespace App\Http\Controllers;

use App\Models\Receipts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Yajra\DataTables\Facades\DataTables;

class ReceiptController extends Controller
{
    public function index(Request $request)
    {
        $startDate = $request->start_date;
        $endDate = $request->end_date;
        $from = date($startDate ? $startDate : GetNowDate()->toDateString());
        $to = date($endDate ? $endDate : GetNowDate()->toDateString()) ;

        if ($request->ajax()) {
            return  DataTables::of(Receipts::getSales($from, $to))->addIndexColumn()->addColumn('action', function ($row) {
                $btn = '<a type="button" href="'.URL::to("/admin/receipt/detail-sale/" . $row->noNota).'" class="btn btn-info" title="Lihat Detail"><i class="fas fa-search" aria-hidden="true"></i></a><a type="button"  href="'. URL::to('/admin/receipt/return-sale/' . $row->noNota).'" class="btn btn-warning" title="Lihat Retur"><i class="fas fa-sync" aria-hidden="true"></i></a> ';
                return $btn;
            })->rawColumns(['action'])->toJson();
        }

        $data =[
            'title' => "Data Penjualan",
            'start_date' => $from,
            'end_date'  => $to,
            'content' => "admin/receipt-history/sale-server-side"
        ];

        return view("admin.layouts.wrapper", $data);
    }

    public function showDetailSale($id)
    {
        $data =[
            'title' => "Detail Penjualan",
            'receipt'  => Receipts::getNota($id),
            'details'   => Receipts::getDetailNota($id),
            'content' => "admin/receipt-history/detail-sale"
        ];

        return view("admin.layouts.wrapper", $data);
    }

    public function showReturSale($id)
    {
        $data =[
            'title' => "Return Penjualan",
            'receipt'  => Receipts::getNota($id),
            'details'   => Receipts::getRetur($id),
            'content' => "admin/receipt-history/return-sale"
        ];

        return view("admin.layouts.wrapper", $data);
    }

    public function showSaleResume()
    {
        $startDate = request()->start_date;
        $endDate = request()->end_date;
        $from = date($startDate ? $startDate : GetNowDate()->toDateString());
        $to = date($endDate ? $endDate : GetNowDate()->toDateString()) ;

        $data =[
            'title' => "Ringkasan Penjualan",
            'start_date' => $from,
            'end_date'  => $to,
            'content' => "admin/receipt-history/sale-resume",
            'totalPenjualanHariIni'	=> Receipts::getTotalPenjualanHariIniResume($from, $to),
            'totalPembelianHariIni'	=> Receipts::getTotalPembelianHariIniResume($from, $to),
            'totalNotaHariIni'	=> Receipts::getTotalNotaHariIniResume($from, $to),
        ];

        return view("admin.layouts.wrapper", $data);
    }

    public function showProductSaleResume(Request $request)
    {
        $startDate = $request->start_date;
        $endDate = $request->end_date;
        $from = date($startDate ? $startDate : GetNowDate()->toDateString());
        $to = date($endDate ? $endDate : GetNowDate()->toDateString()) ;

        if ($request->ajax()) {
            return  DataTables::of(Receipts::getProductResume($from, $to))->addIndexColumn()->toJson();
        }

        $data =[
            'title' => "Ringkasan Penjualan Produk",
            'start_date' => $from,
            'end_date'  => $to,
            'content' => "admin/receipt-history/sale-product-resume"
        ];

        return view("admin.layouts.wrapper", $data);
    }

    public function showPurchasing(Request $request)
    {
        $startDate = $request->start_date;
        $endDate = $request->end_date;
        $from = date($startDate ? $startDate : GetNowDate()->subMonths(2)->toDateString());
        $to = date($endDate ? $endDate : GetNowDate()->toDateString()) ;

        $status = $request->status;
        $status = !$status ? "2" : $status;

        $caraBayar = $request->caraBayar;
        $caraBayar = !$caraBayar ? "4" : $caraBayar;

        if ($request->ajax()) {
            return  DataTables::of(Receipts::getPurchasing($from, $to, $status, $caraBayar))->addIndexColumn()->addColumn('action', function ($row) {
                $btn = '<a type="button" href="'.URL::to("/admin/receipt/detail-purchasing?id=" . $row->noNota).'" class="btn btn-info" title="Lihat Detail"><i class="fas fa-search" aria-hidden="true"></i></a><a type="button"  href="'. URL::to('/admin/receipt/return-purchasing?id=' . $row->noNota).'" class="btn btn-warning" title="Lihat Retur"><i class="fas fa-sync" aria-hidden="true"></i></a><a type="button"  href="'. URL::to('/admin/receipt/cicilan-purchasing?id=' . $row->noNota).'" class="btn btn-success" title="Lihat Cicilan"><i class="fas fa-money-bill" aria-hidden="true"></i></a> ';
                return $btn;
            })->rawColumns(['action'])->toJson();
        }

        $data =[
            'title' => "Data Pembelian",
            'start_date' => $from,
            'end_date'  => $to,
            'caraBayar' =>$caraBayar,
            'status' => $status,
            'content' => "admin/receipt-history/purchasing-list"
        ];

        return view("admin.layouts.wrapper", $data);
    }

    public function showDetailPurchasing()
    {
        $id = request()->id;

        $data =[
            'title' => "Detail Pembelian",
            'receipt'  => Receipts::getNotaPembelian($id),
            'details'   => Receipts::getDetailNotaPembelian($id),
            'totalBayar' => Receipts::getTotalBayarPembelian($id),
            'content' => "admin/receipt-history/detail-purchasing"
        ];

        return view("admin.layouts.wrapper", $data);
    }

    public function showReturnPurchasing()
    {
        $id = request()->id;

        $data =[
            'title' => "Retur Pembelian",
            'receipt'  => Receipts::getNotaPembelian($id),
            'details'   => Receipts::getReturPembelian($id),
            'totalBayar' => Receipts::getTotalBayarPembelian($id),
            'content' => "admin/receipt-history/return-purchasing"
        ];

        return view("admin.layouts.wrapper", $data);
    }

    public function showCicilanPurchasing()
    {
        $id = request()->id;

        $data =[
            'title' => "Retur Pembelian",
            'receipt'  => Receipts::getNotaPembelian($id),
            'details'   => Receipts::getCicilanPembelian($id),
            'totalBayar' => Receipts::getTotalBayarPembelian($id),
            'content' => "admin/receipt-history/cicilan-purchasing"
        ];

        return view("admin.layouts.wrapper", $data);
    }
}
