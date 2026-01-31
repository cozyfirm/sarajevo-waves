<?php

namespace App\Traits\Common;
use Carbon\Carbon;
use Illuminate\Http\Request;

trait TimeTrait{
    protected array $_months_short = ['Jan', 'Feb', 'Mar', 'Apr', 'Maj', 'Jun', 'Jul', 'Aug', 'Sep', 'Okt', 'Nov', 'Dec'];
    protected array $_month_name  = [1  => 'Januar', 2  => 'Februar', 3  => 'Mart', 4  => 'April', 5  => 'Maj', 6  => 'Juni', 7  => 'Juli', 8  => 'Avgust', 9  => 'Septembar', 10 => 'Oktobar', 11 => 'Novembar', 12 => 'Decembar'];
    protected array $_month_short = [ 1  => 'Jan', 2  => 'Feb', 3  => 'Mar', 4  => 'Apr', 5  => 'Maj', 6  => 'Jun', 7  => 'Jul', 8  => 'Avg', 9  => 'Sep', 10 => 'Okt', 11 => 'Nov', 12 => 'Dec', ];
    protected mixed $_date = null;

    // Localized days
    public array $_dayNames = ['Mon' => 'Pon', 'Tue' => 'Uto', 'Wed' => 'Sri', 'Thu' => 'Čet', 'Fri' => 'Pet', 'Sat' => 'Sub', 'Sun' => 'Ned', ];

    public function date($date): string{
        $this->_date = Carbon::parse($date);

        return $this->_date->format('d') . '. ' . $this->_months_short[((int)$this->_date->format('m')) - 1] . ' ' . $this->_date->format('Y H:i') . 'h';
    }
    public function onlyDate($date): string{
        $this->_date = Carbon::parse($date);

        return $this->_date->format('d') . '. ' . $this->_months_short[((int)$this->_date->format('m')) - 1] . ' ' . $this->_date->format('Y');
    }
    public function fullDate($date): string{
        $this->_date = Carbon::parse($date);

        return $this->_date->format('d') . '. ' . $this->_month_name[((int)$this->_date->format('m'))] . ' ' . $this->_date->format('Y');
    }
    public function dayAndMonth($date): string{
        $this->_date = Carbon::parse($date);

        return $this->_date->format('d') . '. ' . $this->_months_short[((int)$this->_date->format('m')) - 1];
    }

    /**
     * Month and year: Jan 2026
     * @param $date
     * @return string
     */
    public function monthAndYear($date): string{
        $this->_date = Carbon::parse($date);

        return $this->_month_name[((int)$this->_date->format('m')) ] . ' ' . $this->_date->format('Y');
    }

    /**
     * Format date in dd.mm.yyyy format
     * @param $date
     * @return string
     */
    public function bsDate($date): string{
        return Carbon::parse($date)->format('d.m.Y');
    }
    /**
     * @param int $n
     * @param string $one
     * @param string $few
     * @param string $many
     * @return string
     */
    private function fmt(int $n, string $one, string $few, string $many): string{
        $form = ($n % 10 === 1 && $n % 100 !== 11) ? $one
            : ($n % 10 >= 2 && $n % 10 <= 4 && ($n % 100 < 12 || $n % 100 > 14) ? $few : $many);
        return "{$n} {$form}";
    }

    /**
     * Post and comments time when created; ToDo:: Check this one is correct
     * @param $timestamp
     * @return string
     */
    public function getHumanTime($timestamp): string{
        $time = Carbon::parse($timestamp);
        $now  = Carbon::now();

        $isPast = $time->lessThanOrEqualTo($now);
        $sec    = $time->diffInSeconds($now);              // cijeli broj (uvijek +)
        if ($sec < 60) {
            return $isPast ? 'Prije nekoliko trenutaka' : 'Za nekoliko trenutaka';
        }

        $min = intdiv($sec, 60);

        // do 30 min -> minute
        if ($min < 30) {
            $txt = self::fmt($min, 'minutu', 'minute', 'minuta');
            return $isPast ? "Prije {$txt}" : "Za {$txt}";
        }

        // 30–89 min -> 1 sat
        if ($min < 90) {
            $txt = self::fmt(1, 'sat', 'sata', 'sati'); // vrati "1 sat"
            return $isPast ? "Prije {$txt}" : "Za {$txt}";
        }

        // >= 90 min -> sati (bez decimala, zaokruženo na dolje)
        $hrs = intdiv($min, 60);
        if ($hrs < 24) {
            $txt = self::fmt($hrs, 'sat', 'sata', 'sati');
            return $isPast ? "Prije {$txt}" : "Za {$txt}";
        }

        // dalje po danima
        if ($time->isToday())     return 'Danas';
        if ($time->isYesterday()) return 'Jučer';

        $days = $time->diffInDays($now);
        if ($days < 7) {
            $txt = self::fmt($days, 'dan', 'dana', 'dana');
            return $isPast ? "Prije {$txt}" : "Za {$txt}";
        }

        return $time->format('d.m.Y. H:i');

    }
}
