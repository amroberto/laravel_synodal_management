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
        'beneficiary_id',
        'offer_type',
        'month',
        'year'
    ];

    protected $casts = [
        'offer_type' => OfferTypeEnum::class,
    ];


    /**
     * @return BelongsTo
     */
    public function beneficiary(): BelongsTo
    {
        return $this->belongsTo(Beneficiary::class);
    }

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
}
