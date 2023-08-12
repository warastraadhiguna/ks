<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class StockController extends Controller
{
    public function index(Request $request)
    {
        $startDate = $request->start_date;
        $endDate = $request->end_date;
        // $startDate = date($startDate ? $startDate : GetNowDate()->toDateString());
        // $endDate = date($endDate ? $endDate : GetNowDate()->toDateString()) ;

        $show = $request->show;
        $show = $show ? $show : "2";
        // $limit = request()->limit;
        // $limit = $limit ? $limit : "100";
        if ($request->ajax()) {
            return  DataTables::of(Stock::getStock($startDate, $endDate, $show))->addIndexColumn()->toJson();
        }

        $data =[
            'title' => "Rincian Stok",
            'start_date' => $startDate,
            'end_date'  => $endDate,
            'show'  => $show,
            'content' => "admin/stock/detail-server-side"
        ];

        return view("admin.layouts.wrapper", $data);
    }

    public function showTotal(Request $request)
    {
        $show = request()->show;
        $show = $show ? $show : "2";

        if ($request->ajax()) {
            return  DataTables::of(Stock::getTotalStock($show))->addIndexColumn()->toJson();
        }

        $data =[
            'title' => "Stok Total",
            'show'  => $show,
            'content' => "admin/stock/total-server-side"
        ];

        return view("admin.layouts.wrapper", $data);
    }
}
