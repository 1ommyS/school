<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Mark
 * @package App\Models
 * @mixin \Illuminate\Database\Query\Builder
 */
class Mark extends Model
{
    use HasFactory;

    /**
     * @var string
     */


    protected $table = "marks";
    /**
     * @var string[]
     */

    protected $fillable = [
        "student_id",
        "group_id",
        "mark",
        "created_at"
    ];
}