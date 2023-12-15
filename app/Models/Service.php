<?php

namespace App\Models;

use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Service extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'title',
        'area',
        // 'description',
        'short_description'
    ];

    protected $with = ['media'];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('servicePic')
        ->acceptsMimeTypes(['image/jpg', 'image/jpeg', 'image/png', 'image/gif']);
    }


    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumbimg')
            ->width(1920)
            ->height(1080)
            ->crop(Manipulations::CROP_CENTER, 1920, 1080)
            ->performOnCollections('servicePic');
    }
}
