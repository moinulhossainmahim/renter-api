<?php

namespace App\Http\Requests\Listing;

use App\Http\Requests\FormRequest;

class ListingStoreRequest extends FormRequest
{
  public function rules(): array
  {
    return [
      'title' => 'required|string|min:5|max:55',
      'description' => 'required|string|min:5|max:255',
      'price' => 'required|integer|max:50000',
      'street_address' => 'required|string|min:5|max:255',
      'city' => 'required|string|max:100',
      'state' => 'required|string|max:100',
      'postal_code' => 'required|string|max:20',
      'country' => 'nullable|string|max:100',
      'images' => 'required|array|min:1|max:10',
      'images.*' => 'required|image|mimes:jpg,jpeg,png|max:2048',
      'features' => 'required|array',
      'features.*' => 'string|max:20|regex:/^[a-zA-Z\s\-]+$/',
      'bedrooms' => 'required|integer|min:1|max:10',
      'bathrooms' => 'required|integer|min:1|max:10',
    ];
  }
}
