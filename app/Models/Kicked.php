<?phpnamespace App\Models;use Carbon\Carbon;use Illuminate\Database\Eloquent\Factories\HasFactory;use Illuminate\Database\Eloquent\Model;/** * Class Kicked * @package App\Models * @mixin \Illuminate\Database\Query\Builder */class Kicked extends Model{    use HasFactory;    protected $table = "kicked_students";   protected $fillable = [       "student_id",        "group_name"    ];    public static function getKickedStudents ()    {        $students = self::all();        foreach ( $students as $student ) {            $student->name = User::where("id", $student->student_id)->first()->name;            $student->kicked_at = Carbon::parse($student->created_at)->diffForHumans();        }        return $students;    }}