<?php

namespace App\Http\Controllers\Api;

use App\Handlers\ImageUploadHandler;
use App\Http\Requests\Api\ImageRequest;
use App\Http\Resources\ImageResource;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ImagesController extends Controller
{
    public function store(ImageRequest $request, ImageUploadHandler $uploader)
    {
        $user = $request->user();

        $size   = $request->input('type') == 'avatar' ? 416 : 1024;
        $result = $uploader->save($request->file('image'), Str::plural($request->input('type')), $user->id, $size);

        $image = new Image([
            'path' => $result['path'],
            'type' => $request->input('type'),
        ]);
        $image->user()->associate($user);
        $image->save();

        return new ImageResource($image);
    }
}
