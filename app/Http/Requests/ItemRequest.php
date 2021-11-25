<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ItemRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $route = $this->route()->getName();

        $rule = [
            'lost_desc' => 'required|string|max:50',
            'feature' => 'string|max:500',
            'category_id' => 'required|exists:categories,id',
        ];

        if ($route === 'items.store') {
            $rule['file'] = 'required|file|image|mimes:jpeg,png';
        } else {
            $rule['file'] = 'file|image|mimes:jpeg,png';
        }

        return $rule;
    }
}
