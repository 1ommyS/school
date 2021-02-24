<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class AuxPayments
 * @package App\Models
 * @mixin \Illuminate\Database\Query\Builder
 */
class AuxPayments extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = "other_payments";
    protected $fillable = ["date", "price", "comment"];
}
