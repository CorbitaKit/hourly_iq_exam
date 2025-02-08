<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Occupation extends Model
{
    protected $fillable = [
        'job_id',
        'invoice_number',
        'date',
        'total_amount',
        'customer_name'
    ];
}
