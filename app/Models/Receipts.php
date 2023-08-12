<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Receipts extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = "tnota";
    protected $primaryKey = 'noNota';

    public static function getSales($tanggalAwal, $tanggalAkhir)
    {
        $data = DB::query()
        ->from("tnota")
        ->select("noNota", DB::raw("DATE_FORMAT(tanggalNota, '%d-%m-%Y %H:%i')  as tanggalNota"), "diskon", "potongan", DB::raw("FORMAT(totalSebelumDiskon, 2, 'de_DE')  as totalSebelumDiskon"), DB::raw("FORMAT(totalSebelumDiskon-potongan-(totalSebelumDiskon*diskon/100), 2, 'de_DE') as grandTotal"), "caraBayar", "noReferensi", "namaUser", DB::raw("ifnull(namaShopHolder,'') as namaShopHolder"), "keterangan", "bayar", "kembalian")
        ->where("isPenjualan", "=", 1)
        ->where("isSelesai", "=", 1);

        if($tanggalAwal) {
            $data->where("tanggalNota", ">=", $tanggalAwal ." 00:00:00");
        }

        if($tanggalAkhir) {
            $data->where("tanggalNota", "<=", $tanggalAkhir ." 23:59:59");
        }

        return $data->orderBy("tanggalNota", "desc");
    }

    public static function getTotalPenjualanHariIni($tanggalAwal, $tanggalAkhir)
    {
        $sql = "SELECT ifNull((sum(totalSebelumDiskon-potongan-(totalSebelumDiskon*diskon/100))),0) as grandTotal   FROM tnota where isPenjualan = 1 and tanggalNota <='". $tanggalAkhir ."' and tanggalNota >='". $tanggalAwal ."'";

        return DB::select($sql)[0]->grandTotal;
    }

    public static function getTotalPembelianHariIni($tanggalAwal, $tanggalAkhir)
    {
        $sql = "select ifNull(sum(a.qty * a.hargaBeli),0) as total  from ttransaksi a, tnota b where a.noNota = b.noNota and b.isPenjualan = 0  and tanggalNota <='". $tanggalAkhir ."' and tanggalNota >='". $tanggalAwal ."'";

        return DB::select($sql)[0]->total;
    }

    public static function getCountNotaHariIni($tanggalAwal, $tanggalAkhir)
    {
        $sql = "SELECT ifNull(count(noNota),0) as totalNota   FROM tnota where isPenjualan = 1 and tanggalNota <='". $tanggalAkhir ."' and tanggalNota >='". $tanggalAwal ."'";

        return DB::select($sql)[0]->totalNota;
    }

    public static function getTotalStokHariIni()
    {
        $sql = "SELECT sum(hargaBeli*stok) as total FROM tstok where stok>0";

        return DB::select($sql)[0]->total;
    }

    public static function getTotalHutangHariIni()
    {
        $sql = "select Ceiling(sum(totalSebelumDiskon-potongan-(totalSebelumDiskon*diskon/100))) as totalHutang from tnota   where isSelesai = 2";
        $totalHutangSemua = DB::select($sql)[0]->totalHutang;

        $sql = "select SUM(nilai) as cicilan from tcicilanhutang a inner join tnota b on a.noNota=b.noNota where b.isSelesai=2 and nilai>0";

        $cicilan = DB::select($sql)[0]->cicilan;

        return $totalHutangSemua - $cicilan;
    }


    public static function getNota($id)
    {
        $sql = "select noNota,'' as ID,  DATE_FORMAT(tanggalNota, '%d-%m-%Y %H:%i')  as tanggalNota  ,FORMAT(totalSebelumDiskon, 2, 'de_DE')  as totalSebelumDiskon,diskon,potongan,FORMAT(totalSebelumDiskon-potongan-(totalSebelumDiskon*diskon/100), 2, 'de_DE') as grandTotal, case when caraBayar = 1 then 'Tunai' when caraBayar = 2 then 'Debit' else 'Kredit' end as caraBayar,noReferensi, namaUser, ifnull(namaShopHolder,'') as namaShopHolder,keterangan ,FORMAT(bayar, 2, 'de_DE') as bayar,FORMAT(kembalian, 2, 'de_DE') as kembalian, isSelesai  from tnota where noNota='$id'";
        return DB::select($sql)[0];
    }

    public static function getDetailNota($id)
    {
        $sql = "select noBarang,namaBarang,namaSatuan ,qty as qtyTampil,harga as hargaJualSatuan, (qty*harga) as total  FROM tTransaksi where noNota ='$id'";
        return DB::select($sql);
    }

    public static function getRetur($id)
    {
        $sql = "SELECT noBarang,namaBarang, qty, namaSatuan, tanggalRetur, alasan, namaUser FROM tretur a inner join trincianretur b on a.noRetur=b.noRetur where noNota ='$id'";
        return DB::select($sql);
    }


    public static function getTotalPenjualanHariIniResume($tanggalAwal, $tanggalAkhir)
    {
        $query =" SELECT ifNull((sum(totalSebelumDiskon-potongan-(totalSebelumDiskon*diskon/100))),0) as grandTotal   FROM tnota where isPenjualan = 1 and tanggalNota <='". $tanggalAkhir ." 23:59:59' and tanggalNota >='". $tanggalAwal ." 00:00:00'";
        return DB::select($query)[0]->grandTotal;
    }

    public static function getTotalPembelianHariIniResume($tanggalAwal, $tanggalAkhir)
    {
        $query ="select ifNull(sum(a.qty * a.hargaBeli),0) as total  from ttransaksi a, tnota b where a.noNota = b.noNota and b.isPenjualan = 1  and tanggalNota <='". $tanggalAkhir ." 23:59:59'  and tanggalNota >='". $tanggalAwal ." 00:00:00'";
        return DB::select($query)[0]->total;
    }

    public static function getTotalNotaHariIniResume($tanggalAwal, $tanggalAkhir)
    {
        $query =" SELECT ifNull(count(noNota),0) as totalNota   FROM tnota where isPenjualan = 1 and tanggalNota <='". $tanggalAkhir ." 23:59:59' and tanggalNota >='". $tanggalAwal ." 00:00:00'";
        return DB::select($query)[0]->totalNota;
    }

    public static function getProductResume($tanggalAwal, $tanggalAkhir)
    {
        $data = DB::query()
        ->from("ttransaksi")
        ->join("tnota", "ttransaksi.noNota", "=", "tnota.noNota")
        ->select("ttransaksi.noBarang", "ttransaksi.namaBarang", DB::raw("FORMAT(sum(qty), 2, 'de_DE')  as qty,  FORMAT(harga, 2, 'de_DE')  as hargaProduk"), DB::raw("FORMAT(sum(qty * harga), 2, 'de_DE')  as total"))
        ->where("tnota.isPenjualan", "=", 1)
        ->where("tnota.isSelesai", "=", 1);

        if($tanggalAwal) {
            $data->where("tnota.tanggalNota", ">=", $tanggalAwal ." 00:00:00");
        }

        if($tanggalAkhir) {
            $data->where("tnota.tanggalNota", "<=", $tanggalAkhir ." 23:59:59");
        }

        return $data->groupBy("ttransaksi.noBarang", "ttransaksi.namaBarang")->orderBy("ttransaksi.namaBarang", "asc");
    }

    public static function getPurchasing($tanggalAwal, $tanggalAkhir, $status, $caraBayar)
    {
        // $statusQuery = $status != '4' ? "and isSelesai = $status" : "";
        // $caraBayarQuery = $caraBayar != '4' ? "and caraBayar=$caraBayar" : "";

        // $sql = "SELECT noNota,'' as ID, DATE_FORMAT(tanggalNota, '%d-%m-%Y %H:%i')  as tanggalNota ,FORMAT(totalSebelumDiskon, 2, 'de_DE')  as totalSebelumDiskon,diskon,potongan,FORMAT(totalSebelumDiskon-potongan-(totalSebelumDiskon*diskon/100), 2, 'de_DE') as grandTotal, caraBayar  ,noReferensi, namaUser, ifnull(namaShopHolder,'') as namaShopHolder,keterangan, totalCicilan ,bayar,kembalian,isSelesai from tnota a left join (SELECT sum(nilai) as totalCicilan,noNota as noNotaCicilan FROM tcicilanhutang group by noNota) as b on a.noNota=b.noNotaCicilan where isPenjualan = 0 $statusQuery $caraBayarQuery and tanggalNota <='". $tanggalAkhir ." 23:59:59' and tanggalNota >='". $tanggalAwal ." 00:00:00' order by tanggalNota desc" ;

        // DB::raw("FORMAT(sum(qty * harga), 2, 'de_DE')  as total")

        $data = DB::query()
        ->from("tnota")
        ->select("noNota", DB::raw("DATE_FORMAT(tanggalNota, '%d-%m-%Y %H:%i')  as tanggalNota"), DB::raw("FORMAT(totalSebelumDiskon, 2, 'de_DE')  as totalSebelumDiskon"), "diskon", "potongan", DB::raw("FORMAT(totalSebelumDiskon-potongan-(totalSebelumDiskon*diskon/100), 2, 'de_DE') as grandTotal"), "caraBayar", "noReferensi", "namaUser", DB::raw("ifnull(namaShopHolder,'') as namaShopHolder"), "keterangan", "bayar", "kembalian", "isSelesai")
        ->where("tnota.isPenjualan", "=", "0");

        if($tanggalAwal) {
            $data->where("tnota.tanggalNota", ">=", $tanggalAwal ." 00:00:00");
        }

        if($tanggalAkhir) {
            $data->where("tnota.tanggalNota", "<=", $tanggalAkhir ." 23:59:59");
        }

        if($status != '4') {
            $data->where("isSelesai", "=", $status);
        }

        if($caraBayar != '4') {
            $data->where("caraBayar", "=", $caraBayar);
        }

        return $data->orderBy("tanggalNota", "desc");
    }


    public static function getNotaPembelian($id)
    {
        $id = str_replace("%20", " ", $id);
        $query = "select noNota,'' as ID,  DATE_FORMAT(tanggalNota, '%d-%m-%Y %H:%i')  as tanggalNota  ,FORMAT(totalSebelumDiskon, 2, 'de_DE')  as totalSebelumDiskon,diskon,potongan,FORMAT(totalSebelumDiskon-potongan-(totalSebelumDiskon*diskon/100), 2, 'de_DE') as grandTotal, totalSebelumDiskon-potongan-(totalSebelumDiskon*diskon/100) as grandTotalAsli, case when caraBayar = 1 then 'Tunai' else 'Hutang' end as caraBayar,noReferensi, namaUser, ifnull(namaShopHolder,'') as namaShopHolder,keterangan ,FORMAT(bayar, 2, 'de_DE') as bayar,FORMAT(kembalian, 2, 'de_DE') as kembalian, isSelesai, ifNull(totalCicilan, 0) as totalCicilan from tnota a left join (SELECT sum(nilai) as totalCicilan,noNota as noNotaCicilan FROM tcicilanhutang group by noNota) as b on a.noNota=b.noNotaCicilan where noNota like '%$id%'";

        return DB::select($query)[0];

    }

    public static function getDetailNotaPembelian($id)
    {
        $id = str_replace("%20", " ", $id);
        $query = "SELECT noBarang  ,namaBarang,qty, namaSatuan,harga, ifnull(diskon,0) as diskon, '0' as hargaSetelahPPn, '0' as subTotal, ifnull(tglExpired,'') as tglExpired, idStok FROM tTransaksi where noNota  like '%$id%'";


        $data =  DB::select($query);

        foreach ($data as $singleData) {
            $hargatemp = $singleData->harga;
            $qty = $singleData->qty;

            $hargaSementara = $hargatemp;
            if ($singleData->diskon != 0) {
                $hargaSementara = $hargatemp - ($hargatemp * $singleData->diskon / 100);
            }

            $singleData->hargaSetelahPpn = $hargaSementara;
            $singleData->subTotal = $hargaSementara * $qty;
        }

        return $data;
    }


    public static function getTotalBayarPembelian($id)
    {
        $id = str_replace("%20", " ", $id);
        $query = "SELECT  ifNull(sum(nilai),0) as total FROM tcicilanhutang  where noNota like '%$id%' and nilai>0";
        return DB::select($query)[0]->total;
    }


    public static function getReturPembelian($id)
    {
        $id = str_replace("%20", " ", $id);
        $query = "SELECT noBarang,namaBarang, qty, namaSatuan, tanggalRetur, alasan, namaUser FROM tretur a inner join trincianretur b on a.noRetur=b.noRetur where noNota like '%$id%'";
        return DB::select($query);
    }


    public static function getCicilanPembelian($id)
    {
        $id = str_replace("%20", " ", $id);
        $query = "SELECT DATE_FORMAT(tanggal, '%d-%m-%Y')  as tanggal,FORMAT(nilai, 2, 'de_DE')  as nilai FROM tcicilanhutang  where noNota like '%$id%' and nilai>0";
        return DB::select($query);

    }

}
