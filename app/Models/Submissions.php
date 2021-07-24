<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Submissions extends Model
{
    use HasFactory;

    protected $table = 'submissions';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'delivery_address',
        'contact_number',
        'contact_person',
        'status',
        'date_rejected',
        'rejected_by',
        'date_delivery',
        'delivery_by',
    ];
}
