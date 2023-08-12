<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Stock extends Model
{
    use HasFactory;
    protected $table = "tstok";
    protected $primaryKey = 'idStok';
    protected $guarded = [];

    public static function getStock($tanggalAwal, $tanggalAkhir, $show)
    {
        $data = DB::query()
        ->from("tstok")
        ->select("idStok", DB::raw("DATE_FORMAT(tanggalStok, '%d-%m-%Y') as tanggalStok"), "tanggalStok as tanggalStokAsli", "noBarang", "namaBarang", "stok", "namasatuan", DB::raw("FORMAT(hargaJual, 2, 'de_DE') as hargaJual"), DB::raw("FORMAT(hargaBeli, 2, 'de_DE') as hargaBeli"), "namaUser", DB::raw("case when tglExpired= '0000-00-00 00:00:00' then '' else DATE_FORMAT(tglExpired, '%d-%m-%Y')   end as tglExpired"), "note", "catatan", "namaMerek", "typeBarang", "namaJenisBarang");

        if($tanggalAwal && $tanggalAwal !=="\"") {
            $data->where("tanggalStok", ">=", $tanggalAwal ." 00:00:00");
        }

        if($tanggalAkhir && $tanggalAkhir !=="\"") {
            $data->where("tanggalStok", "<=", $tanggalAkhir ." 23:59:59");
        }

        if($show == 1) {
            $data->where("stok", "=", "0");
        }

        if($show == 2) {
            $data->where("stok", ">", "0");
        }

        return $data->orderBy("tanggalStokAsli", "desc");
    }

    public static function getTotalStock($show)
    {
        $data = DB::query()
        ->from("tstok")
        ->select("noBarang", "namaBarang", "namaSatuan", DB::raw("sum(stok) AS sumStok"), DB::raw("FORMAT(hargaBeli, 2, 'de_DE')  as hargaBeli"), DB::raw("case when sum(stok) < 0 then 0 else FORMAT(sum(stok*hargaBeli), 2, 'de_DE')   end as nilai"), "typeBarang", "namaMerek", "namaJenisBarang");

        if($show == 1) {
            $data->having("sumStok", "=", 0);
        }

        if($show == 2) {
            $data->having("sumStok", ">", 0);
        }

        $data->groupBy("noBarang", "namaBarang", "namaSatuan");

        return $data->orderBy("namaBarang", "desc");

    }
}
