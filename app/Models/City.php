<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Support\Facades\Storage;

class City extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    public $timestamps = false;

    protected $fillable = [
        'name'
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('default')
            ->useFallbackUrl(url(Storage::url('images/no-image.png')))
            ->useFallbackPath(public_path('/images/no-image.png'))
            ->singleFile()
            ->registerMediaConversions(function (Media $media) {
                $this->addMediaConversion('mini')
                    ->height(90);
            });
    }
}
