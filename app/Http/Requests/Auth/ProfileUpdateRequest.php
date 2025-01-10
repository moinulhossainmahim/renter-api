<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\FormRequest;

class ProfileUpdateRequest extends FormRequest
{
  public function rules(): array
  {
    return [
      'name' => 'nullable|string|max:255',
      'email' => 'nullable|string|email|max:255|unique:users,email,' . $this->user()->id,
      'phone_number' => 'nullable|string|max:11',
      'profile_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
    ];
  }
}
