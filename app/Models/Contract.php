<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Contract extends Model
{
    use HasFactory;
    protected $table = 'contracts';
    protected $fillable = [
        'contract_no',
        'contract_year',
        'dep_id',
        'contract_name',
        'partners',
        'acquisition_value',
        'fund',
        'contract_type',
        'start_date',
        'end_date',
        'types_of_guarantee',
        'guarantee_amount',
        'duration',
        'condition',
        'formFile',
        'status',
    ];

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class, 'dep_id');
    }
}
