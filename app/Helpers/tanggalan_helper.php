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

if (!function_exists('usia_lkp')) {
    /**
     * Calculate complete age (years, months, days) from date
     * Format output: dd-mm-yyyy (xx tahun xx bulan xx hari)
     * 
     * @param string $date Date in any format that strtotime understands
     * @return string Formatted date with age
     */
    function usia_lkp($date)
    {
        if (empty($date) || $date == '0000-00-00') {
            return '';
        }

        try {
            // Convert input date to DateTime
            $birthDate = new DateTime($date);
            $today = new DateTime('today');

            // Get the difference between dates
            $diff = $today->diff($birthDate);

            // Format the original date
            $formatted_date = $birthDate->format('d-m-Y');

            // Build age string
            $age_parts = [];
            
            if ($diff->y > 0) {
                $age_parts[] = $diff->y . ' tahun';
            }
            if ($diff->m > 0) {
                $age_parts[] = $diff->m . ' bulan';
            }
            if ($diff->d > 0) {
                $age_parts[] = $diff->d . ' hari';
            }

            $age_string = implode(' ', $age_parts);

            // Return formatted string
            return $formatted_date . ' (' . $age_string . ')';

        } catch (Exception $e) {
            log_message('error', '[usia_lkp] ' . $e->getMessage());
            return $date; // Return original date if there's an error
        }
    }
} 