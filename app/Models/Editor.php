<?php

namespace App\Models;
use Illuminate\Support\Facades\Storage;


class Editor
{

    public static function guardarCaptura($base64_image = null)
    {
        if (preg_match('/^data:image\/(\w+);base64,/', $base64_image)) {
            $image = substr($base64_image, strpos($base64_image, ',') + 1);
            $filename = uniqid();
            $extension = 'png';
            $image = base64_decode($image);
            $imageUrl = $filename.'.'.$extension;
            Storage::disk('editor_capturas')->put($imageUrl, $image);

            return [
                'success' => true,
                'filename' => $imageUrl
            ];
        }

        return [
            'success' => false,
        ];
    }
    
}