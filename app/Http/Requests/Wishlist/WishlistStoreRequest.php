<?php

namespace App\Http\Requests\Wishlist;

use Illuminate\Validation\Rule;
use App\Http\Requests\FormRequest;

class WishlistStoreRequest extends FormRequest
{
  public function rules(): array
  {
    return [
      'listing_id' => [
        'required',
        'string',
        'size:26',
        'exists:listings,id',
        Rule::unique('wishlists', 'listing_id')->where(function ($query) {
          return $query->where('user_id', $this->user()->id);
        }),
      ],
    ];
  }
}
