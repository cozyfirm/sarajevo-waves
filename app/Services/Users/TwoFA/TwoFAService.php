<?php

namespace App\Services\Users\TwoFA;

class TwoFAService{
    protected static string $_map = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ234567';
    /**
     * @param int $length
     * @return string | null
     */
    public static function generateSecret(int $length = 32): string | null{
        try{
            $secret = '';

            for ($i = 0; $i < $length; $i++) {
                $secret .= self::$_map[random_int(0, strlen(self::$_map) - 1)];
            }

            return $secret;
        }catch (\Exception $e){
            return null;
        }
    }

    /**
     * Decode secret
     * @param $secret
     * @return string
     */
    public static function base32Decode($secret): string{
        $secret = strtoupper($secret);

        $bits = '';
        foreach (str_split($secret) as $c) {
            $bits .= str_pad(decbin(strpos(self::$_map, $c)), 5, '0', STR_PAD_LEFT);
        }

        $binary = '';
        foreach (str_split($bits, 8) as $byte) {
            $binary .= chr(bindec(str_pad($byte, 8, '0')));
        }

        return $binary;
    }


    /**
     * @param $secret
     * @param $timeSlice
     * @return string
     */
    private static function totp($secret, $timeSlice): string{
        $secretKey = self::base32Decode($secret);

        $time = pack('N*', 0) . pack('N*', $timeSlice);

        $hash = hash_hmac('sha1', $time, $secretKey, true);

        $offset = ord(substr($hash, -1)) & 0x0F;

        $truncated =
            ((ord($hash[$offset]) & 0x7F) << 24) |
            ((ord($hash[$offset + 1]) & 0xFF) << 16) |
            ((ord($hash[$offset + 2]) & 0xFF) << 8) |
            (ord($hash[$offset + 3]) & 0xFF);

        return str_pad($truncated % 1000000, 6, '0', STR_PAD_LEFT);
    }

    /**
     * Verify code
     * @param $secret
     * @param $code
     * @return bool
     */
    public static function verifyCode($secret, $code): bool{
        $timeSlice = floor(time() / 30);

        for ($i = -1; $i <= 1; $i++) { // Small toleration for +-30 sec
            $calc = self::totp($secret, $timeSlice + $i);
            if ($calc === $code) return true;
        }

        return false;
    }
}
