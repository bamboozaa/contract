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
        'contractid',
        'contract_year',
        'dep_id',
        'contract_name',
        'partners',
        'acquisition_value',
        'fund',
        'contract_type',
        'contract_date',
        'start_date',
        'end_date',
        'types_of_guarantee',
        'guarantee_amount',
        'duration',
        'condition',
        'is_returned',
        'returned_date',
        'returned_note',
        'formFile',
        'formFile_description',
        'assignee',
        'status',
    ];

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class, 'dep_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assignee', 'username');
    }

    public function attachments()
    {
        return $this->hasMany(ContractAttachment::class, 'contract_id');
    }
}
