<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        $locale = app()->getLocale();

        return [
            "{$locale}.name" => 'required|max:100',
            "{$locale}.slug" => ['required', 'max:100', 'unique:category_translations,slug,' . $this->id . ',category_id'],
            "{$locale}.meta_title" => 'nullable|max:250',
            "{$locale}.meta_description" => 'nullable|max:500',
        ];
    }
}
