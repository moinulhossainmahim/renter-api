<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Wishlist;
use App\Http\Requests\Wishlist\WishlistListRequest;
use App\Http\Requests\Wishlist\WishlistStoreRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
  /**
   * List all wishlists for the authenticated user.
   */
  public function index(WishlistListRequest $request): JsonResponse
  {
    $user = Auth::user();

    $wishlists = Wishlist::with('listing')
      ->where('user_id', $user?->id)
      ->paginate(
        $request->validated('per_page', 10),
        $request->validated('columns', ['*']),
      );

    return response()->json([
      'data' => [
        'wishlists' => $wishlists,
      ],
      'message' => 'Wishlist list successful.',
    ]);
  }

  /**
   * Store a new wishlist for the authenticated user.
   */
  public function store(WishlistStoreRequest $request): JsonResponse
  {
    $user = Auth::user();

    $wishlist = Wishlist::create([
      'user_id' => $user?->id,
      'listing_id' => $request->validated('listing_id'),
    ]);

    return response()->json([
      'data' => [
        'wishlist' => $wishlist,
      ],
      'message' => 'Wishlist store successful.',
    ]);
  }

  /**
   * Delete a wishlist.
   */
  public function destroy(Wishlist $wishlist): JsonResponse
  {
    $wishlist->delete();

    return response()->json([
      'data' => [
        'wishlist' => $wishlist,
      ],
      'message' => 'Wishlist delete successful.',
    ]);
  }
}
