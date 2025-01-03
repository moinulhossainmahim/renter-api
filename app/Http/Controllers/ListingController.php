<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Listing;
use App\Http\Requests\Listing\ListingListRequest;
use App\Http\Requests\Listing\ListingStoreRequest;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ListingController extends Controller
{
  public function index(ListingListRequest $request): JsonResponse
  {
    $listings = Listing::query()
      ->when($request->validated('search'), function (
        Builder $query,
        string $search,
      ) {
        $search = '%' . $search . '%';

        $query->where(function (Builder $query) use ($search) {
          $query
            ->where('title', 'like', $search)
            ->orWhere('description', 'like', $search);
        });
      })
      ->when($request->validated('bedrooms'), function (
        Builder $query,
        int $bedrooms,
      ) {
        $query->where('bedrooms', $bedrooms);
      })
      ->when($request->validated('bathrooms'), function (
        Builder $query,
        int $bathrooms,
      ) {
        $query->where('bathrooms', $bathrooms);
      })
      ->when($request->validated('min_price'), function (
        Builder $query,
        int $minPrice,
      ) {
        $query->where('price', '>=', $minPrice);
      })
      ->when($request->validated('max_price'), function (
        Builder $query,
        int $maxPrice,
      ) {
        $query->where('price', '<=', $maxPrice);
      })
      ->paginate(
        $request->validated('per_page', 10),
        $request->validated('columns', ['*']),
      );

    return response()->json([
      'data' => [
        'listings' => $listings,
      ],
      'message' => 'Listing list successful.',
    ]);
  }

  /**
   * Store a new listing for the authenticated user.
   */
  public function store(ListingStoreRequest $request): JsonResponse
  {
    $user = $request->user();

    $imagePaths = [];
    if ($request->has('images')) {
      foreach ($request->file('images') as $image) {
        $imagePaths[] = $image->store('listing-images', 'public');
      }
    }

    $listing = Listing::create([
      'user_id' => $user->id,
      ...$request
        ->safe()
        ->merge([
          'images' => array_map(fn($path) => asset("storage/$path"), $imagePaths),
        ])
        ->all(),
    ]);

    return response()->json([
      'data' => [
        'listing' => $listing,
      ],
      'message' => 'Listing store successful.',
    ]);
  }

  /**
   * Delete a listing for the authenticated user.
   */
  public function destroy(Request $request, Listing $listing): JsonResponse
  {
    $user = $request->user();

    if ($user->id != $listing->user_id) {
      return response()->json(
        [
          'message' => 'You are not authorized to delete this listing.',
        ],
        403,
      );
    }

    $listing->delete();

    return response()->json([
      'data' => [
        'listing' => $listing,
      ],
      'message' => 'Listing delete successful.',
    ]);
  }
}
