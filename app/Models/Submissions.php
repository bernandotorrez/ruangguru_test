<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Submissions extends Model
{
    use HasFactory;

    protected $table = 'submissions';
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'user_email',
        'delivery_address',
        'contact_number',
        'contact_person',
        'is_eligible',
        'status_submission',
        'date_rejected',
        'rejected_by',
        'date_delivery',
        'delivery_by',
        'is_deleted',
    ];
}
