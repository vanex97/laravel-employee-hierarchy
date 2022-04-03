<?php

namespace App\Models;

use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Http\UploadedFile;

class Image extends Model
{
    use HasFactory;

    protected $fillable = ['url', 'public_id'];

    public function employee(): HasOne
    {
        return $this->hasOne(Employee::class);
    }

    /**
     * @param UploadedFile $imageFile
     * @return false|resource
     */
    public static function formatForEmployeePhoto(UploadedFile $imageFile)
    {
        $image = \Intervention\Image\Facades\Image::make($imageFile)
            ->fit(300, 300)
            ->orientate()
            ->stream('jpg', 80);

        $tempImage = tmpfile();
        fwrite($tempImage, $image);

        return $tempImage;
    }


}
