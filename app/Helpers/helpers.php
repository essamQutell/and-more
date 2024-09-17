<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;




function convert_date(?string $date): string
{
    return Carbon::parse($date)->format('Y-m-d');
}
function folderPath(string $path): void
{
    if (! file_exists($path)) {
        mkdir($path, 0777, true);
    }
}

function getFile($filename): string
{
    if (! $filename) {
        return url('images/logo.png');
    }

    return url('uploads/'.$filename);
}

function getExport($filename): string
{
    if (! $filename) {
        return url('images/logo.png');
    }

    return url('exports/'.$filename);
}

function generateVerificationCode(): int
{
    return rand(100000, 999999);
}

function getNearest($query, $lat, $lng)
{
    return $query->select(
        '*',
        DB::raw(
            '6371 * acos(cos(radians('.$lat.'))
        * cos(radians(lat)) * cos(radians(lang) - radians('.$lng.'))
        + sin(radians('.$lat.')) * sin(radians(lat))) AS distance'
        )
    );
    //       ->having("distance", "<", $radius)

}

function distance($lat1, $lon1, $lat2, $lon2): float
{
    $pi80 = M_PI / 180;
    $lat1 *= $pi80;
    $lon1 *= $pi80;
    $lat2 *= $pi80;
    $lon2 *= $pi80;
    $r = 6372.797; // mean radius of Earth in km
    $dlat = $lat2 - $lat1;
    $dlon = $lon2 - $lon1;
    $a = sin($dlat / 2) * sin($dlat / 2) + cos($lat1) * cos($lat2) * sin($dlon / 2) * sin($dlon / 2);
    $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
    return $r * $c;
}
function getTotalAfterDiscount(float $total, ?float $percentage): float
{
    return $total - $total * ($percentage / 100);
}

function getTotalAfterTax(float $total): float
{
    return $total + $total * (15 / 100);
}

function getDiscountValue(float $total, ?float $percentage): int
{
    return ($total * $percentage) / 100;
}

function getTaxValue(): int
{
    return 15;
    //($total * $setting->tax) / 100;
}

function dateFormatByDate(?string $date): array
{
    $dateformat = Carbon::createFromFormat('Y-m-d', $date ?? Carbon::now()->format('Y-m-d'));
    $month = $dateformat->format('m');
    $year = $dateformat->format('Y');
    $day = $dateformat->format('d');

    return [
        'year' => $year,
        'month' => $month,
        'day' => $day,
    ];
}

function convertDate(?string $date): string
{
    return Carbon::parse($date)->format('Y-m-d');
}

function convertTime(?string $time): string
{
    return date('H:i', strtotime(convert2english($time)));
}

function convertTimeTwelve(?string $time): string
{
    return $time !== null ? date('h:i A', strtotime($time)) : '';
}

function convertToDay(?string $date): string
{
    $data = $date ?? Carbon::now()->format('Y-m-d');

    return Str::lower(Carbon::createFromFormat('Y-m-d', $data)->format('l'));
}

function convertToEnglish(string $string): string
{
    $newNumbers = ['PM', 'AM', '0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
    $arabic = ['م', 'ص', '٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩'];

    return str_replace($arabic, $newNumbers, $string);
}

function convertToArabic(string $string): string
{
    $newNumbers = ['PM', 'AM'];
    $arabic = ['م', 'ص'];

    return str_replace($newNumbers, $arabic, $string);
}

function getCountHours(?string $time_from, ?string $time_to): string
{
    if ($time_from === null || $time_to === null) {
        return '0';
    }
    $fromDateTime = Carbon::createFromFormat('h:i A', $time_from);
    $toDateTime = Carbon::createFromFormat('h:i A', $time_to);

    return $toDateTime->diffInHours($fromDateTime);
}

function calculateAge($birthdate): int
{
    $birthDate = Carbon::parse($birthdate);
    $currentDate = Carbon::now();

    return $currentDate->diffInYears($birthDate);
}
