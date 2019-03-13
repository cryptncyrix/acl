<?php declare(strict_types=1);
namespace cyrixbiz\acl\Http\Requests\Resource;


use Illuminate\Foundation\Http\FormRequest;

class ResourceUpdateRequest extends FormRequest {


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() : array
    {
        return [
            'id'    => 'required|integer',
            'name' => 'sometimes|required|max:191|unique:resources,id,' . $this->get('id'),
            'default_access' => 'required|boolean',
            'info' => 'required|max:191'
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() : bool
    {
        return true;
    }

}