<?php

namespace App\Models;

use App\libs\VkBot;
use App\Repositories\Implementations\GroupRepository;
use App\Repositories\Implementations\UserRepository;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

/**
 * Class Birthday
 * @package App\Models
 * @mixin \Illuminate\Database\Query\Builder
 */
class Birthday extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = "birthdays_notifications";
    /**
     * @var string[]
     */
    protected $fillable = [
        "date"
    ];
}
