<?php

namespace App\Http\Services;

class Media
{

    public static function render_image(object|null $image, string $size = "grid",string $render_type = 'tag',string $class = '', string $attribute = '' , string $file_type = "image")
    {
        if(empty($image)) return null;

        $path = url("assets/uploads/media-uploader/");
        // check file type
        if(self::check_file_type($file_type)){
            $path = self::check_media_size($size,$image->path,$path);
            return self::check_render_type(type: $render_type,image: $path,alt: $image->alt,class: $class, attribute: $attribute);
        }
    }

    private static function check_file_type($type): bool
    {
        // check media file type
        return match($type){
            'image' => true,
            default => false,
        };
    }

    private static function check_media_size($size,$image,$path): string
    {
        return match ($size){
            'grid' => $path . "/grid-" . $image,
            'large' => $path . '/large-' . $image,
            'thumb' => $path . '/thumb-' . $image,
            'full' => $path . '/' . $image,
        };
    }

    private static function check_render_type($type,$image,$alt,$class,$attribute): string
    {
        // check type and return value
        return match($type){
            'bg' => "background-image: url(" . $image . ");",
            'tag' => self::image_tag($image,$alt,$class,$attribute),
            'path' => $image,
        };
    }

    private static function image_tag($path, $alt, $class, $attributes): string
    {
        return "<img alt='". $alt ."' src='" . $path . "' class='". $class ."' ". $attributes .">";
    }
}