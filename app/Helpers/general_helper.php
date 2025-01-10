<?php

if (!function_exists('alnum')) {
    function alnum($string)
    {
        return preg_replace('/[^a-zA-Z0-9]/', '', $string);
    }
}

if (!function_exists('format_angka')) {
    function format_angka($angka)
    {
        return number_format($angka, 0, ',', '.');
    }
}

if (!function_exists('format_rp')) {
    function format_rp($angka)
    {
        return 'Rp. ' . number_format($angka, 0, ',', '.');
    }
}

if (!function_exists('format_rp_lkp')) {
    function format_rp_lkp($angka)
    {
        return 'Rp. ' . number_format($angka, 2, ',', '.');
    }
}

if (!function_exists('format_rp_lkp2')) {
    function format_rp_lkp2($angka)
    {
        return 'Rp. ' . number_format($angka, 0, ',', '.') . ',-';
    }
}

if (!function_exists('format_rp_str')) {
    function format_rp_str($angka)
    {
        $hasil = terbilang($angka);
        return ucwords($hasil) . ' Rupiah';
    }
}

if (!function_exists('format_angka_str')) {
    function format_angka_str($angka)
    {
        return ucwords(terbilang($angka));
    }
}

if (!function_exists('format_angka_rmw')) {
    function format_angka_rmw($angka)
    {
        $roman = [
            1000 => 'M',
            900 => 'CM',
            500 => 'D',
            400 => 'CD',
            100 => 'C',
            90 => 'XC',
            50 => 'L',
            40 => 'XL',
            10 => 'X',
            9 => 'IX',
            5 => 'V',
            4 => 'IV',
            1 => 'I'
        ];

        $result = '';
        foreach ($roman as $value => $numeral) {
            while ($angka >= $value) {
                $result .= $numeral;
                $angka -= $value;
            }
        }
        return $result;
    }
}

if (!function_exists('terbilang')) {
    function terbilang($angka)
    {
        $angka = abs($angka);
        $baca = array('', 'satu', 'dua', 'tiga', 'empat', 'lima', 'enam', 'tujuh', 'delapan', 'sembilan', 'sepuluh', 'sebelas');
        $terbilang = '';

        if ($angka < 12) {
            $terbilang = ' ' . $baca[$angka];
        } elseif ($angka < 20) {
            $terbilang = terbilang($angka - 10) . ' belas';
        } elseif ($angka < 100) {
            $terbilang = terbilang($angka / 10) . ' puluh' . terbilang($angka % 10);
        } elseif ($angka < 200) {
            $terbilang = ' seratus' . terbilang($angka - 100);
        } elseif ($angka < 1000) {
            $terbilang = terbilang($angka / 100) . ' ratus' . terbilang($angka % 100);
        } elseif ($angka < 2000) {
            $terbilang = ' seribu' . terbilang($angka - 1000);
        } elseif ($angka < 1000000) {
            $terbilang = terbilang($angka / 1000) . ' ribu' . terbilang($angka % 1000);
        } elseif ($angka < 1000000000) {
            $terbilang = terbilang($angka / 1000000) . ' juta' . terbilang($angka % 1000000);
        } elseif ($angka < 1000000000000) {
            $terbilang = terbilang($angka / 1000000000) . ' milyar' . terbilang($angka % 1000000000);
        } elseif ($angka < 1000000000000000) {
            $terbilang = terbilang($angka / 1000000000000) . ' trilyun' . terbilang($angka % 1000000000000);
        }

        return $terbilang;
    }
}

if (!function_exists('isMenuActive')) {
    /**
     * Check if current menu is active
     *
     * @param string|array $paths Path or array of paths to check
     * @param bool $exact Match exact path or use contains
     * @return bool
     */
    function isMenuActive($paths, bool $exact = false): bool
    {
        $uri = service('uri');
        $currentSegment = $uri->getSegment(1) ?? '';  // Get first segment, empty if none
        
        // Convert single path to array
        $paths = (array) $paths;
        
        foreach ($paths as $path) {
            // Remove leading/trailing slashes
            $path = trim($path, '/');
            
            if ($exact) {
                // Exact path matching
                if ($currentSegment === $path) {
                    return true;
                }
            } else {
                // Contains path matching
                if ($currentSegment === $path) {
                    return true;
                }
            }
        }
        
        return false;
    }
} 