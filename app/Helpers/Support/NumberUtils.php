<?php

class NumberUtils{
    /**
     * Return formatted number;
     *      - 24 -> 24
     *      - 126 -> 0.1K
     *      - 1246 -> 1.2K
     * ...
     *
     * @param int|float $value
     * @return string
     */
    public static function abbreviateNumber(int|float $value): string{
        // If value <= 199, return as plain number
        if ($value <= 199) {
            return (string)$value;
        }

        // If value is between 200 and 999, format it as X.XK
        if ($value < 1000) {
            // Convert to thousands (e.g. 250 => 0.25K)
            $scaled = $value / 1000;

            // Always show 1 decimal here
            return number_format($scaled, 1) . 'K';
        }

        // Units for large number formatting
        $units = ['K', 'M', 'B', 'T'];
        $unitIndex = -1;

        // Scale the number down
        while ($value >= 1000 && $unitIndex < count($units) - 1) {
            $value /= 1000;
            $unitIndex++;
        }

        // Format: 1 decimal if < 10, otherwise no decimals
        $formatted = $value < 10
            ? number_format($value, 1)
            : number_format($value, 0);

        return $formatted . $units[$unitIndex];
    }
}
