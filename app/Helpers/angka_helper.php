<?php

if (!function_exists('format_angka_rp')) {
    /**
     * Format number to Indonesian Rupiah
     * 
     * @param mixed $angka Number to format
     * @param bool $withRp Include 'Rp ' prefix
     * @return string
     */
    function format_angka_rp($angka, bool $withRp = true)
    {
        if ($angka === null || $angka === '') {
            return $withRp ? 'Rp 0' : '0';
        }
        
        $formatted = number_format($angka, 0, ',', '.');
        return $withRp ? 'Rp ' . $formatted : $formatted;
    }
}

if (!function_exists('format_angka_db')) {
    /**
     * Format number for database (remove thousand separator and currency symbol)
     * 
     * @param mixed $angka Number to format
     * @return float
     */
    function format_angka_db($angka)
    {
        $angka  = (float)$angka;
        $string = str_replace(',', '.', str_replace('.', '', $angka));
        return $string;
    }
}

if (!function_exists('format_angka')) {
    /**
     * Format number with thousand separator
     * 
     * @param mixed $angka Number to format
     * @param int $decimal Number of decimal places
     * @return string
     */
    function format_angka($angka, int $decimal = 0)
    {
        if ($angka === null || $angka === '') {
            return '0';
        }
        
        return number_format($angka, $decimal, ',', '.');
    }
}

if (!function_exists('terbilang')) {
    /**
     * Convert number to Indonesian words
     * 
     * @param mixed $angka Number to convert
     * @return string
     */
    function terbilang($angka)
    {
        $angka = abs($angka);
        $baca = ['', 'Satu', 'Dua', 'Tiga', 'Empat', 'Lima', 'Enam', 'Tujuh', 'Delapan', 'Sembilan', 'Sepuluh', 'Sebelas'];
        $terbilang = '';
        
        if ($angka < 12) {
            $terbilang = ' ' . $baca[$angka];
        } elseif ($angka < 20) {
            $terbilang = terbilang($angka - 10) . ' Belas';
        } elseif ($angka < 100) {
            $terbilang = terbilang($angka / 10) . ' Puluh' . terbilang($angka % 10);
        } elseif ($angka < 200) {
            $terbilang = ' Seratus' . terbilang($angka - 100);
        } elseif ($angka < 1000) {
            $terbilang = terbilang($angka / 100) . ' Ratus' . terbilang($angka % 100);
        } elseif ($angka < 2000) {
            $terbilang = ' Seribu' . terbilang($angka - 1000);
        } elseif ($angka < 1000000) {
            $terbilang = terbilang($angka / 1000) . ' Ribu' . terbilang($angka % 1000);
        } elseif ($angka < 1000000000) {
            $terbilang = terbilang($angka / 1000000) . ' Juta' . terbilang($angka % 1000000);
        } elseif ($angka < 1000000000000) {
            $terbilang = terbilang($angka / 1000000000) . ' Milyar' . terbilang($angka % 1000000000);
        }
        
        return $terbilang;
    }
} 