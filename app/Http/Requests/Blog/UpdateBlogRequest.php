<?php

namespace App\Http\Requests\Blog;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateBlogRequest extends FormRequest
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
        return [
            'title' => ['required', 'string', 'max:255', 'unique:blogs,title', Rule::unique('blogs')->ignore($this->blog)],
            'slug' => ['string', 'unique:blogs,slug', Rule::unique('blogs')->ignore($this->blog)],
            'content' => ['string', 'nullable'],
        ];
    }
}
