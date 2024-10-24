<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CategoriesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rule = [
            'name' => ['max:255', 'string'],
            'description' => ['max:255'],
            'parent_id' => ['nullable', 'exists:categories,id'],
            'thumbnail' => ['image', 'mimes:jpeg,png,jpg', 'max:2048'],
            'parent' => ['nullable', 'exists:categories,id'],
        ];
        if ($this->method() === 'POST') {
            array_push($rule['name'], 'required', 'unique:categories');
        } elseif ($this->method() === 'PUT') {
            array_push($rule['name'], 'required', 'unique:categories,name,' . $this->categories);
        }
        return $rule;
    }
    public function messages(): array
    {
        return [
            'name.required' => 'The name field is required.',
            'name.unique' => 'The name has already been taken.',
            'description.max' => 'The description may not be greater than 255 characters.',
            'thumbnail.image' => 'The thumbnail must be an image.',
            'thumbnail.mimes' => 'The thumbnail must be a JPEG, PNG, or JPG file.',
        ];
    }
    protected function passedValidation(): void
    {
        if ($this->method() === 'POST') {
            $this->merge(['slug' => Str::slug($this->name), 'user_id' => Auth::id()]);
        }
    }
}
