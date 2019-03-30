<?php declare(strict_types=1);
namespace cyrixbiz\acl\Http\Requests\Resource;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class ResourceRequest
 * @package cyrixbiz\acl\Http\Requests\Resource
 */
class ResourceRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() : array
    {
        return [
            'name' => 'required|unique:resources|max:191',
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