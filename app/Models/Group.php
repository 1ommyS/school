<?php

namespace App\Models;

use App\libs\VkBot;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;

/**
 * Class Group
 * @package App\Models
 * @mixin Builder
 */
class Group extends Model
{
    use HasFactory;

    private VkBot $bot;

    protected $fillable = [
        "name_group",
        "technology",
        'schedule',
        'year',
        'age',
        'teacher_id'
    ];

    public function isArchive ($group_id)
    {
        return Group::find($group_id)->archive == 1;
   }
}