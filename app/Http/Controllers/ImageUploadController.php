<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;

class ImageUploadController extends Controller
{
  public function uploadImages()
  {
    $imageDirectory = public_path('images');
    if (File::exists($imageDirectory)) {
      $files = File::files($imageDirectory);
      $imagePaths = [];

      foreach ($files as $file) {
          $imagePaths[] = url('images/' . $file->getFilename());
      }

      return response()->json(json_decode(json_encode($imagePaths, JSON_UNESCAPED_SLASHES)), 200);
    } else {
        return response()->json(['message' => '画像ディレクトリが存在しません'], 404);
    }
  }

  public function uploadImage(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);
    if ($validator->fails()) {
      return response()->json(['errors' => $validator->errors()], 400);
    }

    if ($request->file('image')) {
      $image = $request->file('image');
      $imageName = time() . '.' . $image->getClientOriginalExtension();
      $image->move(public_path('images'), $imageName);
      Log::info('画像が正常にアップロードされました', [
          'image_name' => $imageName,
          'path' => public_path('images') . '/' . $imageName
      ]);

      return response()->json(['message' => '画像が正常にアップロードされました', 'image' => $imageName], 200);
    }

    return response()->json(['message' => '画像のアップロードに失敗しました'], 400);
  }
}
