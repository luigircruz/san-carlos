<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BlogRequest extends FormRequest
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
        return match($this->method()) {
            'POST' => $this->store(),
            'PUT', 'PATCH' => $this->update(),
            'DELETE' => $this->destroy()
        };
    }

    /**
     * Get the validation rules that apply to the post request.
     *
     * @return array
     */
    public function store()
    {
        return [
            'title' => [
                'required',
                'string',
                'max:255',
                'unique:blogs,title'
            ],
            'slug' => [
                'required',
                'string',
                'unique:blogs,slug'
            ],
            'content' => [
                'string',
                'nullable'
            ],
        ];
    }

    /**
     * Get the validation rules that apply to the put/patch request.
     *
     * @return array
     */
    public function update()
    {
        return [
            'title' => [
                'required',
                'string',
                'max:255',
                Rule::when($this->blog->exists, 'sometimes')
            ],
            'slug' => [
                'required',
                'string',
                Rule::when($this->blog->exists, 'sometimes')
            ],
            'content' => [
                'string',
                'nullable'
            ],
        ];
    }

    /**
     * Get the validation rules that apply to the delete request.
     *
     * @return array
     */
    public function destroy()
    {
        return [
            //
        ];
    }
}
