<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;

class RegisterController extends Controller
{
  public function __invoke(RegisterRequest $request): JsonResponse
  {
    try {
      $user = User::create($request->validated());

      if (!$user) {
        return response()->json(
          [
            'message' => 'User registration failed. Please try again.',
          ],
          201,
        );
      }

      return response()->json(
        [
          'message' => 'Register successful.',
        ],
        201,
      );
    } catch (QueryException $e) {
      return response()->json(
        [
          'message' => 'User registration failed. Please try again.',
          'error' => $e->getMessage(),
        ],
        500,
      );
    }
  }
}
