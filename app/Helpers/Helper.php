<?php

use App\Traits\Common\TimeTrait;
use Carbon\Carbon;

class Helper{
    use TimeTrait;

    /**
     * Get page title in format TITLE | APP_NAME
     * @param $title
     * @return string
     */
    public static function getPageTitle($title): string{
        return ($title == '') ? env('APP_NAME') : ($title . " | " . env('APP_NAME'));
    }

    /** Check if it's in range of days */
    public static function isInInterval(array $days = ['sunday', 'monday', 'tuesday']): bool{
        $today = strtolower(Carbon::now()->format('l')); // for an example "monday"
        $days = array_map('strtolower', $days);         // normalise

        return in_array($today, $days);
    }

    /**
     * Get current datetime formatted
     * @return string
     */
    public static function currentDateTime(): string{
        return (new self())->date(Carbon::now());
    }
}
