<?php

namespace App\Http\Requests\Tenant;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SettingUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'attribute_slug' => ['required', 'string','exists:attributes,slug'],
            'value' => ['required'],
        ];
    }
}
