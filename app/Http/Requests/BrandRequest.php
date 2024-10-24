<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class BrandRequest extends FormRequest
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
        $rules = [
            'name' => ['string', 'max:50'],
            'description' => ['max:255'],
            'logo' => ['image', 'mimes:jpeg,png,jpg', 'max:2048'],
        ];
        if ($this->method() === 'PUT') {
            array_push($rules['name'], 'required', 'unique:brands,name,' . $this->brands);
        } else if ($this->method() === 'post') {
            array_push($rules['name'], 'required', 'unique:brands,name');
        }
        return  $rules;
    }
    protected function passedValidation(): void
    {
        if ($this->method() === 'POST') {
            $this->merge(['slug' => Str::slug($this->name), 'user_id' => Auth::id()]);
        }
    }
}
