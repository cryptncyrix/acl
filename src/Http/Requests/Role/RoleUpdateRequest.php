<?php declare(strict_types=1);
namespace cyrixbiz\acl\Http\Requests\Role;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class RoleUpdateRequest
 * @package cyrixbiz\acl\Http\Requests\Role
 */
class RoleUpdateRequest extends FormRequest {

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() : array
    {
        return [
            'id'    => 'required|integer',
            'name' => 'sometimes|required|max:191|unique:roles,id,' . $this->get('id'),
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