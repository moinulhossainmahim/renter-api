<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\FormRequest;

class RegisterRequest extends FormRequest
{
  /**
   * Get the validation rules that apply to the request.
   *
   * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
   */
  public function rules(): array
  {
    return [
      'name' => 'required|string|max:255',
      'email' => 'required|email|unique:users,email',
      'password' =>
        'required|string|min:8|max:30|regex:/[a-z]/|regex:/[A-Z]/|regex:/[0-9]/|regex:/[@$!%*?&]/|confirmed',
    ];
  }

  /**
   * Get custom messages for validation errors.
   *
   * @return array<string, string>
   */
  public function messages(): array
  {
    return [
      'password.required' => 'Password is required.',
      'password.min' => 'Password must be at least 8 characters long.',
      'password.max' => 'Password cannot exceed 50 characters.',
      'password.regex' =>
        'Password must contain at least one lowercase letter, one uppercase letter, one number, and one special character (@$!%*?&).',
      'password.confirmed' => 'Password confirmation does not match.',
    ];
  }
}
