<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ChangePasswordRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class ChangePasswordController extends Controller
{
  public function __invoke(ChangePasswordRequest $request): JsonResponse
  {
    $user = $request->user();

    if (!Hash::check($request->old_password, $user->password)) {
      return response()->json(
        [
          'message' => 'Invalid credential',
        ],
        400,
      );
    }

    $user
      ->forceFill(['password' => Hash::make($request->new_password)])
      ->save();

    return response()->json([
      'data' => [
        'user' => $user,
      ],
      'message' => 'Password change successful.',
    ]);
  }
}
