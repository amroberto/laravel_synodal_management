<?php

namespace App\Models;

use App\Models\Beneficiary;
use App\Enums\OfferTypeEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OfferPlan extends Model
{
    protected $fillable = [
        'offer_date',
        'liturgical_date',
        'destination',
        'offer_type',
        'month',
        'year'
    ];

    public $timestamps = true;

    protected $casts = [
        'offer_type' => OfferTypeEnum::class,
    ];



    public function getMonthNameAttribute(): string
    {
        $months = [
            1  => "Janeiro",
            2  => "Fevereiro",
            3  => "Março",
            4  => "Abril",
            5  => "Maio",
            6  => "Junho",
            7  => "Julho",
            8  => "Agosto",
            9  => "Setembro",
            10 => "Outubro",
            11 => "Novembro",
            12 => "Dezembro",
        ];

        return $months[$this->month] ?? 'Mês inválido';
    }

    public function getMesAbreviadoAttribute(): string
    {
        $months = [
            1 => 'JAN',
            2 => 'FEV',
            3 => 'MAR',
            4 => 'ABR',
            5 => 'MAI',
            6 => 'JUN',
            7 => 'JUL',
            8 => 'AGO',
            9 => 'SET',
            10 => 'OUT',
            11 => 'NOV',
            12 => 'DEZ',
        ];

        return $months[(int) $this->month] ?? '-';
    }
}
