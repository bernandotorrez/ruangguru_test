<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSubcriptions extends Model
{
    use HasFactory;

    protected $table = 'product_subscriptions';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product_subscription_name',
        'product_tag',
        'is_deleted',
        'created_by',
        'updated_by',
        'deleted_by',
        'deleted_date',
    ];
}
