<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContractAttachment extends Model
{
    protected $table = 'contract_attachments';

    protected $fillable = [
        'contract_id',
        'filename',
        'original_name',
        'description',
        'uploaded_by',
    ];

    public function contract()
    {
        return $this->belongsTo(Contract::class);
    }
}
