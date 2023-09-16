<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function upload(Request $request) {
        if($request -> hasFile('upload')){
            $filePath = public_path('storage/uploads/');
            if(!File::isDirectory($filePath)){
                File::makeDirectory($filePath, 0777, true, true);
            }

            $newName = Str::random(20).'.'.$request -> file('upload') -> getClientOriginalExtension();
            $img = Image::make($request -> file('upload') -> path());
            $img -> resize(760, null, function ($const) {
                $const -> aspectRatio();
                $const -> upsize();
            }) ->save($filePath.$newName);

            $imagePath = asset('storage/uploads/'.$newName);

            return $imagePath;
        }
        return false;
    }

    public function remove($url) {
        $path = public_path('/storage'.str_replace(url('/storage'), '', $url));
        if (file_exists($path) && !is_dir($path)) {
            unlink($path);
        }
    }
}
