<?php

function DateFormat($date, $format)
{
    return \Carbon\Carbon::parse($date)->isoFormat($format);
}

function DateConvert($date)
{
    return \Carbon\Carbon::parse($date);
}

function GetNowDate($format = "")
{
    $nowTime = \Carbon\Carbon::now();

    return $format ? \Carbon\Carbon::parse($nowTime)->isoFormat($format) : $nowTime;
}

function NumberFormat($number, $decimal = 0)
{
    return number_format($number, $decimal, ',', '.');
}

function IsActive($value)
{
    return $value === "1" ? "Aktif" : "Non Aktif";
}

function GetNumber($header, $data)
{
    $result = "";
    $index = 1;
    $counterString = "";
    while(true) {
        $indexString = strval($index);
        $counterString = "";

        for ($i=5; $i > strlen($indexString); $i--) {
            $counterString = $counterString . "0";
        }
        $result = $header . $counterString . $indexString;

        $numberExists = $data->where("number", $result);
        if (count($numberExists) == 0) {
            break;
        }

        $index++;

        if($index === 1000) {
            break;
        }
    }

    return $result;
}