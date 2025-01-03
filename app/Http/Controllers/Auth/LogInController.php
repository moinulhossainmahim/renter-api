<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LogInRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class LogInController extends Controller
{
  public function __invoke(LogInRequest $request): JsonResponse
  {
    if (
      !Auth::attempt([
        'email' => $request->email,
        'password' => $request->password,
      ])
    ) {
      return response()->json(
        [
          'message' => 'Invalid credentials.',
        ],
        401,
      );
    }

    $response = Http::post(env('APP_URL') . '/oauth/token', [
      'grant_type' => 'password',
      'client_id' => env('PASSPORT_PASSWORD_CLIENT_ID'),
      'client_secret' => env('PASSPORT_PASSWORD_SECRET'),
      'username' => $request->email,
      'password' => $request->password,
      'scope' => '',
    ]);

    if ($response->failed()) {
      return response()->json($response->json(), $response->status());
    }

    return response()->json([
      'data' => [
        'token' => $response->json(),
      ],
      'message' => 'Login successful.',
    ]);
  }
}
