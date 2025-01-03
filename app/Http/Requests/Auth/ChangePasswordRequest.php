<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\FormRequest;

class ChangePasswordRequest extends FormRequest
{
  public function rules(): array
  {
    return [
      'old_password' => 'required',
      'new_password' =>
        'required|string|min:8|max:30|regex:/[a-z]/|regex:/[A-Z]/|regex:/[0-9]/|regex:/[@$!%*?&]/|confirmed',
    ];
  }
}
