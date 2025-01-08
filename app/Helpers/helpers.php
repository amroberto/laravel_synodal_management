<?php

if (!function_exists('formatPhoneNumber')) {
    function formatPhoneNumber(string $number): string
    {
        $number = preg_replace('/\D/', '', $number);

        if (strlen($number) === 11) {
            return preg_replace('/(\d{2})(\d{5})(\d{4})/', '($1) $2-$3', $number);
        }

        if (strlen($number) === 10) {
            return preg_replace('/(\d{2})(\d{4})(\d{4})/', '($1) $2-$3', $number);
        }

        return $number;
    }
}

