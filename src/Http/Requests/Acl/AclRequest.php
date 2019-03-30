<?php declare(strict_types=1);
namespace cyrixbiz\acl\Http\Requests\Acl;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class AclRequest
 * @package cyrixbiz\acl\Http\Requests\Acl
 */
class AclRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() : array
    {
        $rules['_id'] = 'required|integer';
        $rules['action'] = 'required';

        foreach ($this->new as $key => $value)
        {
                $rules['new.'. $key] = 'boolean';
                $rules['old.'. $key] = 'boolean|nullable';
        }
        return $rules;
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