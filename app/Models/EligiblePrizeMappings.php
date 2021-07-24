<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EligiblePrizeMappings extends Model
{
    use HasFactory;

    protected $table = 'eligible_prize_mappings';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product_subscription_id',
        'prize_list_id',
        'is_deleted',
        'created_by',
        'updated_by',
        'deleted_by',
        'deleted_date',
    ];
}
