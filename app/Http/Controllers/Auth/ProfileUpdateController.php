<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ProfileUpdateRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;

class ProfileUpdateController extends Controller
{
  public function __invoke(ProfileUpdateRequest $request): JsonResponse
  {
    $user = $request->user();

    $data = array_filter($request->validated());

    if ($request->hasFile('profile_image')) {
      if ($user->profile_image) {
        Storage::disk('public')->delete(str_replace('storage/', '', $user->profile_image));
      }

      $imagePath = $request->file('profile_image')->store('profile_images', 'public');
      $data['profile_image'] = asset("storage/$imagePath");
    }

    $user->update($data);

    return response()->json([
      'data' => [
        'user' => $user,
      ],
      'message' => 'Profile updated successful.',
    ]);
  }
}
