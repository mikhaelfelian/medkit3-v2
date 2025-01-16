<?php

if (!function_exists('alnum')) {
    function alnum($string)
    {
        return preg_replace('/[^a-zA-Z0-9]/', '', $string);
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
        $segments = $uri->getSegments(); // Get all segments
        $currentPath = implode('/', $segments); // Join segments with /
        
        // Convert single path to array
        $paths = (array) $paths;
        
        foreach ($paths as $path) {
            // Remove leading/trailing slashes
            $path = trim($path, '/');
            
            if ($exact) {
                // Exact path matching
                if ($currentPath === $path) {
                    return true;
                }
            } else {
                // Contains path matching
                if (strpos($currentPath, $path) !== false) {
                    return true;
                }
            }
        }
        
        return false;
    }
}

if (!function_exists('isStockable')) {
    /**
     * Check if item is stockable and return badge
     * 
     * @param mixed $value Value to check
     * @return string HTML badge element
     */
    function isStockable($value = '1'): string
    {
        if ($value) {
            return br().'<span class="badge badge-success">Stockable</span>';
        }
        return ''; // Return empty string when not stockable
    }
}

if (!function_exists('jns_klm')) {
    /**
     * Get gender description based on the provided code
     * 
     * @param string $code Gender code
     * @return string Gender description
     */
    function jns_klm(string $code): string
    {
        $genders = [
            'L' => 'Laki-laki',
            'P' => 'Perempuan',
            'B' => 'Banci',
            'G' => 'Gay'
        ];

        return $genders[$code] ?? 'Unknown';
    }
}
