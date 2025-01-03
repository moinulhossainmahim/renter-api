<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Listing;
use App\Http\Requests\Listing\ListingListRequest;
use App\Http\Requests\Listing\ListingStoreRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ListingController extends Controller
{
  /**
   * List all listings for the authenticated user.
   */
  public function index(ListingListRequest $request): JsonResponse
  {
    $user = $request->user();

    $listings = Listing::where('user_id', $user?->id)->paginate(
      $request->validated('per_page', 10),
      $request->validated('columns', ['*']),
    );

    $listings->transform(function ($listing) {
      $listing->images = array_map(fn($path) => asset("storage/$path"), $listing->images ?? []);
      return $listing;
    });

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
          'images' => $imagePaths,
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
