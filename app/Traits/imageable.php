<?php

namespace App\Traits;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

/**
 * Manage Image Related data
 */
Trait Imageable
{
    /**
     * Stores an image based on where it came from (CLI or Http)
     *
     * @param string|UploadedFile $image
     *
     * @return string path of the stored image
     */
    public static function store(string|UploadedFile $image): string
    {
        if(is_string($image)) // CLI
        {
            $file = File::get($image);

            $image = 'images/' . uniqid() . '.' . Str::of($image)->afterLast('.');

            Storage::put($image, $file);
        }
        else // Http
        {
            $image = $image->store('images');
        }

        return $image;
    }
}
