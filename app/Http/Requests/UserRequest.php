<?phpnamespace App\Http\Requests;use Illuminate\Foundation\Http\FormRequest;class UserRequest extends FormRequest{    /**     * Get the validation rules that apply to the request.*     * @return array     */    public function rules (): array    {        return [            'login' => 'required|unique:users',            'password' => 'required',            'name' => 'required',            'city' => 'required',            'phone_student' => 'required',            'phone_parent' => 'required',            'birthday' => 'required',            'age' => 'required',            'link_vk' => 'required',            'name_parent' => 'required',        ];    }}