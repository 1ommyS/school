<?phpnamespace App\Models;use App\libs\VkBot;use App\Repositories\GroupRepository;use App\Repositories\UserRepository;use Illuminate\Database\Eloquent\Factories\HasFactory;use Illuminate\Database\Eloquent\Model;use Illuminate\Support\Facades\Auth;use Illuminate\Support\Facades\DB;/** * Class StudentGroups * @package App\Models * @mixin \Illuminate\Database\Query\Builder */class Student extends Model{    use HasFactory;    protected $table = "users";    protected $primaryKey = 'id';    public function student_groups ()    {        return $this->hasMany(StudentGroups::class);    }}