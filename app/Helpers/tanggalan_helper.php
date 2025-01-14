<?php

if (!function_exists('tgl_indo')) {
    function tgl_indo($date)
    {
        if (empty($date) || $date == '0000-00-00') return '';
        return date('m/d/y', strtotime($date));
    }
}

if (!function_exists('tgl_indo2')) {
    function tgl_indo2($date)
    {
        if (empty($date) || $date == '0000-00-00') return '';
        return date('d/m/y', strtotime($date));
    }
}

if (!function_exists('tgl_indo3')) {
    function tgl_indo3($date)
    {
        if (empty($date) || $date == '0000-00-00') return '';
        return date('d-m-Y', strtotime($date));
    }
}

if (!function_exists('tgl_indo4')) {
    function tgl_indo4($date)
    {
        if (empty($date) || $date == '0000-00-00') return '';
        return date('j M Y', strtotime($date));
    }
}

if (!function_exists('tgl_indo5')) {
    function tgl_indo5($date)
    {
        if (empty($date) || $date == '0000-00-00') return '';
        $bulan = array(
            1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
            'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
        );
        $split = explode('-', date('Y-m-d', strtotime($date)));
        return $split[2] . ' ' . $bulan[(int)$split[1]] . ' ' . $split[0];
    }
}

if (!function_exists('tgl_indo6')) {
    function tgl_indo6($date)
    {
        if (empty($date) || $date == '0000-00-00 00:00:00') return '';
        return date('m/d/y H:i', strtotime($date));
    }
}

if (!function_exists('tgl_indo7')) {
    function tgl_indo7($date)
    {
        if (empty($date) || $date == '0000-00-00 00:00:00') return '';
        return date('d/m/y H:i', strtotime($date));
    }
}

if (!function_exists('tgl_indo8')) {
    function tgl_indo8($date)
    {
        if (empty($date) || $date == '0000-00-00 00:00:00') return '';
        return date('d-m-y H:i', strtotime($date));
    }
}

if (!function_exists('tgl_indo_sys')) {
    function tgl_indo_sys($date)
    {
        if (empty($date)) return '';
        return date('Y-m-d', strtotime($date));
    }
} 