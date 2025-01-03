<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogOutController extends Controller
{
  public function __invoke(Request $request): JsonResponse
  {
    if (!Auth::check()) {
      return response()->json(
        [
          'message' => 'Unauthorized: Please provide a valid token.',
        ],
        401,
      );
    }

    $token = $request->bearerToken();

    if (!$token) {
      return response()->json(
        [
          'message' => 'No token provided.',
        ],
        400,
      );
    }

    Auth::user()->tokens->each(function ($token) {
      $token->delete();
    });

    return response()->json([
      'message' => 'Logout successful.',
    ]);
  }
}
