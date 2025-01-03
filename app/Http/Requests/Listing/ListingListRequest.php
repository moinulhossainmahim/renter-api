<?php

namespace App\Http\Requests\Listing;

use App\Http\Requests\FormRequest;

class ListingListRequest extends FormRequest
{
  private $columns = [
    '*',
    'id',
    'title',
    'description',
    'user_id',
    'title',
    'description',
    'price',
    'street_address',
    'city',
    'state',
    'postal_code',
    'country',
    'latitude',
    'longitude',
    'images',
  ];

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
