<?php
namespace app\components;

class Konversi
{
    public static function bulanromawi($bln)
    {
        $romawi = ['I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X', 'XI', 'XII'];
        return $romawi[$bln-1];
    }

    public static function bulanindonesia($bln)
    {
        $indonesia = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

        return $indonesia[$bln-1];
    }

    public static function hariindonesia($day)
    {
        $hari = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jum\'at', 'Sabtu', 'Minggu'];
        return $hari[$day-1];
    }

    public static function indonesiablnthnformat($date)
    {
        $bln = date('n', strtotime($date));
        $thn = date('Y', strtotime($date));

        return self::bulanindonesia($bln) . ' ' . $thn;
    }

    public static function indonesiadateformat($date)
    {
        $tgl = date('d', strtotime($date));
        $bln = date('n', strtotime($date));
        $thn = date('Y', strtotime($date));

        return $tgl . ' ' . self::bulanindonesia($bln) . ' ' . $thn;
    }

    public static function longindonesiadateformat($date)
    {
        $jam = date('H', strtotime($date));
        $mnt = date('i', strtotime($date));
        $det = date('s', strtotime($date));

        return self::indonesiadateformat($date) . ' ' . $jam . ':' . $mnt . ':' . $det;
    }
}
