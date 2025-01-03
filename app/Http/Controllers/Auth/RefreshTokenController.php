<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RefreshTokenRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;

class RefreshTokenController extends Controller
{
  /**
   * refresh token
   *
   * @return void
   */
  public function __invoke(RefreshTokenRequest $request): JsonResponse
  {
    $response = Http::asForm()->post(env('APP_URL') . '/oauth/token', [
      'grant_type' => 'refresh_token',
      'refresh_token' => $request->refresh_token,
      'client_id' => env('PASSPORT_PASSWORD_CLIENT_ID'),
      'client_secret' => env('PASSPORT_PASSWORD_SECRET'),
      'scope' => '',
    ]);

    if ($response->failed()) {
      return response()->json($response->json(), $response->status());
    }

    return response()->json([
      'data' => [
        'token' => $response->json(),
      ],
      'message' => 'Refresh token successful.',
    ]);
  }
}
