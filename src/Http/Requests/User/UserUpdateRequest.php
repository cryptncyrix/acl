<?php declare(strict_types=1);
namespace cyrixbiz\acl\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class UserUpdateRequest
 * @package cyrixbiz\acl\Http\Requests\User
 */
class UserUpdateRequest extends FormRequest {

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() : array
    {
        return [
            'id' => 'required|integer',
            'name' => 'required|string|max:191|unique:users,id,' .$this->get('id'),
            'email' => 'required|string||max:191|email|unique:users,id,' .$this->get('id'),
            'password' => 'max:191',
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