<?php

namespace App\Http\Requests\Wishlist;

use App\Http\Requests\FormRequest;

class WishlistListRequest extends FormRequest
{
  private $columns = ['*', 'id', 'listing', 'user_id'];

  protected function prepareForValidation(): void
  {
    if ($this->filled('columns')) {
      $this->merge([
        'columns' => explode(',', $this->query('columns')),
      ]);
    }
  }

  public function rules(): array
  {
    return [
      'columns' => 'nullable|array|min:1',
      'columns.*' =>
        'required|alpha_dash|distinct|in:' . join(',', $this->columns),
      'page' => 'nullable|integer|min:1',
      'per_page' => 'nullable|integer|in:10,25,50,100',
    ];
  }
}
