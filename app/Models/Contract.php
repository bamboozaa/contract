<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    use HasFactory;
    protected $table = 'contracts';
    protected $fillable = ['contract_no', 'contract_year', 'dep_id', 'contract_name', 'partners', 'acquisition_value', 'fund', 'contract_type'];
}
