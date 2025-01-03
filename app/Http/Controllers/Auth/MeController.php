<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MeController extends Controller
{
  /**
   * Login user
   *
   * @param  LoginRequest  $request
   */
  public function __invoke(Request $request): JsonResponse
  {
    $authUser = $request->user();

    return response()->json([
      'data' => [
        'user' => $authUser,
      ],
      'message' => 'Fetch auth user successful.',
    ]);
  }
}
