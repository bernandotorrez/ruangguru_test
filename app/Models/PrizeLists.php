<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrizeLists extends Model
{
    use HasFactory;

    protected $table = 'prize_lists';
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'prize_name',
        'is_deleted',
        'created_by',
        'updated_by',
        'deleted_by',
        'deleted_date',
    ];
}
