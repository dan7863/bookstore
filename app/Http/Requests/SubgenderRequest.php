<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class SubgenderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'name' => 'required',
            'slug' => 'required|unique:subgenders',
            'gender_id' => 'required'
       ];

       if (in_array($this->method(), ['PUT', 'PATCH'])) {
            $subgender = $this->route()->parameter('subgender');
            $rules['slug'] = ["required","unique:subgenders,slug,$subgender->id"];
        }

       return $rules;
    }
}
